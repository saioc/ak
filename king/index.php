<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package king
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>
<?php if ( is_front_page() && is_home() && get_field( 'display_slider', 'options' ) ) : ?>	
	<?php get_template_part( 'template-parts/king-featured-posts' ); ?>
<?php endif; ?>
<?php get_template_part( 'template-parts/king-header-nav' ); ?>

<?php if ( get_field( 'select_default_display_option','options' ) ) {
	$display_option = get_field( 'select_default_display_option', 'options' );
} else {
	$display_option = 'king-grid';
}
?>
<div id="primary" class="content-area">
	<div id="switchview" class="<?php echo esc_attr( $display_option ); ?>">
		<?php if ( get_field( 'ad_main_area_top','options' ) ) : ?>
			<div class="king-ads main-top"><?php $ad_top = get_field( 'ad_main_area_top','options' ); echo do_shortcode( $ad_top ); ?></div>
		<?php endif; ?>		
		<main id="main" class="site-main">	

			<?php
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) : ?>
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>

			<?php
			endif;

				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				endwhile;

				the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

			</main><!-- #main -->
			<?php get_sidebar(); ?> 
		</div><!-- #switchview -->		
	</div><!-- #primary -->

<?php get_footer(); ?>
