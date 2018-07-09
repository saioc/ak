<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package king
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<header class="page-top-header">
	<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'king' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
</header><!-- .page-top-header -->
<?php get_template_part( 'template-parts/king-header-nav' ); ?>
<?php if ( get_field( 'select_default_display_option', 'options' ) ) {
	$display_option = get_field( 'select_default_display_option', 'options' );
} else {
	$display_option = 'king-grid';
}
?>
<section id="primary" class="content-area">
	<div id="switchview" class="<?php echo esc_attr( $display_option ); ?>">
		<main id="main" class="site-main full-width">		

			<?php
			if ( have_posts() ) : ?>



			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

				the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>


			</main><!-- #main -->
		</div>	
	</section><!-- #primary -->

	<?php get_footer(); ?>
