<?php

/**
 * aspro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package aspro
 */

if (!function_exists('aspro_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function aspro_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on aspro, use a find and replace
         * to change 'aspro' to the name of your theme in all the template files.
         */
        load_theme_textdomain('aspro');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus([
            'menu-1' => esc_html__('Primary', 'aspro'),
        ]);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]);

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('aspro_custom_background_args', [
            'default-color' => 'ffffff',
            'default-image' => '',
        ]));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', [
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ]);

        /*
        * This theme styles the visual editor to resemble the theme style,
        * specifically font, colors, and column width.
        */
        add_editor_style('assets/css/editor.css');
    }
endif;
add_action('after_setup_theme', 'aspro_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aspro_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('aspro_content_width', 640);
}
add_action('after_setup_theme', 'aspro_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aspro_widgets_init()
{
    register_sidebar([
        'name' => esc_html__('Sidebar', 'aspro'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'aspro'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ]);

    register_sidebar( array(
        'name'          => esc_html__( 'Blog Page', 'aspro' ),
        'id'            => 'aspro_blog_page_sidebar',
        'description'   => esc_html__( 'Add widgets in your blog page of theme.', 'aspro' ),
        'before_widget' => '<section id="%1$s" class="at-slider at-slider--one widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );



    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1', 'aspro' ),
        'id'            => 'aspro_footer_section_1',
        'description'   => esc_html__( 'Add widgets in your first footer of theme.', 'aspro' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2', 'aspro' ),
        'id'            => 'aspro_footer_section_2',
        'description'   => esc_html__( 'Add widgets in your second footer of  theme.', 'aspro' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 3', 'aspro' ),
        'id'            => 'aspro_footer_section_3',
        'description'   => esc_html__( 'Add widgets in your third footer of  theme.', 'aspro' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action('widgets_init', 'aspro_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function aspro_scripts()
{

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css');

    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap');

    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/all.css');

    wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/css/swiper.css');

    wp_enqueue_style('aos', get_template_directory_uri() . '/assets/css/aos.css');

    wp_enqueue_style('aspro-app-css', get_template_directory_uri() . '/assets/css/app.css');

    wp_enqueue_style('aspro-style', get_stylesheet_uri());

    wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/swiper.js', [], '', true);

    wp_enqueue_script('aos', get_template_directory_uri() . '/assets/js/aos.js', [], '', true);

    wp_enqueue_script('micromodal', get_template_directory_uri() . '/assets/js/micromodal.js', [], '', true);

    wp_enqueue_script('aspro-navigation', get_template_directory_uri() . '/js/navigation.js', [], '20151215', true);

    wp_enqueue_script('aspro-custom-js', get_template_directory_uri() . '/assets/js/custom.js', ['jquery'], false, true);

    wp_enqueue_script('aspro-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', [], '20151215', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'aspro_scripts');

/**
 * Define constants.
 */

define( 'ASPRO_AUTHOR_URI', 'https://99colorthemes.com');


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

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets/aspro-slider-widget.php';

/**
 * Load plugin recommendations.
 */
require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';

/**
 * Theme details
 */
require get_template_directory() . '/inc/aspro-info/aspro-info.php';

if ( ! function_exists( 'aspro_register_recommended_plugins' ) ) :

    /**
     * Register recommended plugins.
     */
    function aspro_register_recommended_plugins() {
        $plugins = array(
            array(
                'name'     => esc_html__( 'One Click Demo Importer', 'aspro' ),
                'slug'     => 'one-click-demo-import',
                'required' => false,
            ),
        );

        $config = array();

        tgmpa( $plugins, $config );
    }

endif;

add_action( 'tgmpa_register', 'aspro_register_recommended_plugins' );

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}