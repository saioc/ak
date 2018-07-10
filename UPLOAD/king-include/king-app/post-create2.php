<?php
/*
	Question2Answer by Gideon Greenspan and contributors
	http://www.question2answer.org/

	File: king-include/king-app-post-create.php
	Description: Creating questions, answers and comments (application level)


	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	More about this license: http://www.question2answer.org/license.php
*/

	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../');
		exit;
	}

	require_once QA_INCLUDE_DIR.'king-db/maxima.php';
	require_once QA_INCLUDE_DIR.'king-db/post-create.php';
	require_once QA_INCLUDE_DIR.'king-db/points.php';
	require_once QA_INCLUDE_DIR.'king-db/hotness.php';
	require_once QA_INCLUDE_DIR.'king-util/string.php';


	function qa_combine_notify_email($userid, $notify, $email)
/*
	Return value to store in database combining $notify and $email values entered by user $userid (or null for anonymous)
*/
	{
		return $notify ? (empty($email) ? (isset($userid) ? '@' : null) : $email) : null;
	}


	function qa_question_create($followanswer, $userid, $handle, $cookieid, $title, $content, $format, $text, $tagstring, $notify, $email,
		$categoryid=null, $extravalue=null, $queued=false, $name=null)
/*
	Add a question (application level) - create record, update appropriate counts, index it, send notifications.
	If question is follow-on from an answer, $followanswer should contain answer database record, otherwise null.
	See king-app-posts.php for a higher-level function which is easier to use.
*/
	{
		require_once QA_INCLUDE_DIR.'king-db/selects.php';

function kingsource($content) 
	{
		$parsed = parse_url($content); 
		return str_replace('www.','', strtolower($parsed['host'])); 
	}
	
	function get_thumb($content) {
		$res = file_get_contents("$content");
	    preg_match('/property="og:image" content="(.*?)"/', $res, $output);
		return ($output[1]) ? $output[1] : false;
	}
	
	function king_twitch($content) {
	$res = file_get_contents("$content");
	preg_match('/content=\'(.*?)\' property=\'og:image\'/', $res, $matches);

	return ($matches[1]) ? $matches[1] : false;
	}	

	function king_vk($content) {
	    $page = file_get_contents("$content");
		$page_for_hash = preg_replace("/\\\/","",$page);
		if (preg_match("@,\"jpg\":\"(.*?)\",@",$page_for_hash,$matches)) {
		$result = $matches[1];
		return $result;
		}
	}	

     function king_mailru($content) {
	 $page = file_get_contents("$content");
	 if (preg_match('/content="(.*?)" name="og:image"/',$page,$mailru)) {
	 $king = $mailru[1];
	 return $king;
	 }
	 }
	
	 function king_facebook($content) {            
                if (strpos($content,'php?v=') !== false) {
                        $queryString = parse_url($content, PHP_URL_QUERY);
                        parse_str($queryString, $params);
                        return "http://graph.facebook.com/" . trim($params['v']) . "/picture";
                }else{
                        $paths = explode("/",$content);
                        $num = count($paths);
                        for($i=$num-1; $i > 0; $i--){
                                if($paths[$i] != ""){
                                        $idvideo = $paths[$i];
                                        break;
                                }
                        }
                        return "https://graph.facebook.com/" . trim($idvideo) . "/picture";
                }

        }

	function king_youtube($url) {
		$queryString = parse_url($url, PHP_URL_QUERY);
		parse_str($queryString, $params);
		if (isset($params['v'])) 
		{
			return "http://i3.ytimg.com/vi/" . trim($params['v']) . "/hqdefault.jpg";
		}
		return true;
	}	
	
	function king_soundcloud($content) {
	    ini_set("user_agent", "SCPHP");
		
		function resolve_sc_track($url = ''){
		return json_decode(file_get_contents("https://api.soundcloud.com/resolve?client_id=KqmJoxaVYyE4XT0XQqFUUQ&format=json&url="
		. $url), true);
		}
		
		function get_artwork_url($track, $format="t500x500"){
		return str_replace("large", $format, $track["artwork_url"]);
		}
		
		// get track data from track url
		$track = resolve_sc_track("$content");
		return get_artwork_url($track);
   }
   
	function king_xhamster($content) {
	    $page = file_get_contents("$content");
		$page_for_hash = preg_replace("/\\\/","",$page);
		if (preg_match("@,\"image\":\"(.*?)\",@",$page_for_hash,$matches)) {
		$result = $matches[1];
		return $result;
		}
   }    

	function king_okru($content) {
		$res = file_get_contents("$content");
	    preg_match('/rel="image_src" href="(.*?)"/', $res, $output);
		return ($output[1]) ? $output[1] : false;
   }   

     function coub_thumb($content) {
	 $page2 = file_get_contents("$content");
	 if (preg_match('/content="(.*?)" property="og:image"/', $page2, $coub)) {
	 $cou = $coub[1];
	 return $cou;
	 }
	 }	

	function king_gfycat($content) {
		$res = file_get_contents("$content");
	    preg_match('/name="twitter:image" content="(.*?)"/', $res, $output);
		return ($output[1]) ? $output[1] : false;
   }
	 
	$type = kingsource($content);
	
	    if($type=="vimeo.com" || $type=="dailymotion.com" || $type=="metacafe.com" || $type=="vine.co" || $type=="instagram.com" || $type=="vid.me")
		{
			$thumb=get_thumb($content);
		}
		else if($type=="xhamster.com")
		{
			$thumb=king_xhamster($content);
		}
		else if($type=="ok.ru")
		{
			$thumb=king_okru($content);
		}	
	    else if($type=="coub.com")
		{
			$thumb=coub_thumb($content);
		}		
		else if($type=="gfycat.com")
		{
			$thumb=king_gfycat($content);
		}		
	    else if($type=="youtube.com")
		{
			$thumb=king_youtube($content);
		}		
		else if($type=="facebook.com")
		{
			$thumb=king_facebook($content);
		}		
		else if($type=="soundcloud.com")
		{
			$thumb=king_soundcloud($content);
		}	
		else if($type=="vk.com")
		{
			$thumb=king_vk($content);
		}	
		else if($type=="my.mail.ru")
		{
			$thumb=king_mailru($content);
		}
		else if($type=="twitch.tv")
		{
			$thumb=king_twitch($content);
		}		
		else
		{
			$thumb = $extravalue;
		}								
		
		
		
		$postid=qa_db_post_create($queued ? 'Q_QUEUED' : 'Q', @$followanswer['postid'], $userid, isset($userid) ? null : $cookieid,
			qa_remote_ip_address(), $title, $thumb, $format, $tagstring, qa_combine_notify_email($userid, $notify, $email),
			$categoryid, isset($userid) ? null : $name);
		
		if (isset($extravalue))	{
			require_once QA_INCLUDE_DIR.'king-db-metas.php';
			qa_db_postmeta_set($postid, 'qa_q_extra', $content);
		}
		
		qa_db_posts_calc_category_path($postid);
		qa_db_hotness_update($postid);
		
		if ($queued) {
			qa_db_queuedcount_update();

		} else {
			qa_post_index($postid, 'Q', $postid, @$followanswer['postid'], $title, $content, $format, $text, $tagstring, $categoryid);
			qa_update_counts_for_q($postid);
			qa_db_points_update_ifuser($userid, 'qposts');
		}
		
		qa_report_event($queued ? 'q_queue' : 'q_post', $userid, $handle, $cookieid, array(
			'postid' => $postid,
			'parentid' => @$followanswer['postid'],
			'parent' => $followanswer,
			'title' => $title,
			'content' => $content,
			'format' => $format,
			'text' => $text,
			'tags' => $tagstring,
			'categoryid' => $categoryid,
			'extra' => $extravalue,
			'name' => $name,
			'notify' => $notify,
			'email' => $email,
		));
		
		return $postid;
	}
	


	function qa_update_counts_for_q($postid)
