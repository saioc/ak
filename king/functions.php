<?php
/**
 * King functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package king
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * King Paths.
 */
define( 'KING_THEME_DIR', get_template_directory() );
define( 'KING_INCLUDES_PATH', get_template_directory() . '/includes/' );
define( 'KING_THEME_URI', get_template_directory_uri() );

/**
 * Register ACF
 */
if ( class_exists( 'Acf' ) ) {
	define( 'ACF_LITE' , true );
}

/**
 * Acf options page settings.
 */
if ( function_exists( 'acf_add_options_page' ) ) {

	// Add parent.
	$parent = acf_add_options_page(array(
		'page_title' 	=> esc_html__( 'Theme General Settings', 'king' ),
		'menu_title' 	=> 'King',
		'capability'	=> 'edit_posts',
		'icon_url' => 'dashicons-image-filter',
		'redirect' 		=> true,
	));

	// Add sub page.
	acf_add_options_sub_page(array(
		'page_title' 	=> esc_html__( 'King 设置', 'king' ),
		'menu_title' 	=> 'Settings',
		'parent_slug' 	=> $parent['menu_slug'],
	));
	// Add sub page.
	acf_add_options_sub_page(array(
		'page_title' 	=> esc_html__( 'King 布局', 'king' ),
		'menu_title' 	=> 'Layout',
		'parent_slug' 	=> $parent['menu_slug'],
	));
	// Add sub page.
	acf_add_options_sub_page(array(
		'page_title' 	=> esc_html__( 'King 目录', 'king' ),
		'menu_title' 	=> 'Lists',
		'parent_slug' 	=> $parent['menu_slug'],
	));
	// Add sub page.
	acf_add_options_sub_page(array(
		'page_title' 	=> esc_html__( 'King 定制', 'king' ),
		'menu_title' 	=> 'Customize',
		'parent_slug' 	=> $parent['menu_slug'],
	));
}

if ( ! is_admin() && ! function_exists( 'get_field' ) ) {
	function get_field( $key ) {
		return get_post_meta( get_the_ID(), $key, true );
	}
	function the_field( $key ) {
		return get_post_meta( get_the_ID(), $key, true );
	}
	function acf_form_head() {
		return false;
	}
	function have_rows() {
		return false;
	}
	function get_field_object() {
		return false;
	}
}

/**
 * Acf options.
 */
require( KING_INCLUDES_PATH . 'acf-options.php' );

if ( ! function_exists( 'king_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function king_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on king, use a find and replace
		 * to change 'king' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'king', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'king' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'quote',
			'image',
			'video',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'king_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
	}
endif;
add_action( 'after_setup_theme', 'king_setup' );

/**
 * TGM Plugin.
 */
require_once( KING_INCLUDES_PATH . 'class-tgm-plugin-activation.php' );

/**
 * TGM options.
 */
function king_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'ACF Pro Plugin', // The plugin name.
			'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/includes/plugins/advanced-custom-fields-pro.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '5.6.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),
	);
	$config = array(
		'id'           => 'king',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'advanced-custom-fields-pro', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'king_register_required_plugins' );

/**
 * Social Login Files.
 */
require_once( KING_INCLUDES_PATH . 'social/facebookoauth.php' );
require_once( KING_INCLUDES_PATH . 'social/googleplusoauth.php' );

/**
 * Widgets
 */
require_once( KING_INCLUDES_PATH . 'widgets/king-widget-recent.php' );
require_once( KING_INCLUDES_PATH . 'widgets/king-widget-mostcommented.php' );
require_once( KING_INCLUDES_PATH . 'widgets/king-widget-trending.php' );
require_once( KING_INCLUDES_PATH . 'widgets/king-widget-hot.php' );
require_once( KING_INCLUDES_PATH . 'widgets/king-widget-related.php' );
require_once( KING_INCLUDES_PATH . 'widgets/king-widget-topusers.php' );
require_once( KING_INCLUDES_PATH . 'widgets/king-widget-leaderboard.php' );

/**
 * Check whether the plugin is active and theme can rely on it
 *
 * @param string $plugin Base plugin path.
 * @return bool
 */
function king_plugin_active( $plugin ) {
	// Detect plugin. For use on Front End only.
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	return is_plugin_active( $plugin );
}

/**
 * Only search posts.
 *
 * @param [type] $query search query.
 *
 * @return mixed
 */
