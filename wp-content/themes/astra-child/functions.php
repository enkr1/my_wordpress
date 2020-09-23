<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if (!function_exists('chld_thm_cfg_locale_css')) :
    function chld_thm_cfg_locale_css($uri)
    {
        if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css'))
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');

if (!function_exists('child_theme_configurator_css')) :
    function child_theme_configurator_css()
    {
        wp_enqueue_style('chld_thm_cfg_child', trailingslashit(get_stylesheet_directory_uri()) . 'style.css', array('astra-theme-css', 'astra-menu-animation', 'woocommerce-layout', 'woocommerce-smallscreen', 'woocommerce-general'));
        wp_enqueue_style('chld_thm_cfg_child_custom', trailingslashit(get_stylesheet_directory_uri()) . 'app.css');
    }
endif;
add_action('wp_enqueue_scripts', 'child_theme_configurator_css', 10);

// TO RUN style.css
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

// Sidebar
register_sidebar(
    array(
        'name' => 'Blog Sidebar',
        'id' => 'blog-sidebar',
        'class' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    )
);

// Add app.js
function my_custom_scripts()
{
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/app.js', array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'my_custom_scripts');

// END ENQUEUE PARENT ACTION

// https://www.wpbeginner.com/wp-tutorials/how-to-create-custom-post-types-in-wordpress/
// Our custom post type function
function create_food_post_type()
{
    register_post_type(
        'foods',
        // CPT Options
        array(
            'labels' => array(
                'name' => __('Foods'),
                'singular_name' => __('Food')
            ),
            'public' => true,
            'has_archive' => true,
            'hierarchical' => true, // true = page || false = post (by default)
            'menu_icon' => 'dashicons-products',
            // 'support' => array('title', 'editor', 'thumbnail'),
            // 'rewrite' => array('slug' => 'foods'),
            // 'show_in_rest' => true, // show post page (add)
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_food_post_type');

// assign to post type
function my_first_taxonomy()
{
    register_taxonomy(
        'types',
        array('foods'),
        array(
            'labels' => array(
                'name' => __('Types'),
                'singular_name' => __('Type')
            ),
            'public' => true,
            'hierarchical' => false, // Category
        )
    );
}

add_action('init', 'my_first_taxonomy');

// ---------------------------------------------------------------------------------------------------------------------------
// Our custom post type function
function create_posttype()
{

    register_post_type(
        'movies',
        // CPT Options
        array(
            'labels' => array(
                'name' => __('Movies'),
                'singular_name' => __('Movie')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'movies'),
            'show_in_rest' => true,

        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_posttype');
/*
* Creating a function to create our CPT
*/

function custom_post_type()
{

    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x('Movies', 'Post Type General Name', 'twentytwenty'),
        'singular_name'       => _x('Movie', 'Post Type Singular Name', 'twentytwenty'),
        'menu_name'           => __('Movies', 'twentytwenty'),
        'parent_item_colon'   => __('Parent Movie', 'twentytwenty'),
        'all_items'           => __('All Movies', 'twentytwenty'),
        'view_item'           => __('View Movie', 'twentytwenty'),
        'add_new_item'        => __('Add New Movie', 'twentytwenty'),
        'add_new'             => __('Add New', 'twentytwenty'),
        'edit_item'           => __('Edit Movie', 'twentytwenty'),
        'update_item'         => __('Update Movie', 'twentytwenty'),
        'search_items'        => __('Search Movie', 'twentytwenty'),
        'not_found'           => __('Not Found', 'twentytwenty'),
        'not_found_in_trash'  => __('Not found in Trash', 'twentytwenty'),
    );

    // Set other options for Custom Post Type

    $args = array(
        'label'               => __('movies', 'twentytwenty'),
        'description'         => __('Movie news and reviews', 'twentytwenty'),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array('genres'),
        /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,

    );

    // Registering your Custom Post Type
    register_post_type('movies', $args);
}

/* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */

add_action('init', 'custom_post_type', 0);

// ---------------------------------------------------------------------------------------------------------------------------