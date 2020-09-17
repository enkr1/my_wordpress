<?php
/**
 * Add class of libraries to body.
 *
 * @param array $classes modules.
 */
function blogz_modules_libraries( $classes ) {
	$classes[] = 'searchform-modal';
	$classes[] = 'slideout-sidebar-enabel';

	return $classes;
}
add_filter( 'body_class', 'blogz_modules_libraries' ); // add class to body.

/**
 * Enqueue js of components from gt addon
 *
 * @param array $components array of components.
 */
function blogz_enqueue_components( $components ) {
	$searchform = get_theme_mod( 'searchform_style', 'searchform-1' );

	if ( 'searchform-1' === $searchform ) {
		$components[] = 'searchform-modal';
	}

	$components[] = 'header-menu';
	$components[] = 'slideout-sidebar-enabel';
	$components[] = 'dropdown-widget-navmenu';

	return $components;
}
add_filter( 'blogz_addons_components_libraries', 'blogz_enqueue_components' );
add_filter( 'body_class', 'blogz_enqueue_components' ); // add class to body.

/**
 * Enqueue third-party libraries from gt addon
 *
 * @param array $libraries array of assets.
 */
function blogz_enqueue_libraries( $libraries ) {
	return array( 'slick' );
}
add_filter( 'blogz_addons_asset_libraries', 'blogz_enqueue_libraries' );
