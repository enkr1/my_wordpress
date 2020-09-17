<?php
/**
 * BlogZ functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BlogZ
 */

if ( ! function_exists( 'blogz_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function blogz_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on BlogZ, use a find and replace
		 * to change 'blogz' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'blogz', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'blogz' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		add_image_size( 'blogz-vertical', 428, 553, true );
		add_image_size( 'blogz-small', 100, 100, true );
		add_image_size( 'blogz-layout-2', 430, 260, true );
		set_post_thumbnail_size( 360, 225, true );

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'blogz_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'blogz_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blogz_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound.
	$GLOBALS['content_width'] = apply_filters( 'blogz_content_width', 640 );
}
add_action( 'after_setup_theme', 'blogz_content_width', 0 );

/**
 * Enqueue styles.
 */
function blogz_style() {
	if ( defined( 'JETPACK__VERSION' ) ) {
		wp_deregister_style( 'sharedaddy' );
		wp_enqueue_style( 'sharedaddy', WP_PLUGIN_URL . '/jetpack/modules/sharedaddy/sharing.css', '', '1.0.0' );
	}
	wp_enqueue_style( 'blogz-style', get_stylesheet_uri(), '', '1.0.0' );
}
add_action( 'wp_print_styles', 'blogz_style' );

/**
 * Enqueue scripts.
 */
function blogz_scripts() {
	wp_enqueue_style( 'icofont', get_template_directory_uri() . '/css/icofont.css', '', '1.0.1' );

	wp_enqueue_script( 'blogz-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'blogz-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular( array( 'post', 'page' ) ) && get_theme_mod( 'hightlight_js', true ) ) {
		wp_enqueue_style( 'blogz-highlight-theme', get_template_directory_uri() . '/css/atom-one-dark.css', '', '20151215' );
		wp_enqueue_script( 'blogz-highlight', get_template_directory_uri() . '/js/highlight.min.js', array(), '9.12.0', true );
		wp_add_inline_script( 'blogz-highlight', '(function ( d, hljs ) {
			d.querySelectorAll( "pre" ).forEach( function( block ) {
				hljs.highlightBlock( block );
			} );
		})( document, hljs );' );
	}
}
add_action( 'wp_enqueue_scripts', 'blogz_scripts' );

/**
 * Require libraries.
 */
require get_template_directory() . '/lib/gt-addons.php';
require get_template_directory() . '/inc/gt-addons.php';

/**
 * Gutenberg support.
 */
require get_template_directory() . '/inc/gutenberg.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/extras.php';

/**
 * Breadcrumbs.
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

if ( is_admin() ) {
	/**
	 * Load TGM Activation Class.
	 */
	require_once get_template_directory() . '/inc/admin/class-tgm-plugin-activation.php';
	require_once get_template_directory() . '/inc/admin/plugins.php';

	/**
	 * Load theme dashboard.
	 */
	require get_template_directory() . '/inc/dashboard/class-blogz-dashboard.php';
	new BlogZ_Dashboard();
}

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Shim for wp_body_open, ensuring backwards compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