function king_search_filter( $query ) {
	if ( $query->is_search ) {
		$query->set( 'post_type', 'post' );
	}
	return $query;
}

add_filter( 'pre_get_posts','king_search_filter' );

/**
 * Rename quote post format as news.
 *
 * @param [type] $safe_text safe text.
 *
 * @return mixed
 */
function king_rename_post_formats( $safe_text ) {
	if ( 'Quote' === $safe_text ) {
		return 'News';
	}
	return $safe_text;
}
add_filter( 'gettext_with_context', 'king_rename_post_formats' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function king_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'king_content_width', 640 );
}
add_action( 'after_setup_theme', 'king_content_width', 0 );


/**
 * King Js files
 */
function king_scripts_enqueue() {
	global $wp_query;
	wp_enqueue_script( 'king_main_script', KING_THEME_URI . '/layouts/js/main.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'king_main_script', 'mainscript', array(
		'itemslength' => get_field( 'items_length','options' ),
		'infinitenumber' => get_field( 'load_more_button_show','options' ),
	) );
	wp_enqueue_script( 'bootstrap-js', KING_THEME_URI . '/layouts/js/bootstrap.min.js', array( 'jquery' ), null, false );

	if ( $wp_query->get( 'bpsnews' ) || $wp_query->get( 'bpsvideo' ) || $wp_query->get( 'bpsimage' ) || $wp_query->get( 'bpupdte' ) ) {
		wp_enqueue_script( 'tagsinput', KING_THEME_URI . '/layouts/js/jquery.tagsinput.min.js',  array(), null, true );
		wp_enqueue_script( 'tinymce', KING_THEME_URI . '/layouts/js/tinymce/tinymce.min.js',  array(), null, true );
		wp_enqueue_script( 'king_submit_script', KING_THEME_URI . '/layouts/js/submit.js', array( 'jquery' ), '1.0', true );
	}
	wp_enqueue_script( 'infinite_ajax', KING_THEME_URI . '/layouts/js/jquery-ias.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'sticky-kit', KING_THEME_URI . '/layouts/js/sticky-kit.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'owl_carousel', KING_THEME_URI . '/layouts/js/owl.carousel.min.js', array( 'jquery' ), '1.0', false );
	if ( $wp_query->get( 'bpregister' ) ) {
		wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js', array(), null, true );
	}
	if ( ! is_front_page() ) {
		wp_enqueue_script( 'king_simple-likes-public-js', KING_THEME_URI . '/layouts/js/post-like.js', array( 'jquery' ), '0.5', true );
		wp_localize_script( 'king_simple-likes-public-js', 'simpleLikes', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'like' => esc_html__( 'Like', 'king' ),
			'unlike' => esc_html__( 'Unlike', 'king' ),
		) );
	}
	if ( ! is_front_page() && ! is_single() || $wp_query->get( 'bpaccount' ) || $wp_query->get( 'bplike' ) || $wp_query->get( 'bpfollower' ) || $wp_query->get( 'bpfollowing' ) ) {
		wp_enqueue_script( 'king_simple-follows-public-js', KING_THEME_URI . '/layouts/js/user-follow.js', array( 'jquery' ), '0.5', false );
		wp_localize_script( 'king_simple-follows-public-js', 'simpleFollows', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'follow' => esc_html__( 'Follow', 'king' ),
			'unfollow' => esc_html__( 'Unfollow', 'king' ),
		) );
	}
	if ( is_single() ) {
		if ( get_field( 'enable_ad_video','options' ) ) {
			wp_enqueue_script( 'loading_ad', get_template_directory_uri() . '/layouts/js/loading-ad.js', array( 'jquery' ), '1.0', true );
			wp_localize_script( 'loading_ad', 'loadingad', array(
				'second' => get_field( 'skip_ad_after','options' ),
			) );
		}
		wp_enqueue_script( 'fixed_bar', get_template_directory_uri() . '/layouts/js/fixed-bar.js', array( 'jquery' ), '1.0', false );
	}
}
add_action( 'wp_enqueue_scripts', 'king_scripts_enqueue' );
/**
 * ACF custom style
 */
