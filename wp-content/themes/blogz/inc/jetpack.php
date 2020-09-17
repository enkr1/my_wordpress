<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package BlogZ
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function blogz_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support(
		'infinite-scroll',
		array(
			'container' => 'main',
			'render'    => 'blogz_infinite_scroll_render',
			'footer'    => 'page',
		)
	);

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Social menu.
	add_theme_support( 'jetpack-social-menu' );

	add_theme_support(
		'featured-content',
		array(
			'filter'    => 'blogz_get_featured_posts',
			'max_posts' => 6,
		)
	);
}
add_action( 'after_setup_theme', 'blogz_jetpack_setup' );

/**
 * Featured content.
 */
function blogz_get_featured_posts() {
	return apply_filters( 'blogz_get_featured_posts', array() );
}

/**
 * Deregister jetpack style.
 */
function blogz_deregister_jetpack_style() {
	wp_deregister_style( 'jetpack-social-menu' );
}
add_action( 'wp_enqueue_scripts', 'blogz_deregister_jetpack_style', 99 );

/**
 * Remove sharing jetpack.
 */
function blogz_remove_sharing_jetpack() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
}
add_action( 'loop_start', 'blogz_remove_sharing_jetpack' );