/*
	Perform various common cached count updating operations to reflect changes in the question whose id is $postid
*/
	{
		if (isset($postid)) // post might no longer exist
			qa_db_category_path_qcount_update(qa_db_post_get_category_path($postid));

		qa_db_qcount_update();
		qa_db_unaqcount_update();
		qa_db_unselqcount_update();
		qa_db_unupaqcount_update();
	}


	function qa_array_filter_by_keys($inarray, $keys)
/*
	Return an array containing the elements of $inarray whose key is in $keys
*/
	{
		$outarray=array();

		foreach ($keys as $key)
			if (isset($inarray[$key]))
				$outarray[$key]=$inarray[$key];

		return $outarray;
	}


	function qa_suspend_post_indexing($suspend=true)
/*
	Suspend the indexing (and unindexing) of posts via qa_post_index(...) and qa_post_unindex(...)
	if $suspend is true, otherwise reinstate it. A counter is kept to allow multiple calls.
*/
	{
		global $qa_post_indexing_suspended;

		$qa_post_indexing_suspended+=($suspend ? 1 : -1);
	}


	function qa_post_index($postid, $type, $questionid, $parentid, $title, $content, $format, $text, $tagstring, $categoryid)
/*
	Add post $postid (which comes under $questionid) of $type (Q/A/C) to the database index, with $title, $text,
	$tagstring and $categoryid. Calls through to all installed search modules.
*/
	{
		global $qa_post_indexing_suspended;

		if ($qa_post_indexing_suspended>0)
			return;

	//	Send through to any search modules for indexing

		$searches=qa_load_modules_with('search', 'index_post');
		foreach ($searches as $search)
			$search->index_post($postid, $type, $questionid, $parentid, $title, $content, $format, $text, $tagstring, $categoryid);
	}


	function qa_answer_create($userid, $handle, $cookieid, $content, $format, $text, $notify, $email, $question, $queued=false, $name=null)
