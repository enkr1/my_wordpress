<?php
/**
 * Theme functions and definitions
 *
 * @package quattuor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function quattuor_theme_support() {

	// Theme Supports - https://developer.wordpress.org/reference/functions/add_theme_support/
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );

	// Register WordPress nav menu
	register_nav_menus(array(
		'primary' => __( 'Primary Menu', 'quattuor' ),
	));

	// Set the content_width with 700
	if ( ! isset( $content_width ) ) $content_width = 700;
}
add_action( 'after_setup_theme', 'quattuor_theme_support' );

// Enqueue Scripts - https://developer.wordpress.org/themes/basics/including-css-javascript/
function quattuor_enqueue_scripts(){
    //Theme Stylesheet
	$theme_version = wp_get_theme()->get( 'Version' );
    wp_enqueue_style( 'quattuor-style', get_stylesheet_uri(), array(), $theme_version );

    // Js Files
    //wp_enqueue_script( 'jquery' ); // disable jquery
}
add_action( 'wp_enqueue_scripts', 'quattuor_enqueue_scripts' );

require_once ( 'inc/elementor-widgets.php' );
require_once ( 'inc/tgmpa.php' );
require_once ( 'inc/demo-importer.php' );