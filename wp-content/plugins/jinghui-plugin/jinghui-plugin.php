<?php

/**
 * Plugin Name: JingHui Plugin
 * Plugin URI: http://localhost:8000/
 * Description: First attempt on writing a custom plugin.
 * Version: 1.0.0
 * Author: JingHui
 * Author URI: http://localhost:8000/
 * License: GPLv2 or later
 * Text Domain: jinghui-plugin
 *
 * @package JingHuiPlugin
 */

// defined( 'ABSPATH' ) || exit;
if (!defined('ABSPATH')) {
    die;
}

// if (!function_exists('add_function')) {
//     echo 'Access Denied';
//     exit;
// }

class JingHuiPlugin
{
    function __construct()
    {
        // add action
        add_action('init', array($this, 'cw_post_type_recipes'));
        add_action('init', array($this, 'recipes_taxonomy'));
    }

    function activate()
    {
        // Generated a CPT
        $this->cw_post_type_recipes();

        // Flush rewrite rules
        flush_rewrite_rules();
    }

    function deactivate()
    {
        // Flush rewrite rules
        flush_rewrite_rules();
    }

    // https://www.cloudways.com/blog/how-to-create-custom-post-types-in-wordpress/
    /* Custom Recipe Post type start */
    function cw_post_type_recipes()
    {

        $supports = array(
            'title', // post title
            'editor', // post content
            'author', // post author
            'thumbnail', // featured images
            'excerpt', // post excerpt
            'custom-fields', // custom fields
            'comments', // post comments
            'revisions', // post revisions
            'post-formats', // post formats
        );

        $labels = array(
            'name' => _x('Recipes', 'plural'),
            'singular_name' => _x('Recipe', 'singular'),
            'menu_name' => _x('Recipes', 'admin menu'),
            'name_admin_bar' => _x('Recipes', 'admin bar'),
            'add_new' => _x('Add New Recipe', 'add new'),
            'add_new_item' => __('Add New Recipe'),
            'new_item' => __('New Recipe'),
            'edit_item' => __('Edit Recipe'),
            'view_item' => __('View Recipe'),
            'all_items' => __('All Recipes'),
            'search_items' => __('Search Recipes'),
            'not_found' => __('No Recipes Found.'),
        );

        $args = array(
            'supports' => $supports,
            'labels' => $labels,
            'public' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'all-recipes'),
            'has_archive' => true,
            'hierarchical' => false,
            'menu_icon' => 'dashicons-food',
        );
        
        register_post_type('recipes', $args);
    }

    // assign to Recipe post type
    function recipes_taxonomy()
    {
        register_taxonomy(
            'categories',
            array('recipes'),
            array(
                'labels' => array(
                    'name' => __('Categories'),
                    'singular_name' => __('Category')
                ),
                'public' => true,
                'hierarchical' => true, // true = Category; false = Tag
            )
        );
    }

} // End of JingHuiPlugin class

if (class_exists('JingHuiPlugin')) {
    $jingHuiPlugin = new JingHuiPlugin();
}

// Activation
register_activation_hook(__FILE__, array($jingHuiPlugin, 'activate'));

// Deactivation 
register_deactivation_hook(__FILE__, array($jingHuiPlugin, 'deactivate'));

// Uninstall
