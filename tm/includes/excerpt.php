<?php if( suxingme('suxing_ad_posts_pc') ){  ?>
	<?php
		$num = suxingme('suxing_ad_posts_pc_num',3);
		if ($wp_query->current_post == $num) : ?>
			<div class="ajax-load-con content posts-cjtz hidden-xs hidden-sm <?php echo $GLOBALS['wow_single_list']; ?>">
				<?php echo suxingme('suxing_ad_posts_pc_url'); ?>
			</div>
		<?php endif; ?>
<?php } ?>
<?php if( suxingme('suxing_ad_posts_m') ){  ?>
	<?php
		$num = suxingme('suxing_ad_posts_m_num');
		if ($wp_query->current_post == $num) : ?>
			<div class="ajax-load-con content posts-cjtz-min hidden-md hidden-lg <?php echo $GLOBALS['wow_single_list']; ?>">
				<?php echo suxingme('suxing_ad_posts_m_url'); ?>
			</div>
		<?php endif; ?>
<?php }

$metainfo = suxingme('single_metainfo');
$dis_author = $metainfo['author'];
$dis_cat  = $metainfo['cat'];
$dis_time = $metainfo['time'];
$dis_view = $metainfo['view'];
$dis_like = $metainfo['like'];
$cc_value = get_post_meta($post->ID,"cc_value",true );

?>