function king_generate_options_css() {
	global $wp_filesystem;
	if ( empty( $wp_filesystem ) ) {
		require_once( ABSPATH . '/wp-admin/includes/file.php' );
		WP_Filesystem();
	}

	$css_dir = KING_THEME_DIR . '/layouts/';
	$css_php_dir = KING_THEME_DIR . '/layouts/';
	ob_start();
	require( $css_php_dir . 'custom-styles.php' );
	$css = ob_get_clean();
	if ( $wp_filesystem ) {
		$wp_filesystem->put_contents(
			$css_dir . 'custom-styles.css', $css, FS_CHMOD_FILE
		);
	}
}
add_action( 'acf/save_post', 'king_generate_options_css' ); // Parse the output and write the CSS file on post save.

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function king_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( '侧边栏', 'king' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( '在这里添加小部件', 'king' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'king_widgets_init' );

/*
 * Post format links rewrite.
 */
function king_get_post_format_slugs() {

	$slugs = array(
		'aside'   => 'asides',
		'audio'   => 'audio',
		'chat'    => 'chats',
		'gallery' => 'galleries',
		'image'   => 'images',
		'link'    => 'links',
		'quote'   => 'news',
		'status'  => 'status-updates',
		'video'   => 'videos',
		);

	return $slugs;
}
/* Remove core WordPress filter. */
remove_filter( 'term_link', '_post_format_link', 10 );

/* Add custom filter. */
add_filter( 'term_link', 'king_post_format_link', 10, 3 );

/**
 * Filters post format links to use a custom slug.
 *
 * @param string $link The permalink to the post format archive.
 * @param object $term The term object.
 * @param string $taxnomy The taxonomy name.
 * @return string
 */
function king_post_format_link( $link, $term, $taxonomy ) {
	global $wp_rewrite;

	if ( 'post_format' !== $taxonomy ) {
		return $link;
	}

	$slugs = king_get_post_format_slugs();

	$slug = str_replace( 'post-format-', '', $term->slug );
	$slug = isset( $slugs[ $slug ] ) ? $slugs[ $slug ] : $slug;

	if ( $wp_rewrite->get_extra_permastruct( $taxonomy ) ) {
		$link = str_replace( "/{$term->slug}", '/' . $slug, $link );
	} else {
		$link = add_query_arg( 'post_format', $slug, remove_query_arg( 'post_format', $link ) );
	}

	return $link;
}
/* Remove the core WordPress filter. */
remove_filter( 'request', '_post_format_request' );

/* Add custom filter. */
add_filter( 'request', 'king_post_format_request' );

/**
 * Changes the queried post format slug to the slug saved in the database.
 *
 * @param array $qvs The queried variables.
 * @return array
 */
function king_post_format_request( $qvs ) {

	if ( ! isset( $qvs['post_format'] ) ) {
		return $qvs;
	}

	$slugs = array_flip( king_get_post_format_slugs() );

	if ( isset( $slugs[ $qvs['post_format'] ] ) ) {
		$qvs['post_format'] = 'post-format-' . $slugs[ $qvs['post_format'] ];
	}

	$tax = get_taxonomy( 'post_format' );

	if ( ! is_admin() ) {
		$qvs['post_type'] = $tax->object_type;
	}

	return $qvs;
}

/**
 * Footer Widgets Area
 */
function king_footer_widgets_init() {

	// First footer widget area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => esc_html__( '第一个页脚小工具区', 'king' ),
		'id' => 'first-footer-widget-area',
		'description' => esc_html__( '第一个页脚小部件区域', 'king' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Second Footer Widget Area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => esc_html__( '第二页脚小部件区域', 'king' ),
		'id' => 'second-footer-widget-area',
		'description' => esc_html__( '第二个页脚小部件区域', 'king' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Third Footer Widget Area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => esc_html__( '第三个页脚小工具区', 'king' ),
		'id' => 'third-footer-widget-area',
		'description' => esc_html__( '第三个页脚小部件区域', 'king' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Fourth Footer Widget Area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => esc_html__( '第四个页脚小工具区', 'king' ),
		'id' => 'fourth-footer-widget-area',
		'description' => esc_html__( '第四个页脚小部件区域', 'king' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
// Register sidebars by running king_footer_widgets_init() on the widgets_init hook.
add_action( 'widgets_init', 'king_footer_widgets_init' );

/**
 * Register Fonts.
 *
 * @return font_url.
 */
function king_google_fonts_url() {
	$font_url = '';

	/*
	Translators: If there are characters in your language that are not supported
	by chosen font(s), translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'king' ) ) {
		if ( get_field( 'google_fonts','options' ) ) :
			$font = get_field_object( 'google_fonts', 'options' );
			$value = $font['value'];
			$fontfamily = $font['choices'][ $value ];
				$font_url = add_query_arg( 'family', urlencode( '' . esc_attr( $fontfamily ) . ':400,300,600,700,400italic' ), '//fonts.googleapis.com/css' );
			;else :
				$font_url = add_query_arg( 'family', urlencode( 'Open Sans:400,300,600,700,400italic' ), '//fonts.googleapis.com/css' );
		endif;
	}
	return esc_url_raw( $font_url );
}

/**
 * Enqueue scripts and styles.
 */
function king_scripts() {
	wp_enqueue_style( 'king-style', get_stylesheet_uri() );
	if ( king_plugin_active( 'woocommerce/woocommerce.php' ) ) {
		wp_enqueue_style( 'king-shop-style', KING_THEME_URI . '/woocommerce/css/woocommerce.css' );
	}	
	wp_enqueue_style( 'custom-styles', KING_THEME_URI . '/layouts/custom-styles.css' );
	wp_enqueue_style( 'googlefont-style', king_google_fonts_url(), array(), '1.0.0' );
	wp_enqueue_style( 'font-awesome-style', KING_THEME_URI . '/layouts/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_script( 'king-skip-link-focus-fix', KING_THEME_URI . '/layouts/js/skip-link-focus-fix.js', array(), '20151215', true );
	if ( is_singular() && has_post_format( 'video' ) ) {
		wp_enqueue_script( 'video-js', KING_THEME_URI . '/layouts/js/videojs/video.min.js', array( 'jquery' ), '1.0', false );
		wp_enqueue_style( 'video-js-style', KING_THEME_URI . '/layouts/js/videojs/video-js.css' );
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'king_scripts' );

/**
 * Disable default WP admin bar for users.
 * @param  [type] $user_id [description]
 * @return [type]          [description]
 */
function king_set_user_admin_bar_false_by_default( $user_id ) {
	update_user_meta( $user_id, 'show_admin_bar_front', 'false' );
	update_user_meta( $user_id, 'show_admin_bar_admin', 'false' );
}
add_action( 'user_register', 'king_set_user_admin_bar_false_by_default', 10, 1 );

/**
 * Disable Pesonal Uploads
 *
 * @param [type] $existing_mimes existing mimes.
 * @return array
 */
function king_disallow_personal_uploads( $existing_mimes = array() ) {
	// remove ZIP files.
	unset( $existing_mimes['zip'] );
	// return amended array.
	return $existing_mimes;
}

// Call our function when appropriate.
add_filter( 'upload_mimes', 'king_disallow_personal_uploads' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/includes/customizer-head.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

// Theme main functions.
require get_template_directory() . '/includes/theme.php';

/*Globals*/
global $king_account;
global $king_edit;
global $king_login;
global $king_register;
global $king_reset;
global $king_likes;
global $king_snews;
global $king_svideo;
global $king_simage;
global $king_followers;
global $king_following;
global $king_dashboard;
global $king_prvtmsg;
global $king_updte;
global $hide;

/**
 * Init globals.
 */
function king_init_globals() {
	global $king_account;
	global $king_likes;
	global $king_edit;
	global $king_login;
	global $king_register;
	global $king_reset;
	global $king_snews;
	global $king_svideo;
	global $king_simage;
	global $king_followers;
	global $king_following;
	global $king_dashboard;
	global $king_prvtmsg;
	global $king_updte;
	global $hide;
	$king_account = 'profile';
	$king_likes = 'likes';
	$king_followers = 'followers';
	$king_following = 'following';
	$king_edit = 'settings';
	$king_login = 'login';
	$king_register = 'register';
	$king_reset = 'reset';
	$king_snews = 'submit-news';
	$king_svideo = 'submit-video';
	$king_simage = 'submit-image';
	$king_dashboard = 'dashboard';
	$king_prvtmsg = 'prvtmsg';
	$king_updte = 'updte';
}
add_action( 'init','king_init_globals' );
/*Custom Rewrite Rules*/

/**
 * Init globals.
 */
function king_add_rewrite_rules() {
	add_rewrite_rule( '^' . $GLOBALS['king_account'] . '/settings?','index.php?bpsettings=1','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_account'] . '/([^/]*)/?','index.php?bpaccount=1&profile_id=$matches[1]','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_account'] . '/?','index.php?bpaccount=1','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_likes'] . '/([^/]*)/?','index.php?bplike=1&profile_id=$matches[1]','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_likes'] . '/?','index.php?bplike=1','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_followers'] . '/([^/]*)/?','index.php?bpfollower=1&profile_id=$matches[1]','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_followers'] . '/?','index.php?bpfollower=1','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_following'] . '/([^/]*)/?','index.php?bpfollowing=1&profile_id=$matches[1]','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_following'] . '/?','index.php?bpfollowing=1','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_dashboard'] . '/?','index.php?bpdashboard=1','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_prvtmsg'] . '/([^/]*)/?','index.php?bpprvtmsg=1&profile_id=$matches[1]','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_prvtmsg'] . '/?','index.php?bpprvtmsg=1','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_login'] . '/?','index.php?bplogin=1','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_register'] . '/?','index.php?bpregister=1','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_reset'] . '/?','index.php?bpreset=1','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_snews'] . '/?','index.php?bpsnews=1','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_svideo'] . '/?','index.php?bpsvideo=1','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_simage'] . '/?','index.php?bpsimage=1','top' );
	add_rewrite_rule( '^' . $GLOBALS['king_updte'] . '/?','index.php?bpupdte=1','top' );
}
add_action( 'init', 'king_add_rewrite_rules' );



