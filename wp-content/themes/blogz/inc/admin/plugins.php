<?php
/**
 * Add required and recommended plugins.
 *
 * @package BlogZ
 */

add_action( 'tgmpa_register', 'blogz_register_required_plugins' );

/**
 * Register required plugins
 *
 * @since  1.0
 */
function blogz_register_required_plugins() {
	$plugins = blogz_required_plugins();

	$config = array(
		'id'          => 'blogz',
		'has_notices' => false,
	);

	tgmpa( $plugins, $config );
}

/**
 * List of required plugins
 */
function blogz_required_plugins() {
	return array(
		array(
			'name' => esc_html__( 'Jetpack', 'blogz' ),
			'slug' => 'jetpack',
		),
		array(
			'name' => esc_html__( 'Kirki', 'blogz' ),
			'slug' => 'kirki',
		),
		array(
			'name' => esc_html__( 'Slim SEO', 'blogz' ),
			'slug' => 'slim-seo',
		),
	);
}
