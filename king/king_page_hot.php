<?php
/**
 * The template for displaying the Hot page
 *
 * Template Name: hot
 *
 * @package King
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header(); ?>
<header class="page-top-header hot">
	<h1 class="page-title"><?php esc_html_e( 'HOT!', 'king' ); ?></h1>
</header><!-- .page-header -->
<?php get_template_part( 'template-parts/king-header-nav' ); ?>
<?php if ( get_field( 'select_default_display_option','options' ) ) {
	$display_option = get_field( 'select_default_display_option', 'options' );
} else {
	$display_option = 'king-grid';
}
?>

<div id="primary" class="content-area king-hot">
	<div id="switchview" class="<?php echo esc_attr( $display_option ); ?>">
		<main id="main" class="site-main full-width">

			<div class="king-order-nav">
				<ul>
					<li>
						<a class="<?php if ( ! isset( $_GET['orderby'] ) ) { echo 'active'; } ?>" href="<?php echo esc_url( get_permalink() ); ?>" ><?php esc_html_e( 'HOT!', 'king' ); ?></a>
					</li>
					<li>
						<a href="<?php echo esc_url( get_permalink() . '?orderby=views' ); ?>" class="<?php if ( isset( $_GET['orderby'] ) && $_GET['orderby'] === 'views' ) {  echo 'active'; } ?>"><?php esc_html_e( 'Views', 'king' ); ?></a>
					</li>
					<li>
						<a href="<?php echo esc_url( get_permalink() . '?orderby=votes' ); ?>" class="<?php if ( isset( $_GET['orderby'] ) && $_GET['orderby'] === 'votes' ) { echo 'active'; } ?>"><?php esc_html_e( 'Votes', 'king' ); ?></a>
					</li>   
					<li>
						<a href="<?php echo esc_url( get_permalink() . '?orderby=comments' ); ?>" class="<?php if ( isset( $_GET['orderby'] ) && $_GET['orderby'] === 'comments' ) { echo 'active'; } ?>"><?php esc_html_e( 'Comments', 'king' ); ?></a>
					</li>       
				</ul>
			</div>

			<?php
			if ( have_posts() ) :
				/* Start the Loop */

				$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

				if ( get_field( 'length_hot', 'options' ) ) {
					$length_hot = get_field( 'length_hot', 'option' );
				} else {
					$length_hot = '10';
				}

				if ( isset( $_GET['orderby'] ) &&  $_GET['orderby'] === 'views' ) { // input var okay; sanitization.

					$args = array( 'posts_per_page' => $length_hot, 'meta_key' => '_post_views', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'paged' => $paged );

				} elseif ( isset( $_GET['orderby'] ) && $_GET['orderby'] === 'votes' ) { // input var okay; sanitization.

					$args = array( 'posts_per_page' => $length_hot, 'meta_key' => '_post_like_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'paged' => $paged );

				} elseif ( isset( $_GET['orderby'] ) && $_GET['orderby'] === 'comments' ) { // input var okay; sanitization.

					$args = array( 'posts_per_page' => $length_hot, 'orderby' => 'comment_count', 'order' => 'DESC', 'paged' => $paged );

				} else {

					$args = array(
					'posts_per_page'  => $length_hot,
					'paged' => $paged,
					'meta_query'      => array(
						'relation'    => 'AND',
						'_post_views' => array(
							'key'     => '_post_views',
							'type'    => 'NUMERIC',
							'compare' => 'LIKE',
							),
						'_post_like_count' => array(
							'key'     => '_post_like_count',
							'type'    => 'NUMERIC',
							'compare' => 'LIKE',
							),
						),
					'orderby' => array(
						'_post_views' => 'DESC',
						'_post_like_count' => 'DESC',
						),
					'post__not_in' => get_option( 'sticky_posts' ),
					);

				}

				$hot = new WP_Query( $args );

				while ( $hot->have_posts() ) : $hot->the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

				?>
				<div class="king-pagination">
					<?php

							$big = 999999999; // need an unlikely integer.
							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var( 'paged' ) ),
								'total' => $hot->max_num_pages,
								'prev_next'    => true,
								'prev_text'          => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
								'next_text'          => '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
							) );
								?>
							</div>
							<?php wp_reset_postdata(); ?>
							<?php else :

								get_template_part( 'template-parts/content', 'none' );

							endif; ?>

						</main><!-- #main -->
					</div>
				</div><!-- #primary -->

				<?php get_footer(); ?>