/**
 * Query vars.
 *
 * @param query $query_vars queries.
 *
 * @return mixed
 */
function king_query_vars( $query_vars ) {
	$query_vars[] = 'list';
	$query_vars[] = 'rowid';
	$query_vars[] = 'bpaccount';
	$query_vars[] = 'bplike';
	$query_vars[] = 'bpfollower';
	$query_vars[] = 'bpfollowing';
	$query_vars[] = 'bpdashboard';
	$query_vars[] = 'bpprvtmsg';
	$query_vars[] = 'bplogin';
	$query_vars[] = 'bpregister';
	$query_vars[] = 'bpreset';
	$query_vars[] = 'bpsnews';
	$query_vars[] = 'bpsvideo';
	$query_vars[] = 'bpsimage';
	$query_vars[] = 'bpsettings';
	$query_vars[] = 'bpupdte';
	$query_vars[] = 'profile_id';
	return $query_vars;
}
add_filter( 'query_vars', 'king_query_vars' );
/**
 * Template redirects
 */
function king_template_redirects() {
	global $wp_query;
	if ( $wp_query->get( 'bpaccount' ) ) :
		get_template_part( 'user','profile' );
		exit();
	endif;
	if ( $wp_query->get( 'bplike' ) ) :
		get_template_part( 'user','likes' );
		exit();
	endif;
	if ( $wp_query->get( 'bpfollower' ) ) :
		get_template_part( 'user','followers' );
		exit();
	endif;
	if ( $wp_query->get( 'bpfollowing' ) ) :
		get_template_part( 'user','following' );
		exit();
	endif;
	if ( $wp_query->get( 'bpdashboard' ) ) :
		get_template_part( 'user','dashboard' );
		exit();
	endif;
	if ( $wp_query->get( 'bpprvtmsg' ) ) :
		get_template_part( 'template','messages' );
		exit();
	endif;
	if ( $wp_query->get( 'bpupdte' ) ) :
		get_template_part( 'template','edit-post' );
		exit();
	endif;
	if ( $wp_query->get( 'bplogin' ) ) :
		get_template_part( 'template','login' );
		exit();
	endif;
	if ( $wp_query->get( 'bpregister' ) ) :
		get_template_part( 'template','register' );
		exit();
	endif;
	if ( $wp_query->get( 'bpreset' ) ) :
		get_template_part( 'template','reset' );
		exit();
	endif;
	if ( $wp_query->get( 'bpsnews' ) ) :
		get_template_part( 'template','submit-news' );
		exit();
	endif;
	if ( $wp_query->get( 'bpsvideo' ) ) :
		get_template_part( 'template','submit-video' );
		exit();
	endif;
	if ( $wp_query->get( 'bpsimage' ) ) :
		get_template_part( 'template','submit-image' );
		exit();
	endif;
	if ( $wp_query->get( 'bpsettings' ) ) :
		get_template_part( 'user','settings' );
		exit();
	endif;
}
add_filter( 'template_redirect', 'king_template_redirects' );

