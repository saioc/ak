<?php
/**
 * Featured Posts Slider.
 *
 * @package King
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	 exit;
}
?>
<?php
if ( get_field( 'show_slider', 'options' ) === 'featured-post' ) {
	$meta_key = 'featured-post';
} else {
	$meta_key = 'keep_trending';
}
if ( get_field( 'enable_grid_view', 'options' ) ) {
	$posts_per_page = 5;
} else {
	$posts_per_page = get_field( 'length_slider', 'options' );
}
// get posts.
$featured = get_posts(array(
	'posts_per_page'    => $posts_per_page,
	'meta_key'          => $meta_key,
	'meta_value'        => '1',
	'orderby'           => 'modified',
	'order'             => 'DESC',
));

if ( $featured ) : ?>
<?php if ( get_field( 'enable_grid_view', 'options' ) ) : ?>
	<div class="king-featured-grid">
<?php else : ?>
	<div class="king-featured owl-carousel">
<?php endif; ?>
	<?php foreach ( $featured as $post ) : ?>
	<div class="featured-posts">

		<a href="<?php the_permalink(); ?>">
			<?php if ( has_post_thumbnail() ) :
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
				<div class="featured-post" style="background-image: url('<?php echo esc_url( $thumb['0'] ); ?>')"></div>
			<?php else : ?>
				<span class="no-thumb"></span>
			<?php endif; ?>
		</a>
	<?php if ( get_field( 'featured-post' )  ||  get_field( 'keep_trending' ) ) :?>  
	<div class="featured-ft">    
		<?php if ( get_field( 'featured-post' ) ) : ?>
			<div class="featured"><i class="fa fa-rocket fa-lg" aria-hidden="true"></i><span><?php echo esc_html_e( 'featured', 'king' ) ?></span></div><!-- .featured -->
		<?php endif; ?>
		<?php if ( get_field( 'keep_trending' ) ) : ?>
			<div class="trending"><i class="fa fa-bolt fa-lg" aria-hidden="true"></i><span><?php echo esc_html_e( 'trending', 'king' ) ?></span></div><!-- .trending -->
		<?php endif; ?>
	</div>
	<?php endif; ?>        
		<div class="featured-content">        
			<span class="featured-post-format">
				<?php if ( has_post_format( 'quote' ) ) : ?>
					<span class="featured-format-news"><?php echo esc_html_e( 'News', 'king' ); ?></span>
				<?php elseif ( has_post_format( 'video' ) ) : ?>
					<span class="featured-format-video"><?php echo esc_html_e( 'Video', 'king' ); ?></span>
				<?php elseif ( has_post_format( 'image' ) ) : ?>
					<span class="featured-format-image"><?php echo esc_html_e( 'Image', 'king' ); ?></span>
				<?php endif; ?>
			</span>            
			<a href="<?php the_permalink(); ?>"  class="featured-title"><?php the_title(); ?></a>
			<span class="post-views"><i class="fa fa-eye" aria-hidden="true"></i><?php echo esc_attr( king_postviews( get_the_ID(), 'display' ) ); ?></span>
			<span class="post-comments"><i class="fa fa-comment" aria-hidden="true"></i><?php comments_number( ' 0 ', ' 1 ', ' % ' ); ?></span>
			<span class="post-time"><i class="fa fa-clock-o" aria-hidden="true"></i><?php the_time( 'F j, Y' ); ?></span>
		</div>
</div><?php endforeach; ?></div>
	<?php wp_reset_postdata(); ?>
<?php endif; ?>
