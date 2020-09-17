<?php
/**
 * Enqueue scripts.
 *
 * List Modules:
 *
 * push-menu-mobile ( function: gt_push_menu_mobile )
 * toggle-mobile-menu ( function: gt_toggle_mobile_menu )
 * searchform-modal ( function: gt_searchform_modal )
 * searchform-dropdown ( function: gt_searchform_dropdown )
 * searchform-toggle ( function: gt_searchform_toggle )
 * header-menu
 * dropdown-widget-navmenu
 * slideout-sidebar-enabel ( function: gt_slideout_sidebar )
 *
 * @param array $library is library want use.
 */
function blogz_addons_components_scripts( $library = array() ) {
	$libraries = blogz_addons_get_components_libraries();
	$components = GT_LIB_URL . '/lib/components/';

	// push-menu-mobile.
	if ( in_array( 'push-menu-mobile', $libraries ) ) {
		wp_enqueue_script( 'gt-push-menu-mobile', $components . 'push-menu-mobile/push-menu-mobile.js', array( 'jquery' ), '1.0' );
	}

	// searchform-modal.
	if ( in_array( 'searchform-modal', $libraries ) ) {
		wp_enqueue_script( 'gt-searchform-modal', $components . 'searchform-modal/searchform-modal.js', array( 'jquery' ), '1.0' );
	}

	// header-menu.
	if ( in_array( 'header-menu', $libraries ) ) {
		wp_enqueue_script( 'gt-header-menu', $components . 'header-menu/header-menu.js', array( 'jquery' ), '1.0' );
	}

	// toggle-mobile-menu.
	if ( in_array( 'toggle-mobile-menu', $libraries ) ) {
		wp_enqueue_script( 'gt-toggle-mobile-menu', $components . 'toggle-mobile-menu/toggle-mobile-menu.js', array( 'jquery' ), '1.0' );
	}

	// dropdown-widget-navmenu.
	if ( in_array( 'dropdown-widget-navmenu', $libraries ) ) {
		wp_enqueue_script( 'gt-dropdown-widget-navmenu', $components . 'dropdown-widget-navmenu/dropdown-widget-navmenu.js', array( 'jquery' ), '1.0' );
	}

	// slideout-sidebar.
	if ( in_array( 'slideout-sidebar-enabel', $libraries ) ) {
		wp_enqueue_script( 'gt-slideout-sidebar', $components . 'slideout-sidebar/slideout-sidebar.js', array( 'jquery' ), '1.0' );
	}
}
add_action( 'wp_enqueue_scripts', 'blogz_addons_components_scripts' );

/**
 * Get modules libraries.
 * Themes should filter to this.
 *
 * @return array
 */
function blogz_addons_get_components_libraries() {
	return apply_filters( 'blogz_addons_components_libraries', array() );
}

// Widgets.
/**
 * Widget Recent Post.
 */
function blogz_addons_widgets_init() {
	register_widget( 'Blogz_Addons_Recent_Posts_Widget' );
}
add_action( 'widgets_init', 'blogz_addons_widgets_init' );

require GT_LIB_DIR . '/components/widgets/recent-posts-widget/recent-posts-widget.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

// Modules.


/**
 * Push menu mobile.
 */
require GT_LIB_DIR . '/components/push-menu-mobile/push-menu-mobile.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Toggle mobile menu.
 */
require GT_LIB_DIR . '/components/toggle-mobile-menu/toggle-mobile-menu.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Search modal.
 */
require GT_LIB_DIR . '/components/searchform-modal/searchform-modal.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Slideout Sidebar.
 */
require GT_LIB_DIR . '/components/slideout-sidebar/slideout-sidebar.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

// Customizer.
require GT_LIB_DIR . '/components/customizer/customizer.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
