<?php
/**
 * Enqueue the plugin main CSS and JS files.
 */
function gt_addons_enqueue_scripts() {
	// Plugin's CSS file.
	wp_enqueue_style( 'gt-addons-style', GT_LIB_URL . '/lib/style.css', '', '1.0' );

	// Theme's fonts.
	wp_enqueue_style( 'gt-fonts', blogz_get_fonts_url(), '', '1.0' );

	// Theme's custom script.
	wp_enqueue_script( 'gt-addons-theme-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'gt_addons_enqueue_scripts', 1 );

/**
 * Enqueue scripts and styles from libraries.
 *
 * Libraris available:
 *
 * font-awesome (Icon font)
 * theia-sticky-sidebar (Sticky sidebar)
 * slick (Slider)
 * owl-carousel (Slider)
 * magnific-popup (Popup, Modal)
 * css-vars-ponyfill (Support var css for old browser [ IE, Opera ])
 * aos (Animate on scroll library)
 * isotope (Masonry layout)
 *
 * @param array $library is library want use.
 */
function blogz_addons_enqueue_asset_libraries() {
	$libraries = blogz_addons_get_asset_libraries();

	$css = GT_LIB_URL . '/lib/assets/css/';
	$js  = GT_LIB_URL . '/lib/assets/js/';

	// Font Awesome 5.
	if ( in_array( 'font-awesome', $libraries ) ) {
		wp_enqueue_style( 'font-awesome', $css . 'fontawesome.css', '', '5.0.0' );
	}

	// Sticky sidebar.
	if ( in_array( 'theia-sticky-sidebar', $libraries ) ) {
		wp_enqueue_script( 'theia-sticky-sidebar', $js . 'theia-sticky-sidebar.js', array( 'jquery' ), '1.0', true );
	}

	// Slick.
	if ( in_array( 'slick', $libraries ) ) {
		wp_enqueue_style( 'slick', $css . 'slick.css', '', '1.8.1' );
		wp_enqueue_script( 'slick', $js . 'slick.js', array( 'jquery' ), '1.8.1', true );
	}

	// Magnific Popup.
	if ( in_array( 'magnific-popup', $libraries ) ) {
		wp_enqueue_style( 'magnific-popup', $css . 'magnific-popup.css', '', '1.1.0' );
		wp_enqueue_script( 'magnific-popup', $js . 'jquery.magnific-popup.js', array( 'jquery' ), '1.1.0', true );
	}

	// Owl Carousel.
	if ( in_array( 'owl-carousel', $libraries ) ) {
		wp_enqueue_style( 'owl-carousel', $css . 'owl.carousel.css', '', '2.3.4' );
		wp_enqueue_style( 'owl-carousel-theme', $css . 'owl.theme.default.css', '', '2.3.4' );
		wp_enqueue_script( 'owl-carousel', $js . 'owl.carousel.js', array( 'jquery' ), '2.3.4', true );
	}

	// Support css variables for old browser (IE 11, Opera, ...).
	// https://github.com/jhildenbiddle/css-vars-ponyfill#optionsvariables.
	if ( in_array( 'css-vars-ponyfill', $libraries ) ) {
		wp_enqueue_script( 'css-vars-ponyfill', $js . 'css-vars-ponyfill.js', array( 'jquery' ), '1.9.0', true );
	}

	// Aos (Animate On Scroll Library).
	if ( in_array( 'aos', $libraries ) ) {
		wp_enqueue_style( 'aos', $css . 'aos.css', '', '1.8.1' );
		wp_enqueue_script( 'aos', $js . 'aos.js', array( 'jquery' ), '1.8.1', true );
	}

	// isotope (Masonry layout).
	if ( in_array( 'isotope', $libraries ) ) {
		wp_enqueue_script( 'isotope', $js . 'isotope.pkgd.js', array( 'jquery' ), '2.1.1', true );
	}
}
add_action( 'wp_enqueue_scripts', 'blogz_addons_enqueue_asset_libraries', 0 );

/**
 * Get asset libraries.
 * Themes should filter to this.
 *
 * @return array
 */
function blogz_addons_get_asset_libraries() {
	return apply_filters( 'blogz_addons_asset_libraries', array() );
}

/**
 * Add editor style.
 */
function blogz_addons_editor_styles() {
	$styles   = array(
		'css/editor-style.css',
	);
	$styles[] = blogz_get_fonts_url();
	add_editor_style( $styles );
}
add_action( 'init', 'blogz_addons_editor_styles' );

/**
 * Get function that returns font URL.
 *
 * @return string|bool
 */
function blogz_get_fonts_url() {
	$theme         = get_template();
	$function_name = str_replace( '-', '_', "{$theme}_fonts_url" );

	return function_exists( $function_name ) ? $function_name() : false;
}
