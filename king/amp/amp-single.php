<!doctype html>
<html amp lang="en">
<head>
	<meta charset="utf-8">
	<script async src="https://cdn.ampproject.org/v0.js"></script>
	<?php get_template_part( 'amp/amp-head' ); ?>
	<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
</head>

<body class="amp-king-body">
	<?php get_template_part( 'amp/amp-header' ); ?>
	<div class="amp-king-container">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="amp-header-background">
				<div class="amp-king-article-header">
					<header><?php echo wp_kses_data( the_title( '<h3 class="entry-title">', '</h3>' ) ); ?></header>
					<div class="post-meta">
						<span class="post-views"><i class="fa fa-eye" aria-hidden="true"></i><?php echo esc_attr( king_postviews( get_the_ID(), 'display' ) ); ?></span>
						<span class="post-comments"><i class="fa fa-comment" aria-hidden="true"></i><?php comments_number( ' 0 ', ' 1 ', ' % ' ); ?></span>
					</div>
				</div>
					<div class="amp-king-author">
						<?php
							$author = get_the_author_meta( 'user_nicename' );
							$author_id = $post->post_author;
							$amp_avatar = '';
						?>
						<a class="post-author-avatar" href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_account'] . '/' . $author ); ?>"></a>
						<a class="post-author-name" href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_account'] . '/' . $author ); ?>"><?php  echo esc_attr( $author ); ?></a>
						<span class="post-time"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php the_time( 'F j, Y' ); ?></span>
					</div>
			</div>
			
			<div class="amp-king-content">
				<div class="amp-king-share">
					<span class="share-counter">
						<i><?php echo esc_attr( get_post_meta( get_the_ID(), 'share_counter', true ) ); ?> </i>
						<?php echo esc_html_e( ' shares','king' ); ?>
					</span>		
<?php
$amp_share = get_field( 'amp_share_options', 'option' );

if ( $amp_share && in_array( 'facebook', $amp_share ) ) : ?>
		<amp-social-share type="facebook" height="38" data-param-app_id="<?php the_field( 'facebook_share_app_id', 'option' ); ?>"></amp-social-share>
<?php endif; ?>					
<?php if ( $amp_share && in_array( 'twitter', $amp_share ) ) : ?>
		<amp-social-share type="twitter" height="38"></amp-social-share>
<?php endif; ?>
<?php if ( $amp_share && in_array( 'google_plus', $amp_share ) ) : ?>
		<amp-social-share type="gplus" height="38"></amp-social-share>
<?php endif; ?>
<?php if ( $amp_share && in_array( 'whatsapp', $amp_share ) ) : ?>			
		<amp-social-share type="whatsapp" height="38"></amp-social-share>
<?php endif; ?>
<?php if ( $amp_share && in_array( 'sms', $amp_share ) ) : ?>	
		<amp-social-share type="sms" height="38"></amp-social-share>
<?php endif; ?>	
<?php if ( $amp_share && in_array( 'email', $amp_share ) ) : ?>
		<amp-social-share type="email" height="38"></amp-social-share>
<?php endif; ?>
				</div>

				<article class="amp-king-article">

					<div class="amp-king-entry-content">
						<?php
						if ( has_post_format( 'video' ) ) {
							get_template_part( 'amp/amp-single-video' );
						} elseif ( has_post_format( 'image' ) ) {
							get_template_part( 'amp/amp-single-image' );
						} else {
							get_template_part( 'amp/amp-single-post' );
						}
						?>
					</div>

					<footer class="amp-king-article-footer">
						<p>
							<a class="" href="<?php the_permalink(); ?>"><?php esc_html_e( 'See the full version of this page', 'king' ); ?></a>
						</p>
					</footer>
				</article>

			</div>		
		<?php endwhile; ?>
		<?php get_template_part( 'amp/amp-related-posts' ); ?>	
	</div>
<?php get_template_part( 'amp/amp-sidebar' ); ?>	
</body>
</html>