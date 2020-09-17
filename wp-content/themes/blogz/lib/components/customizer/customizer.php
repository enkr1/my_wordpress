<?php
require dirname( __FILE__ ) . '/sanitization-callbacks.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Register custom Customize controls.
 */
function blogz_register_customize_controls() {
	$files = glob( dirname( __FILE__ ) . '/controls/*.php' );
	foreach ( $files as $file ) {
		require $file; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}
}

// Run at priority 0 to make it available everywhere.
add_action( 'customize_register', 'blogz_register_customize_controls', 0 );
