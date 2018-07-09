<?php
/**
 * Sinlge image page.
 *
 * @package King
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main post-page single-image">
		<?php if ( get_field( 'ads_above_content', 'option' ) ) : ?>
			<div class="ads-postpage"><?php $ad_above = get_field( 'ads_above_content','options' ); echo do_shortcode( $ad_above ); ?></div>
		<?php endif; ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( get_field( 'add_sponsor' ) ) : ?>
				<div class="add-sponsor"><a href="<?php the_field( 'post_sponsor_link' ); ?>" target="_blank"><img src="<?php the_field( 'post_sponsor_logo' ); ?>" /></a><span class="sponsor-label"><?php the_field( 'post_sponsor_description' ); ?></span></div>
			<?php endif; ?>	
				<div class="share-top">
					<div class="king-social-share">
						<span class="share-counter">
							<i><?php echo esc_attr( get_post_meta( get_the_ID(), 'share_counter', true ) ); ?> </i>
							<?php echo esc_html_e( ' shares','king' ); ?>
						</span>
						<?php echo esc_attr( king_social_share() ); ?>
						<div class="post-nav">
							<?php
							$next_post = get_next_post();
							if ( ! empty( $next_post ) ) : ?>
							<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" title="<?php echo esc_attr( $next_post->post_title ); ?>" class="prev-link" ><i class="fa fa-angle-left"></i></a>
						<?php endif; ?>
						<?php
						$prev_post = get_previous_post();
						if ( ! empty( $prev_post ) ) : ?>
						<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" title="<?php echo esc_attr( $prev_post->post_title ); ?>" class="prev-link" ><i class="fa fa-angle-right"></i></a>
					<?php endif; ?>
				</div>		
			</div>
		</div>
		<header class="entry-header">
			<?php
			if ( is_single() ) {
				the_title( '<h3 class="entry-title">', '</h3>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
			?>
		</header><!-- .entry-header -->
		<div class="post-page-featured-trending">
			<div class="post-like">
				<?php echo king_get_simple_likes_button( get_the_ID() ); ?>
				<?php  if ( ! is_user_logged_in() ) : ?>
					<div class="king-alert-like"><?php esc_html_e( 'Please ', 'king' ) ?><a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_login'] ); ?>"><?php esc_html_e( 'log in ', 'king' ) ?></a><?php esc_html_e( ' or ', 'king' ) ?><a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_register'] ); ?>"><?php esc_html_e( ' register ', 'king' ) ?></a><?php esc_html_e( ' to like posts. ', 'king' ) ?></div>
				<?php endif; ?>
			</div><!-- .post-like -->
			<a class="image-entry-format entry-format" href="<?php echo esc_url( get_post_format_link( 'image' ) ); ?>"><?php echo esc_html_e( 'Image', 'king' ) ?></a>
			<?php if ( get_field( 'featured-post' )  ||  get_field( 'keep_trending' ) ) : ?>		
				<?php if ( get_field( 'featured-post' ) ) : ?>
					<div class="featured"><i class="fa fa-rocket fa-lg" aria-hidden="true"></i><span><?php echo esc_html_e( 'featured', 'king' ) ?></span></div><!-- .featured -->
				<?php endif; ?>
				<?php if ( get_field( 'keep_trending' ) ) : ?>
					<div class="trending"><i class="fa fa-bolt fa-lg" aria-hidden="true"></i><span><?php echo esc_html_e( 'trending', 'king' ) ?></span></div><!-- .trending -->
				<?php endif; ?>
			<?php endif; ?>
		</div><!-- .post-page-featured-trending -->

<?php if ( get_field( 'nsfw_post' ) && ! is_user_logged_in() ) : ?>
	<div class="post-video nsfw-post-page">
		<a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_login'] ); ?>">
			<i class="fa fa-paw fa-3x"></i>
			<div><h1><?php echo esc_html_e( 'Not Safe For Work', 'king' ) ?></h1></div>
			<span><?php echo esc_html_e( 'Click to view this post.', 'king' ) ?></span>
		</a>	
	</div>
<?php else : ?>
			<div class="king-images owl-carousel">
				<div class="images-item">
					<?php if ( has_post_thumbnail() ) :
						echo get_the_post_thumbnail( get_the_ID(), 'full' );
					endif;
					?>		
				</div>
				<?php if ( have_rows( 'images_lists' ) ) : ?>

					<?php while ( have_rows( 'images_lists' ) ) : the_row();
						$image = get_sub_field( 'images_list' );
					?>
					<div class="images-item">				
						<?php if ( $image ) : ?>
							<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
						<?php endif; ?>
					</div>

				<?php endwhile; ?>
			<?php endif; ?>	
		</div>				

		<div class="entry-content">
			<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'king' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">',
				'after'  => '</div>',
			) );
				?>
			</div><!-- .entry-content -->


		<?php endif; ?>
		<footer class="entry-footer">
			<?php king_entry_footer(); ?>
		<div class="post-meta">
			<span class="post-views"><i class="fa fa-eye" aria-hidden="true"></i><?php echo esc_attr( king_postviews( get_the_ID(), 'display' ) ); ?></span>
			<span class="post-comments"><i class="fa fa-comment" aria-hidden="true"></i><?php comments_number( ' 0 ', ' 1 ', ' % ' ); ?></span>
			<span class="post-time"><i class="fa fa-clock-o" aria-hidden="true"></i><?php the_time( 'F j, Y' ); ?></span>
		</div>			
			<?php if ( is_super_admin() ) :
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'king' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			endif;	?>
				<div class="post-nav post-nav-mobile">
					<?php
					if ( ! empty( $next_post ) ) : ?>
						<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" title="<?php echo esc_attr( $next_post->post_title ); ?>" class="prev-link" ><i class="fa fa-angle-left"></i></a>
					<?php endif; ?>
					<?php
					if ( ! empty( $prev_post ) ) : ?>
						<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" title="<?php echo esc_attr( $prev_post->post_title ); ?>" class="prev-link" ><i class="fa fa-angle-right"></i></a>
					<?php endif; ?>
				</div><!-- .post-nav-mobile -->	
				</footer><!-- .entry-footer -->

			</div><!-- #post-## -->
			<?php if ( get_field( 'ads_below_content', 'option' ) ) : ?>
				<div class="ads-postpage"><?php $ad_below = get_field( 'ads_below_content','options' ); echo do_shortcode( $ad_below ); ?></div>
			<?php endif; ?>
		<?php if ( get_field( 'enable_reactions_without_comments', 'option' ) ) : ?>
			<?php echo king_reactions_box_buttons(); ?>
		<?php endif; ?>			
		<?php if ( get_field( 'enable_reactions', 'option' ) && get_field( 'display_reactions_block', 'option' ) ) : ?>				
			<div class="king-reactions-block">
				<h3><?php esc_html_e( 'Reactions', 'king' ); ?></h3>
				<?php echo wp_kses_post( king_reactions( get_the_ID() ) ); ?>
			</div><!-- .king-reactions-block -->
		<?php endif; ?>						
		<?php if ( get_field( 'display_who_liked', 'options' ) ) : ?>
					<div class="postlike-users">
						<?php
						$userlikes = get_post_meta( get_the_ID() , '_user_liked', true );
						if ( ! empty( $userlikes ) ) : ?>
						<div class="postlike-users-title"><?php the_field( 'who_liked_box_title', 'option' ) ?></div>	
						<?php
						$user_query = new WP_User_Query( array( 'include' => $userlikes, 'number' => 4, 'order' => 'DESC' ) );
							// User Loop.
						if ( ! empty( $user_query->results ) ) {
							foreach ( $user_query->results as $user ) {
								?>

								<a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_account'] . '/' . $user->user_login ); ?>" >
									<?php if ( get_field( 'author_image','user_' . $user->ID ) ) : $image = get_field( 'author_image','user_' . $user->ID ); ?>
										<img src="<?php echo esc_url( $image['sizes']['thumbnail'] ); ?>" alt="" />
									<?php else : ?>
										<span class="postlike-users-noavatar"></span>
									<?php endif; ?>
								</a>    

								<?php
							}
						}
						;else : ?>
						<h3><?php the_field( 'if_nobody_liked_box_title', 'option' ) ?></h3>
					<?php endif; ?> 
				</div><!-- .postlike-users -->
	<?php endif; ?> 
	
	<?php if ( ! get_field( 'hide_post_author_box', 'option' ) && get_option( 'permalink_structure' ) ) : ?>
		<?php get_template_part( 'template-parts/author-box' ); ?>
	<?php endif; ?>

	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

		endwhile; // End of the loop.
		?>

		<?php if ( get_field( 'display_related', 'options' ) ) : ?>
			<div class="king-related">
				<div class="related-title"><?php the_field( 'related_posts_heading', 'option' ) ?></div>
				<?php // Related Post Code Start.
				$relatednumber = get_field( 'related_length', 'options' );

				if ( get_field( 'display_related_posts_by', 'option' ) === 'categories' ) {

					// Get array of terms.
					$terms = get_the_terms( get_the_ID() , 'category' );
					// Pluck out the IDs to get an array of IDS.
					$relatedby = wp_list_pluck( $terms,'term_id' );
					$relatedby2 = 'category__in';

				} elseif ( get_field( 'display_related_posts_by', 'option' ) === 'tags' ) {

					// Get array of terms.
					$tagsterms = get_the_terms( get_the_ID() , 'post_tag', 'string' );
					// Pluck out the IDs to get an array of IDS.
					$relatedby = '123';
					if ( ! empty( $tagsterms ) ) {
						$relatedby = wp_list_pluck( $tagsterms,'term_id' );
					}

					$relatedby2 = 'tag__in';
				}

				$args = array(
					'' . $relatedby2 . '' => $relatedby,
					'post__not_in' => array( $post->ID ),
					'showposts' => $relatednumber,  // Number of related posts that will be shown.
					'ignore_sticky_posts' => 1,
					);

				$my_query = new wp_query( $args );
				if ( $my_query->have_posts() ) {
					while ( $my_query->have_posts() ) {
						$my_query->the_post();
						get_template_part( 'template-parts/content', 'simple-post' );
					}
					wp_reset_postdata();
				} else { ?>
				<div class="no-follower"><i class="fa fa-slack fa-2x" aria-hidden="true"></i><?php esc_html_e( 'Sorry, no posts were found', 'king' ); ?> </div>
				<?php }	?>
			</div> <!-- .king-related -->
		<?php endif; ?>	
<?php if ( get_post_status( $post->ID ) === 'pending' ) : ?>
	<div class="king-pending"><?php esc_html_e( 'This Image post will be checked and approved shortly.', 'king' ) ?></div>
<?php endif; ?>
<span class="remove-fixed"></span>
</main><!-- #main -->
<?php get_sidebar(); ?> 	

</div><!-- #primary -->	
<?php get_footer(); ?>
