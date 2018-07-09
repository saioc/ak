<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package king
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nothumb = '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( get_field( 'nsfw_post' ) && ! is_user_logged_in() ) : ?>
		<div class="nsfw-post">
			<a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_login'] ); ?>">
				<i class="fa fa-paw fa-3x"></i>
				<div><h1><?php echo esc_html_e( 'Not Safe For Work', 'king' ) ?></h1></div>
				<span><?php echo esc_html_e( 'Click to view this post.', 'king' ) ?></span>
			</a>	
		</div>
	<?php else : ?> 	
		<a href="<?php the_permalink(); ?>" class="entry-image-link">
			<?php if ( has_post_thumbnail() ) :
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); ?>
			<div class="entry-image" style="background-image: url('<?php echo esc_url( $thumb['0'] ); ?>'); height:<?php echo esc_attr( $thumb[2] . 'px;' ); ?>"></div>
		<?php else :
			$nothumb = 'nothumb';
		?>
			<span class="entry-no-thumb"></span>
		<?php endif; ?> 
	</a>
<?php endif; ?>
	
	<div class="post-featured-trending">	
		<?php if ( get_field( 'featured-post' ) ) : ?>
			<div class="featured"><i class="fa fa-rocket fa-lg" aria-hidden="true"></i><span><?php echo esc_html_e( 'featured', 'king' ) ?></span></div><!-- .featured -->
		<?php endif; ?>
		<?php if ( get_field( 'keep_trending' ) ) : ?>
			<div class="trending"><i class="fa fa-bolt fa-lg" aria-hidden="true"></i><span><?php echo esc_html_e( 'trending', 'king' ) ?></span></div><!-- .trending -->
		<?php endif; ?>
		<?php if ( is_sticky() ) : ?>
			<div class="trending sticky"><i class="fa fa-paperclip fa-lg" aria-hidden="true"></i><span><?php echo esc_html_e( 'sticky', 'king' ) ?></span></div><!-- .trending -->
		<?php endif; ?>
	</div>

<div class="content-right-top <?php echo esc_attr( $nothumb ); ?>">
	<span class="buzpress-post-format">
		<?php if ( has_post_format( 'quote' ) ) : ?>
			<a class="entry-format-news" href="<?php echo esc_url( get_post_format_link( 'quote' ) ); ?>"><?php echo esc_html_e( 'News', 'king' ) ?></a>
		<?php elseif ( has_post_format( 'video' ) ) : ?>
			<a class="entry-format-video" href="<?php echo esc_url( get_post_format_link( 'video' ) ); ?>"><?php echo esc_html_e( 'Video', 'king' ) ?></a>
		<?php elseif ( has_post_format( 'image' ) ) : ?>
			<a class="entry-format-image" href="<?php echo esc_url( get_post_format_link( 'image' ) ); ?>"><?php echo esc_html_e( 'Image', 'king' ) ?></a>
		<?php endif; ?>
	</span><!-- .buzpress-post-format -->
	<div class="content-middle">
		<span class="content-share-counter">
			<span class="content-middle-open" data-toggle="dropdown" data-target=".content-m-<?php the_ID(); ?>" aria-expanded="false" role="button">
				<i class="fa fa-retweet" aria-hidden="true"></i>
			</span>
			<span><?php echo esc_attr( get_post_meta( get_the_ID(), 'share_counter', true ) ); ?></span>
		</span>	
		<div class="content-m-<?php the_ID(); ?> content-middle-content">
			<?php echo esc_attr( king_social_share() ); ?>	
		</div>		
	</div><!-- .content-middle -->
	<span class="content-avatar">
		<?php
		$author = get_the_author_meta( 'user_nicename' );
		$author_id = $post->post_author;
		if ( get_field( 'author_image','user_' . $author_id ) ) { $image = get_field( 'author_image','user_' . $author_id );
		?>
		<a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_account'] . '/' . $author ); ?>">
			<img class="content-author-avatar" src="<?php  echo esc_url( $image['sizes']['thumbnail'] ); ?>" alt=""/>
		</a>	
		<?php } ?>
	</span>
</div>	
<div class="article-meta <?php echo esc_attr( $nothumb ); ?>">		

	<div class="article-meta-head">		
		<header class="entry-header">
			<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
			?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php

			$content = strip_shortcodes( get_the_content() );
			$content = wp_strip_all_tags( $content );
			echo esc_attr( substr( $content, 0, 100 ) );

			wp_link_pages( array(
				'before' => '<div class="page-links">',
				'after'  => '</div>',
			) );
				?>
			</div><!-- .entry-content -->
			<?php king_entry_cat(); ?>
		</div>
		<div class="entry-meta">
			<span class="post-likes"><i class="fa fa-thumbs-up" aria-hidden="true"></i>
				<?php
				$likes = get_post_meta( get_the_ID(), '_post_like_count', true );
				if ( ! empty( $likes ) ) {
					echo esc_attr( $likes );
				} else {
					echo '0';
				} ?></span>
				<span class="post-views"><i class="fa fa-eye" aria-hidden="true"></i><?php echo esc_attr( king_postviews( get_the_ID(), 'display' ) ); ?></span>
				<span class="post-comments"><i class="fa fa-comment" aria-hidden="true"></i><?php comments_number( ' 0 ', ' 1 ', ' % ' ); ?></span>
				<span class="post-time"><i class="fa fa-clock-o" aria-hidden="true"></i><?php the_time( 'F j, Y' ); ?></span>
			</div><!-- .entry-meta -->	
		</div><!-- .article-meta -->	
	</article><!--#post-##-->
