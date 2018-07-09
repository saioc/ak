<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package king
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0" />
<?php if ( get_field( 'custom_html_head','options' ) ) : ?>
	<?php the_field( 'custom_html_head','options' ); ?>
<?php endif; ?>
<?php if ( get_field( 'enable_meta_tags','options' ) ) {
	king_meta_tags();
} ?>
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>

	<body <?php body_class(); ?>>

		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'king' ); ?></a>

			<header id="masthead" class="site-header">
				<div class="king-header">
					<span class="king-head-toggle"  data-toggle="dropdown" data-target=".king-head-mobile" aria-expanded="false" role="button">
						<i class="fa fa-bars fa-lg" aria-hidden="true"></i>
					</span>
					<div class="site-branding">
						<?php if ( get_field( 'page_logo', 'options' ) ) : $logo = get_field( 'page_logo', 'options' ); ?>
							<a href="<?php echo esc_url( site_url() ); ?>" class="king-logo">
								<img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>"/>
							</a>
							<?php if ( get_field( 'mobile_page_logo', 'options' ) ) : $mobile_logo = get_field( 'mobile_page_logo', 'options' ); ?>
								<a href="<?php echo esc_url( site_url() ); ?>" class="mobile-king-logo">
									<img src="<?php echo esc_url( $mobile_logo['url'] ); ?>" alt="<?php echo esc_attr( $mobile_logo['alt'] ); ?>"/>
								</a>	
							<?php endif; ?>						
						<?php else : ?>
							<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
							<?php
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo esc_attr( $description ); ?></p>
						<?php endif; ?>
					<?php endif; ?>
				</div><!-- .site-branding -->
				<div class="king-head-nav">
					<?php if ( ! get_field( 'hide_news_Link', 'options' ) ) : ?>
						<a href="<?php echo esc_url( get_post_format_link( 'quote' ) ); ?>"><span class="nav-icon nav-news" ></span><?php echo esc_html_e( 'News', 'king' ) ?></a><?php endif; ?>
						<?php if ( ! get_field( 'hide_video_Link', 'options' ) ) : ?>
							<a href="<?php echo esc_url( get_post_format_link( 'video' ) ); ?>"><span class="nav-icon nav-video" ></span><?php echo esc_html_e( 'Video', 'king' ) ?></a><?php endif; ?>
							<?php if ( ! get_field( 'hide_image_Link', 'options' ) ) : ?>
								<a href="<?php echo esc_url( get_post_format_link( 'image' ) ); ?>"><span class="nav-icon nav-image" ></span><?php echo esc_html_e( 'Image', 'king' ) ?></a><?php endif; ?>
								<?php if ( have_rows( 'add_new_links_to_header', 'option' ) ) : ?>
									<?php while ( have_rows( 'add_new_links_to_header', 'option' ) ) : the_row(); ?>
										<a href="<?php the_sub_field( 'header_nav_url' ); ?>"><?php the_sub_field( 'header_nav_icon' ); ?><?php the_sub_field( 'header_nav_text' ); ?></a>
									<?php endwhile; ?>
								<?php endif; ?>			
								<?php if ( ! get_field( 'hide_categories', 'options' ) ) : ?>
									<span class="king-cat-dots" data-toggle="dropdown" data-target=".king-cat-list" aria-expanded="false" role="button">...</span>
									<div class="king-cat-list">
										<ul>
											<?php wp_list_categories( array(
												'orderby'    => 'name',
												'hide_title_if_empty' => true,
												'title_li' => '',
											) ); ?>
											</ul>
										</div>
									<?php endif; ?>
								</div><!-- .king-head-nav -->

								<div class="king-logged-user">
									<?php if ( ! is_user_logged_in() ) : ?>

										<div class="king-login-buttons">
										<?php if ( get_option( 'permalink_structure' ) ) :
											global $wp;
										?>
											<a data-toggle="modal" data-target="#myModal" href="#" class="header-login"><i class="fa fa-user" aria-hidden="true"></i><?php esc_html_e( ' Login ', 'king' ) ?></a>
										<?php else : ?>
											<a href="<?php echo esc_url( wp_login_url( home_url() ) ); ?>" class="header-login"><i class="fa fa-user" aria-hidden="true"></i><?php esc_html_e( ' Login ', 'king' ) ?></a>
										<?php endif; ?>
											<?php if ( get_option( 'users_can_register' ) && get_option( 'permalink_structure' ) ) : ?>
													<a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_register'] ); ?>" class="header-register"><i class="fa fa-globe" aria-hidden="true"></i><?php esc_html_e( ' Register ', 'king' ) ?></a>									
											<?php endif; ?>
										</div>

									<?php else :
									global $current_user;
									wp_get_current_user();
									?>

									<div class="king-username">
										<?php if ( get_field( 'author_image','user_' . get_current_user_id() ) ) : $image = get_field( 'author_image','user_' . get_current_user_id() ); ?>
											<img class="user-header-avatar" src="<?php echo esc_url( $image['sizes']['thumbnail'] ); ?>" data-toggle="dropdown" data-target=".user-header-menu" aria-expanded="false"/>
										<?php else : ?>
											<span class="user-header-noavatar" data-toggle="dropdown" data-target=".user-header-menu" aria-expanded="false"></span>
										<?php endif; ?>
										<?php $prvt_msg = get_user_meta( $current_user->ID, 'king_prvtmsg_notify', true );
										if ( $prvt_msg ) {
											echo '<i class="prvt-dote"></i>';
										}
										?>
										<div class="user-header-menu">
										<?php if ( get_option( 'permalink_structure' ) ) : ?>
											<div class="user-header-profile" >
												<a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_account'] ); ?>" ><?php echo esc_attr( $current_user->display_name ); ?></a>
												<?php if ( get_field( 'enable_user_points', 'options' ) ) : ?>
													<div class="king-points" title="<?php echo esc_html_e( 'Points','king' ); ?>"><i class="fa fa-star" aria-hidden="true"></i> <?php echo get_user_meta( $current_user->ID, 'king_user_points', true ); ?></div>
												<?php endif; ?>
											</div>
											<a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_account'] . '/settings' ); ?>" class="user-header-settings"><?php echo esc_html_e( 'My Settings','king' ); ?></a>
											<?php if ( get_field( 'enable_private_messages', 'options' ) ) : ?>
											<a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_prvtmsg'] ); ?>" class="user-header-prvtmsg"><?php echo esc_html_e( 'Inbox','king' ); ?><?php if ( $prvt_msg ) : ?><span class="header-prvtmsg-nmbr"><?php echo esc_attr( $prvt_msg ); ?></span><?php endif; ?></a>
											<?php endif; ?>
											<a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_dashboard'] ); ?>" class="user-header-dashboard"><?php echo esc_html_e( 'My Dashboard','king' ); ?></a>
										<?php endif; ?>	
											<?php if ( is_super_admin() || current_user_can( 'editor' ) ) : ?>
												<a href="<?php echo esc_url( get_admin_url() ); ?>" class="user-header-admin"><?php echo esc_html_e( 'Admin Panel','king' ); ?></a>
											<?php endif; ?>
											<a href="<?php echo esc_url( wp_logout_url( site_url() ) ); ?>" class="user-header-logout"><?php echo esc_html_e( 'Logout','king' ); ?></a>
										</div>
									</div>
								<?php endif; ?>
							</div><!-- .king-logged-user -->


							<?php if ( get_field( 'disable_users_submit', 'options' ) !== true ) : ?>
								<?php if ( get_option( 'permalink_structure' ) ) : ?>
								<div class="king-submit">
									<span class="king-submit-open"  data-toggle="dropdown" data-target=".king-submit" aria-expanded="false" role="button"><i class="fa fa-plus fa-lg" aria-hidden="true"></i></span>
									<ul class="king-submit-buttons">
										<?php if ( get_field( 'disable_news', 'options' ) !== true ) : ?>
											<li><a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_snews'] ); ?>"><?php echo esc_html_e( 'News', 'king' ) ?><i class="fa fa-align-left" aria-hidden="true"></i></a></li>
										<?php endif; ?>
										<?php if ( get_field( 'disable_video', 'options' ) !== true ) : ?>
											<li><a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_svideo'] ); ?>"><?php echo esc_html_e( 'Video', 'king' ) ?><i class="fa fa-video-camera" aria-hidden="true"></i></a></li>
										<?php endif; ?>
										<?php if ( get_field( 'disable_image', 'options' ) !== true ) : ?>
											<li><a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_simage'] ); ?>"><?php echo esc_html_e( 'Image', 'king' ) ?><i class="fa fa-picture-o" aria-hidden="true"></i></a></li>
										<?php endif; ?>
									</ul>
								</div><!-- .king-submit -->
								<?php endif; ?>
							<?php endif; ?>
							<div class="king-search-top">
								<div class="king-search">
									<form role="search" method="get" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
										<input type="search" class="header-search-field"
										placeholder="<?php echo esc_html_e( 'Search …', 'king' ); ?>"
										value="<?php echo get_search_query(); ?>" name="s" autocomplete="off"
										title="<?php echo esc_html_e( 'Search for:', 'king' ); ?>" />
										<button type="submit" class="header-search-submit"
										value=""><i class="fa fa-search fa-2x" aria-hidden="true"></i> </button>
									</form>
									<span class="search-close"><i class="fa fa-times fa-2x" aria-hidden="true"></i></span>
								</div>
							</div><!-- .king-search-top -->

						</div><!-- .king-header -->
						<div class="king-head-mobile">
							<button class="king-head-mobile-close" type="button" data-toggle="dropdown" data-target=".king-head-mobile" aria-expanded="false"><i class="fa fa-times fa-2x" aria-hidden="true"></i></button>
						<?php if ( ! get_field( 'hide_news_Link', 'options' ) ) : ?>
							<a href="<?php echo esc_url( get_post_format_link( 'quote' ) ); ?>"><span class="nav-icon nav-news" ></span><?php echo esc_html_e( 'News', 'king' ) ?></a><?php endif; ?>
						<?php if ( ! get_field( 'hide_video_Link', 'options' ) ) : ?>
							<a href="<?php echo esc_url( get_post_format_link( 'video' ) ); ?>"><span class="nav-icon nav-video" ></span><?php echo esc_html_e( 'Video', 'king' ) ?></a><?php endif; ?>
						<?php if ( ! get_field( 'hide_image_Link', 'options' ) ) : ?>
							<a href="<?php echo esc_url( get_post_format_link( 'image' ) ); ?>"><span class="nav-icon nav-image" ></span><?php echo esc_html_e( 'Image', 'king' ) ?></a><?php endif; ?>
								<?php if ( have_rows( 'add_new_links_to_header', 'option' ) ) : ?>
									<?php while ( have_rows( 'add_new_links_to_header', 'option' ) ) : the_row(); ?>
										<a href="<?php the_sub_field( 'header_nav_url' ); ?>"><?php the_sub_field( 'header_nav_icon' ); ?><?php the_sub_field( 'header_nav_text' ); ?></a>
									<?php endwhile; ?>
								<?php endif; ?>
							<div class="king-cat-list-mobile">
								<ul>
									<?php wp_list_categories( array(
										'orderby'    => 'name',
										'hide_title_if_empty' => true,
										'title_li' => '',
									) ); ?>
									</ul>
								</div>
							</div><!-- .king-head-mobile -->
						</header><!-- #masthead -->

						<div id="content" class="site-content">