/**
 * Google Login Js Files
 */
function king_googleplus_oauth_callback_scripts() {
	global $wp, $wp_query;

	if ( get_field( 'enable_googleplus_login','option' ) ) {
		if (  $wp_query->get( 'bplogin' ) || $wp_query->get( 'bpregister' ) ) {
			wp_enqueue_script( 'googleplatform', 'https://apis.google.com/js/platform.js' );
			wp_enqueue_script( 'googleclient', 'https://apis.google.com/js/client.js?onload=GoggleOnLoad' );
			wp_enqueue_script( 'king-social-login-js', KING_THEME_URI . '/includes/social/googleplusoauth/googleplusoauth.js', array( 'jquery' ), '20160407', true );

			$ajax_auth_object = array(
				'url'                   => KING_THEME_URI,
				'ajaxurl'               => admin_url( 'admin-ajax.php' ),
				'login_redirect_url'    => apply_filters( 'king_auth_login_redirect_url', site_url() ),
				'google_oauth_id'       => get_field( 'googleplus_client_id', 'option' ),
				'google_api_key'        => get_field( 'googleplus_client_secret', 'option' ),
				'nonce'                 => wp_create_nonce( 'social_ajax_nonce' ),
			);
			wp_localize_script( 'king-social-login-js', 'ajax_googleplus_oauth_object', $ajax_auth_object );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'king_googleplus_oauth_callback_scripts' );

/**
 * Woocommerce functions
 */
if ( king_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	require_once( KING_INCLUDES_PATH . 'woocommerce.php' );
}

if ( king_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
	if ( get_field( 'enable_amp', 'option' ) ) {
		require_once( KING_INCLUDES_PATH . 'amp.php' );
	}
}
if ( king_plugin_active( 'fb-instant-articles/facebook-instant-articles.php' ) ) {
	require_once( KING_INCLUDES_PATH . 'facebook-instant-articles.php' );
}



//去除分类标志代码
add_action( 'load-themes.php',  'no_category_base_refresh_rules');
add_action('created_category', 'no_category_base_refresh_rules');
add_action('edited_category', 'no_category_base_refresh_rules');
add_action('delete_category', 'no_category_base_refresh_rules');
function no_category_base_refresh_rules() {
    global $wp_rewrite;
    $wp_rewrite -> flush_rules();
}
// register_deactivation_hook(__FILE__, 'no_category_base_deactivate');
// function no_category_base_deactivate() {
//  remove_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
//  // We don't want to insert our custom rules again
//  no_category_base_refresh_rules();
// }
// Remove category base
add_action('init', 'no_category_base_permastruct');
function no_category_base_permastruct() {
    global $wp_rewrite, $wp_version;
    if (version_compare($wp_version, '3.4', '<')) {
        // For pre-3.4 support
        $wp_rewrite -> extra_permastructs['category'][0] = '%category%';
    } else {
        $wp_rewrite -> extra_permastructs['category']['struct'] = '%category%';
    }
}
// Add our custom category rewrite rules
add_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
function no_category_base_rewrite_rules($category_rewrite) {
    //var_dump($category_rewrite); // For Debugging
    $category_rewrite = array();
    $categories = get_categories(array('hide_empty' => false));
    foreach ($categories as $category) {
        $category_nicename = $category -> slug;
        if ($category -> parent == $category -> cat_ID)// recursive recursion
            $category -> parent = 0;
        elseif ($category -> parent != 0)
            $category_nicename = get_category_parents($category -> parent, false, '/', true) . $category_nicename;
        $category_rewrite['(' . $category_nicename . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
        $category_rewrite['(' . $category_nicename . ')/page/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
        $category_rewrite['(' . $category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]';
    }
    // Redirect support from Old Category Base
    global $wp_rewrite;
    $old_category_base = get_option('category_base') ? get_option('category_base') : 'category';
    $old_category_base = trim($old_category_base, '/');
    $category_rewrite[$old_category_base . '/(.*)$'] = 'index.php?category_redirect=$matches[1]';
    //var_dump($category_rewrite); // For Debugging
    return $category_rewrite;
}
// Add 'category_redirect' query variable
add_filter('query_vars', 'no_category_base_query_vars');
function no_category_base_query_vars($public_query_vars) {
    $public_query_vars[] = 'category_redirect';
    return $public_query_vars;
}
// Redirect if 'category_redirect' is set
add_filter('request', 'no_category_base_request');
function no_category_base_request($query_vars) {
    //print_r($query_vars); // For Debugging
    if (isset($query_vars['category_redirect'])) {
        $catlink = trailingslashit(get_option('home')) . user_trailingslashit($query_vars['category_redirect'], 'category');
        status_header(301);
        header("Location: $catlink");
        exit();
    }
    return $query_vars;
}