/*
	Add an answer (application level) - create record, update appropriate counts, index it, send notifications.
	$question should contain database record for the question this is an answer to.
	See king-app-posts.php for a higher-level function which is easier to use.
*/
	{
		$postid=qa_db_post_create($queued ? 'A_QUEUED' : 'A', $question['postid'], $userid, isset($userid) ? null : $cookieid,
			qa_remote_ip_address(), null, $content, $format, null, qa_combine_notify_email($userid, $notify, $email),
			$question['categoryid'], isset($userid) ? null : $name);

		qa_db_posts_calc_category_path($postid);

		if ($queued) {
			qa_db_queuedcount_update();

		} else {
			if ($question['type']=='Q') // don't index answer if parent question is hidden or queued
				qa_post_index($postid, 'A', $question['postid'], $question['postid'], null, $content, $format, $text, null, $question['categoryid']);

			qa_update_q_counts_for_a($question['postid']);
			qa_db_points_update_ifuser($userid, 'aposts');
		}

		qa_report_event($queued ? 'a_queue' : 'a_post', $userid, $handle, $cookieid, array(
			'postid' => $postid,
			'parentid' => $question['postid'],
			'parent' => $question,
			'content' => $content,
			'format' => $format,
			'text' => $text,
			'categoryid' => $question['categoryid'],
			'name' => $name,
			'notify' => $notify,
			'email' => $email,
		));

		return $postid;
	}


	function qa_update_q_counts_for_a($questionid)
/*
	Perform various common cached count updating operations to reflect changes in an answer of question $questionid
*/
	{
		qa_db_post_acount_update($questionid);
		qa_db_hotness_update($questionid);
		qa_db_acount_update();
		qa_db_unaqcount_update();
		qa_db_unupaqcount_update();
	}


	function qa_comment_create($userid, $handle, $cookieid, $content, $format, $text, $notify, $email, $question, $parent, $commentsfollows, $queued=false, $name=null)
/*
	Add a comment (application level) - create record, update appropriate counts, index it, send notifications.
	$question should contain database record for the question this is part of (as direct or comment on Q's answer).
	If this is a comment on an answer, $answer should contain database record for the answer, otherwise null.
	$commentsfollows should contain database records for all previous comments on the same question or answer,
	but it can also contain other records that are ignored.
	See king-app-posts.php for a higher-level function which is easier to use.
*/
	{
		require_once QA_INCLUDE_DIR.'king-app/emails.php';
		require_once QA_INCLUDE_DIR.'king-app/options.php';
		require_once QA_INCLUDE_DIR.'king-app/format.php';
		require_once QA_INCLUDE_DIR.'king-util/string.php';

		if (!isset($parent))
			$parent=$question; // for backwards compatibility with old answer parameter

		$postid=qa_db_post_create($queued ? 'C_QUEUED' : 'C', $parent['postid'], $userid, isset($userid) ? null : $cookieid,
			qa_remote_ip_address(), null, $content, $format, null, qa_combine_notify_email($userid, $notify, $email),
			$question['categoryid'], isset($userid) ? null : $name);

		qa_db_posts_calc_category_path($postid);

		if ($queued) {
			qa_db_queuedcount_update();

		} else {
			if ( ($question['type']=='Q') && (($parent['type']=='Q') || ($parent['type']=='A')) ) // only index if antecedents fully visible
				qa_post_index($postid, 'C', $question['postid'], $parent['postid'], null, $content, $format, $text, null, $question['categoryid']);

			qa_db_points_update_ifuser($userid, 'cposts');
			qa_db_ccount_update();
		}

		$thread=array();

		foreach ($commentsfollows as $comment)
			if (($comment['type']=='C') && ($comment['parentid']==$parent['postid'])) // find just those for this parent, fully visible
				$thread[]=$comment;

		qa_report_event($queued ? 'c_queue' : 'c_post', $userid, $handle, $cookieid, array(
			'postid' => $postid,
			'parentid' => $parent['postid'],
			'parenttype' => $parent['basetype'],
			'parent' => $parent,
			'questionid' => $question['postid'],
			'question' => $question,
			'thread' => $thread,
			'content' => $content,
			'format' => $format,
			'text' => $text,
			'categoryid' => $question['categoryid'],
			'name' => $name,
			'notify' => $notify,
			'email' => $email,
		));

		return $postid;
	}


/*
	Omit PHP closing tag to help avoid accidental output
*/