<?php

/**
 * Add support for the block editor.
 *
 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
 */
function blogz_support_gutenberg() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Add a color palette to the editor Gutenberg.
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Accent Color', 'blogz' ),
			'slug'  => 'accent',
			'color' => '#009bdf',
		),

		array(
			'name'  => __( 'Gray', 'blogz' ),
			'slug'  => 'gray',
			'color' => '#9a9a9a',
		),

		array(
			'name'  => __( 'Black', 'blogz' ),
			'slug'  => 'black',
			'color' => '#111',
		),
		array(
			'name'  => __( 'White', 'blogz' ),
			'slug'  => 'white',
			'color' => '#fff',
		),
	) );

	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => _x( 'Small', 'Name of the small font size in the block editor', 'blogz' ),
			'shortName' => _x( 'S', 'Short name of the small font size in the block editor.', 'blogz' ),
			'size'      => 12,
			'slug'      => 'small',
		),
		array(
			'name'      => _x( 'Regular', 'Name of the regular font size in the block editor', 'blogz' ),
			'shortName' => _x( 'M', 'Short name of the regular font size in the block editor.', 'blogz' ),
			'size'      => 14,
			'slug'      => 'normal',
		),
		array(
			'name'      => _x( 'Large', 'Name of the large font size in the block editor', 'blogz' ),
			'shortName' => _x( 'L', 'Short name of the large font size in the block editor.', 'blogz' ),
			'size'      => 18,
			'slug'      => 'large',
		),
		array(
			'name'      => _x( 'Larger', 'Name of the larger font size in the block editor', 'blogz' ),
			'shortName' => _x( 'XL', 'Short name of the larger font size in the block editor.', 'blogz' ),
			'size'      => 24,
			'slug'      => 'larger',
		),
		array(
			'name'      => _x( 'Huge', 'Name of the huge font size in the block editor', 'blogz' ),
			'shortName' => _x( 'XL', 'Short name of the huge font size in the block editor.', 'blogz' ),
			'size'      => 30,
			'slug'      => 'huge',
		),
	) );
}
add_action( 'after_setup_theme', 'blogz_support_gutenberg' );

/**
 * Add editor style.
 */
function blogz_add_editor_styles() {
	add_editor_style( 'style-editor.css' );
}
add_action( 'init', 'blogz_add_editor_styles' );
