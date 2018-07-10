<?php

if(isset($_FILES["myfile"]) && $_FILES["myfile"]["error"]== UPLOAD_ERR_OK)
{
	############ Edit settings ##############
	$UploadDirectory	= 'videos/'; //specify upload directory ends with / (slash)	
    $ffmpeg = '/usr/bin/ffmpeg'; // where ffmpeg is located, such as /usr/bin/ffmpeg
	$second = 5;
	##########################################
	
	/*
	Note : You will run into errors or blank page if "memory_limit" or "upload_max_filesize" is set to low in "php.ini". 
	Open "php.ini" file, and search for "memory_limit" or "upload_max_filesize" limit 
	and set them adequately, also check "post_max_size".
	*/
	
	//check if this is an ajax request
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		die();
	}
	
	
	switch(strtolower($_FILES['myfile']['type']))
		{
			//allowed file types
			case 'video/mp4':
				break;
			default:
				die('Unsupported File!'); //output error
	}
	

	
	$File_Name          = strtolower($_FILES['myfile']['name']);
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	$Random_Number      = rand(0, 9999999999); //Random number to be added to name.
	$NewFileName        = $Random_Number.$File_Ext; //new file name
	
	$NewFileName2       = $Random_Number; //new file name
	
	$image = $UploadDirectory.$NewFileName2.'.jpg';
	
	if(!is_array($_FILES["myfile"]["name"])) //single file
	{
    move_uploaded_file($_FILES["myfile"]["tmp_name"],$UploadDirectory.$NewFileName);
	
	$video = $UploadDirectory.$NewFileName;
	
	$cmd = "$ffmpeg -i $video -deinterlace -an -ss $second -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg $image 2>&1";
	
	shell_exec($cmd);

    $ret[]= $NewFileName2;
	}
	echo json_encode($ret);
}
	else
	{
		die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
}
