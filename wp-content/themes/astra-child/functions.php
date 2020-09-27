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

// // https://www.wpbeginner.com/wp-tutorials/how-to-create-custom-post-types-in-wordpress/
// https://stackoverflow.com/questions/25027108/best-way-to-override-woocommerce-css
// To overwrite WooCommerce css
add_filter('woocommerce_enqueue_styles', '__return_false');

// // https://www.cloudways.com/blog/how-to-create-custom-post-types-in-wordpress/
// /* Custom Post type start */
// function cw_post_type_recipes()
// {

//     $supports = array(
//         'title', // post title
//         'editor', // post content
//         'author', // post author
//         'thumbnail', // featured images
//         'excerpt', // post excerpt
//         'custom-fields', // custom fields
//         'comments', // post comments
//         'revisions', // post revisions
//         'post-formats', // post formats
//     );

//     $labels = array(
//         'name' => _x('Recipes', 'plural'),
//         'singular_name' => _x('Recipe', 'singular'),
//         'menu_name' => _x('Recipes', 'admin menu'),
//         'name_admin_bar' => _x('Recipes', 'admin bar'),
//         'add_new' => _x('Add New Recipe', 'add new'),
//         'add_new_item' => __('Add New Recipe'),
//         'new_item' => __('New Recipe'),
//         'edit_item' => __('Edit Recipe'),
//         'view_item' => __('View Recipe'),
//         'all_items' => __('All Recipes'),
//         'search_items' => __('Search Recipes'),
//         'not_found' => __('No Recipes Found.'),
//     );

//     $args = array(
//         'supports' => $supports,
//         'labels' => $labels,
//         'public' => true,
//         'query_var' => true,
//         'rewrite' => array('slug' => 'all-recipes'),
//         'has_archive' => true,
//         'hierarchical' => false,
//         'menu_icon' => 'dashicons-food',
//     );
//     register_post_type('recipes', $args);
// }
// add_action('init', 'cw_post_type_recipes');
// // assign to post type
// function recipes_taxonomy()
// {
//     register_taxonomy(
//         'categories',
//         array('recipes'),
//         array(
//             'labels' => array(
//                 'name' => __('Categories'),
//                 'singular_name' => __('Category')
//             ),
//             'public' => true,
//             'hierarchical' => true, // true = Category; false = Tag
//         )
//     );
// }

// add_action('init', 'recipes_taxonomy');
// /* Custom Post type end */

// add_filter('wp_nav_menu_objects', 'my_dynamic_menu_items');
// function my_dynamic_menu_items($menu_items)
// {
//     foreach ($menu_items as $menu_item) {
//         if (strpos($menu_item->title, '#profile_name#') !== false) {
//             $menu_item->title =  str_replace("#profile_name#",  wp_get_current_user()->user_firstname, $menu_item->title);
//         }
//     }

//     return $menu_items;
// }

// https://stackoverflow.com/questions/45338960/how-to-change-date-to-days-ago-human-time-diff
// function wp_relative_date($post_date)
// {
//     return human_time_diff($post_date, current_time('timestamp')) . ' ago';
// }