<?php  //分类判断
if( in_category( 'text' ) ){  //文字?>
<div class="ajax-load-con content <?php echo $GLOBALS['wow_single_list']; ?> wow fadeIn">
	<div class="content-box posts-aside">
		<div class="posts-default-content">
			<div class="posts-default-title">
				<?php if (suxingme('suxingme_post_tags',true)) { the_tags('<div class="post-entry-categories">','','</div>'); }?>
				
			</div>
			<div class="posts-text"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>> <?php the_content(); ?> </a></div>
			<div class="posts-default-info">
				<ul>
					<?php  if($dis_author == 1) {
						if( $cc_value != 2 && $cc_value != 3 ){ ?> 
							<li class="post-author hidden-xs hidden-sm"><div class="avatar"><?php echo get_avatar( get_the_author_meta('ID') ); ?></div><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>
						<?php } ?>
					<?php } if( $cc_value == 1 ) { ?>
						<li class="postoriginal hidden-xs hidden-sm"><span><i class="icon-cc-1"></i><?php echo suxingme('suxingme_custom_cc');?></span></li>
									
					<?php }	if($dis_cat == 1) { ?>
						<li class="ico-cat"><i class="icon-list-2"></i> <?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></li>
					<?php } if($dis_time == 1) { ?>
						<li class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
					<?php } if($dis_view == 1) { ?>
						<li class="ico-eye hidden-xs hidden-sm"><i class="icon-eye-4"></i> <?php post_views('',''); ?></li>
					<?php }  if($dis_like == 1) { ?><li class="ico-like hidden-xs hidden-sm"><i class="icon-heart"></i> <?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></li><?php } ?>
						<li>	<?php edit_post_link('[编辑]'); ?></li>
						
							<?php if(suxingme('suxingme_post_like',true)) { ?><li class="post-options">
							<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" id="Addlike" class="action btn-likes like<?php if(isset($_COOKIE['suxing_ding_'.$post->ID])) echo ' current';?>" title="喜欢">
								<span class="icon s-like"><i class="icon-heart"></i><i class="icon-heart-filled"></i> 喜欢 </span>
								(<span class="count num"><?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></span>)
							</a></li>
							<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
    <?php } else if ( in_category( 'tuji' )) { //图片?>
<div class="ajax-load-con content <?php echo $GLOBALS['wow_single_list']; ?> wow fadeIn">
	<div class="content-box posts-image-box">
		<div class="posts-default-title">
			<?php if (suxingme('suxingme_post_tags',true)) { the_tags('<div class="post-entry-categories">','','</div>'); }?>
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>><?php the_title();?></a></h2>
		</div>
		<div class="post-images-item">
			<ul>
				<?php echo suxingme_get_thumbnail();?>	
            </ul>
		</div>
		<div class="posts-default-content">
			<div class="posts-text"><?php echo wp_trim_words( get_the_excerpt(), 100); ?></div>
		</div>
		<div class="posts-default-info">
				<ul>
					<?php  if($dis_author == 1) { 
						if( $cc_value != 2 && $cc_value != 3 ){?> 
							<li class="post-author hidden-xs hidden-sm"><div class="avatar"><?php echo get_avatar( get_the_author_meta('ID') ); ?></div><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>
						<?php }  ?>  
					<?php } if( $cc_value == 1 ) { ?>
						<li class="postoriginal hidden-xs hidden-sm"><span><i class="icon-cc-1"></i><?php echo suxingme('suxingme_custom_cc');?></span></li>
									
					<?php }	if($dis_cat == 1) { ?>
						<li class="ico-cat"><i class="icon-list-2"></i> <?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></li>
					<?php } if($dis_time == 1) { ?>
						<li class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
					<?php } if($dis_view == 1) { ?>
						<li class="ico-eye hidden-xs hidden-sm"><i class="icon-eye-4"></i> <?php post_views('',''); ?></li>
					<?php }  if($dis_like == 1) { ?><li class="ico-like hidden-xs hidden-sm"><i class="icon-heart"></i> <?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></li><?php } ?>
						<li>	<?php edit_post_link('[编辑]'); ?></li>
						
							<?php if(suxingme('suxingme_post_like',true)) { ?><li class="post-options">
							<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" id="Addlike" class="action btn-likes like<?php if(isset($_COOKIE['suxing_ding_'.$post->ID])) echo ' current';?>" title="喜欢">
								<span class="icon s-like"><i class="icon-heart"></i><i class="icon-heart-filled"></i> 喜欢 </span>
								(<span class="count num"><?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></span>)
							</a></li>
							<?php } ?>
				</ul>
			</div>
	</div>
</div>
    <?php } else if ( in_category( 'neihan' )) { //内涵图片?>
<div class="ajax-load-con content <?php echo $GLOBALS['wow_single_list']; ?> wow fadeIn">
	<div class="content-box posts-image-box">
		<div class="posts-default-title">
			<?php if (suxingme('suxingme_post_tags',true)) { the_tags('<div class="post-entry-categories">','','</div>'); }?>
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>><?php the_title();?></a></h2>
		</div>
 
		<div class="posts-default-content">
			<div class="posts-text"><?php the_content(); ?></div>
		</div>
		<div class="posts-default-info">
				<ul>
					<?php  if($dis_author == 1) { 
						if( $cc_value != 2 && $cc_value != 3 ){?> 
							<li class="post-author hidden-xs hidden-sm"><div class="avatar"><?php echo get_avatar( get_the_author_meta('ID') ); ?></div><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>
						<?php }  ?>  
					<?php } if( $cc_value == 1 ) { ?>
						<li class="postoriginal hidden-xs hidden-sm"><span><i class="icon-cc-1"></i><?php echo suxingme('suxingme_custom_cc');?></span></li>
									
					<?php }	if($dis_cat == 1) { ?>
						<li class="ico-cat"><i class="icon-list-2"></i> <?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></li>
					<?php } if($dis_time == 1) { ?>
						<li class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
					<?php } if($dis_view == 1) { ?>
						<li class="ico-eye hidden-xs hidden-sm"><i class="icon-eye-4"></i> <?php post_views('',''); ?></li>
					<?php }  if($dis_like == 1) { ?><li class="ico-like hidden-xs hidden-sm"><i class="icon-heart"></i> <?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></li><?php } ?>
						<li>	<?php edit_post_link('[编辑]'); ?></li>
						
							<?php if(suxingme('suxingme_post_like',true)) { ?><li class="post-options">
							<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" id="Addlike" class="action btn-likes like<?php if(isset($_COOKIE['suxing_ding_'.$post->ID])) echo ' current';?>" title="喜欢">
								<span class="icon s-like"><i class="icon-heart"></i><i class="icon-heart-filled"></i> 喜欢 </span>
								(<span class="count num"><?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></span>)
							</a></li>
							<?php } ?>
				</ul>
			</div>
	</div>
</div>
    <?php } else if ( in_category( 'image' )) { //图片?>
<div class="ajax-load-con content <?php echo $GLOBALS['wow_single_list']; ?> wow fadeIn">
	<div class="content-box posts-image-box">
		<div class="posts-default-title">
			<?php if (suxingme('suxingme_post_tags',true)) { the_tags('<div class="post-entry-categories">','','</div>'); }?>
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>><?php the_title();?></a></h2>
		</div>
 
		<div class="posts-default-content">
			<div class="posts-text"><?php the_content(); ?></div>
		</div>
		<div class="posts-default-info">
				<ul>
					<?php  if($dis_author == 1) { 
						if( $cc_value != 2 && $cc_value != 3 ){?> 
							<li class="post-author hidden-xs hidden-sm"><div class="avatar"><?php echo get_avatar( get_the_author_meta('ID') ); ?></div><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>
						<?php }  ?>  
					<?php } if( $cc_value == 1 ) { ?>
						<li class="postoriginal hidden-xs hidden-sm"><span><i class="icon-cc-1"></i><?php echo suxingme('suxingme_custom_cc');?></span></li>
									
					<?php }	if($dis_cat == 1) { ?>
						<li class="ico-cat"><i class="icon-list-2"></i> <?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></li>
					<?php } if($dis_time == 1) { ?>
						<li class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
					<?php } if($dis_view == 1) { ?>
						<li class="ico-eye hidden-xs hidden-sm"><i class="icon-eye-4"></i> <?php post_views('',''); ?></li>
					<?php }  if($dis_like == 1) { ?><li class="ico-like hidden-xs hidden-sm"><i class="icon-heart"></i> <?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></li><?php } ?>
						<li>	<?php edit_post_link('[编辑]'); ?></li>
						
							<?php if(suxingme('suxingme_post_like',true)) { ?><li class="post-options">
							<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" id="Addlike" class="action btn-likes like<?php if(isset($_COOKIE['suxing_ding_'.$post->ID])) echo ' current';?>" title="喜欢">
								<span class="icon s-like"><i class="icon-heart"></i><i class="icon-heart-filled"></i> 喜欢 </span>
								(<span class="count num"><?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></span>)
							</a></li>
							<?php } ?>
				</ul>
			</div>
	</div>
</div>
    <?php } else if ( in_category( 'video' )) { ?>
<div class="ajax-load-con content posts-default <?php echo $GLOBALS['wow_single_list']; ?> wow fadeIn">
	<div class="content-box">

		<div class="posts-default-box">
	    
			
<?php
  
if(get_field('video_url'))
{
    
    echo '<iframe src="https://mayiwo.xyz/?url=' . get_field('video_url') . '" id="oplayer" width="100%" height="280px" allowtransparency="true" frameborder="0" scrolling="no" border="0" marginwidth="0" marginheight="0" allowfullscreen="true" style="overflow: hidden;"></iframe> <script>
 function changeFrameHeight(){
        var ifm= document.getElementById("oplayer");
        ifm.height=document.documentElement.clientHeight-56;
    }
    window.onresize=function(){ changeFrameHeight();}
    $(function(){changeFrameHeight();});</script>';
}else{ echo '';
}
  

?>
	
 
			<div class="posts-default-title">
			
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>><?php the_title();?></a></h2>
			</div>
			<div class="posts-default-content">
				
				<div class="posts-text"> <?php the_content(); ?> </div>
				<div class="posts-default-info">
					<ul>
						<?php  if($dis_author == 1) { 
						if( $cc_value != 2 && $cc_value != 3){?> 
							<li class="post-author hidden-xs hidden-sm"><div class="avatar"><?php echo get_avatar( get_the_author_meta('ID') ); ?></div><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>
						<?php } ?> 
					<?php } if( $cc_value == 1 ) { ?>
						<li class="postoriginal hidden-xs hidden-sm"><span><i class="icon-cc-1"></i><?php echo suxingme('suxingme_custom_cc');?></span></li>
									
					<?php }	if($dis_cat == 1) { ?>
							<li class="ico-cat"><i class="icon-list-2"></i> <?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></li>
						<?php } if($dis_time == 1) { ?>
							<li class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
						<?php } if($dis_view == 1) { ?>
							<li class="ico-eye hidden-xs hidden-sm"><i class="icon-eye-4"></i> <?php post_views('',''); ?></li>
						<?php }  if($dis_like == 1) { ?><li class="ico-like hidden-xs hidden-sm"><i class="icon-heart"></i> <?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></li>
						<?php } ?>
						<li>	<?php edit_post_link('[编辑]'); ?></li>
						
							<?php if(suxingme('suxingme_post_like',true)) { ?><li class="post-options">
							<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" id="Addlike" class="action btn-likes like<?php if(isset($_COOKIE['suxing_ding_'.$post->ID])) echo ' current';?>" title="喜欢">
								<span class="icon s-like"><i class="icon-heart"></i><i class="icon-heart-filled"></i> 喜欢 </span>
								(<span class="count num"><?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></span>)
							</a></li>
							<?php } ?>
						
						<li style=" float: right; ">	<?php if (suxingme('suxingme_post_tags',true)) { the_tags('<div class="post-entry-categories">','','</div>'); }?></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
    <?php } else if ( in_category( 'youhui' )) { ?>
    
<?php } ?>