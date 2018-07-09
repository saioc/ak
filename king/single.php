<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package king
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>
<?php
	// Hide Theme Switch in single page.
$GLOBALS['hide'] = 'hide';  ?>
<?php
	// Display Navbar.
get_template_part( 'template-parts/king-header-nav' ); ?>
<?php
if ( has_post_format( 'video' ) ) {

	get_template_part( 'template-parts/single','video' );

} elseif ( has_post_format( 'image' ) ) {

	get_template_part( 'template-parts/single','image' );

} else {

	get_template_part( 'template-parts/single','post' );

}
?>
<?php
	// Social Share Function.
king_social_shares( get_the_ID() ); ?>
<?php
	// Count Post Views.
king_postviews( get_the_ID(), 'count' ); ?>
