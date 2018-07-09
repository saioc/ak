<?php
/**
 * The template for displaying quote posts.
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
<header class="page-top-header">
	<h1 class="page-title"><?php echo esc_html_e( 'News', 'king' ); ?></h1>
	<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
</header><!-- .page-header -->
<?php get_template_part( 'template-parts/king-header-nav' ); ?>	
<?php if ( get_field( 'select_default_display_option', 'options' ) ) {
	$display_option = get_field( 'select_default_display_option', 'options' );
} else {
	$display_option = 'king-grid';
}
?>		
<div id="primary" class="content-area">
	<div id="switchview" class="<?php echo esc_attr( $display_option ); ?>">
		<main id="main" class="site-main">

			<?php
			if ( have_posts() ) : ?>



			<?php
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
		</div> 		
	</div><!-- #primary -->

	<?php get_footer(); ?>
