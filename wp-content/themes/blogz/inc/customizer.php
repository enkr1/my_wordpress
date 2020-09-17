<?php
/**
 * BlogZ Theme Customizer
 *
 * @package BlogZ
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blogz_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'blogz_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'blogz_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->register_control_type( 'Blogz_Customize_Link_Control' );

	// Documentation Link.
	$theme = wp_get_theme();
	$slug  = $theme->template;
	$utm   = '?utm_source=WordPress&utm_medium=link&utm_campaign=' . $slug;

	$wp_customize->add_section(
		new Blogz_Customize_Link_Control(
			$wp_customize,
			'link-doc',
			array(
				'section_type' => 'doc',
				'label'        => esc_html( 'Need help setting up your site?', 'blogz' ),
				'priority'     => 0,
				'capability'   => 'edit_theme_options',
				'type'         => 'gt-link',
				'url'          => esc_url( 'https://gretathemes.com/docs/'. $slug .'/'. $utm .'', 'blogz' ),
			)
		)
	);

	$wp_customize->add_panel(
		'blogz',
		array(
			'title' => esc_html__( 'Theme Options', 'blogz' ),
		)
	);

	$sections = array(
		'general'     => esc_html__( 'General', 'blogz' ),
		'topbar'      => esc_html__( 'Topbar', 'blogz' ),
		'homepage'    => esc_html__( 'Homepage', 'blogz' ),
		'single-post' => esc_html__( 'Single Post', 'blogz' ),
		'ads'         => esc_html__( 'Ads', 'blogz' ),
		'footer'      => esc_html__( 'Footer', 'blogz' ),
	);

	foreach ( $sections as $id => $section ) {
		$args = array(
			'title' => $section,
			'panel' => 'blogz',
		);
		if ( 'general' === $id ) {
			$args['priority'] = 10;
		}
		$wp_customize->add_section( $id, $args );
	}

	/**
	 * Featured Content.
	 */
	$slider = $wp_customize->get_section( 'featured_content' );
	if ( $slider ) {
		$slider->panel    = 'blogz';
		$slider->priority = 100;
	}

}
add_action( 'customize_register', 'blogz_customize_register' );

/**
 * Include options.
 */
if ( class_exists( 'Kirki' ) ) {
	$files = glob( get_template_directory() . '/inc/customizer/*.php' );

	foreach ( $files as $file ) {
		require $file; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}
}

/**
 * Disable Kirki Loading.
 *
 * @param array $config Kirki Configuration.
 */
function blogz_disable_kirki_loading( $config ) {
	return wp_parse_args(
		array(
			'disable_loader' => true,
		),
		$config
	);
}
add_filter( 'kirki_config', 'blogz_disable_kirki_loading' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function blogz_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function blogz_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blogz_customize_preview_js() {
	wp_enqueue_script( 'blogz-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'blogz_customize_preview_js' );
