<?php

$heading = '<h3 style="margin: 30px -12px 0; padding: 12px; background: #fff; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd;">%s</h3>';

Kirki::add_field(
	'blogz',
	array(
		'type'     => 'custom',
		'settings' => 'hero_section_heading',
		'section'  => 'homepage',
		'default'  => sprintf( $heading, esc_html__( 'Hero Section', 'blogz' ) ),
	)
);

$default_bg = get_template_directory_uri() . '/images/header.jpg';

Kirki::add_field(
	'blogz',
	array(
		'type'     => 'image',
		'settings' => 'hero_bg',
		'label'    => esc_html__( 'Background', 'blogz' ),
		'section'  => 'homepage',
		'default'  => $default_bg,
	)
);

$default_image = get_template_directory_uri() . '/images/logo_overlay.png';
Kirki::add_field(
	'blogz',
	array(
		'type'     => 'image',
		'settings' => 'hero_img',
		'label'    => esc_html__( 'Image', 'blogz' ),
		'section'  => 'homepage',
		'default'  => $default_image,
	)
);

Kirki::add_field(
	'blogz',
	array(
		'type'      => 'textarea',
		'settings'  => 'hero_text',
		'label'     => __( 'Text', 'blogz' ),
		'section'   => 'homepage',
		'default'   => esc_html__( 'BlogZ. Modern & Clean and Minimal Blog Wordpress Theme', 'blogz' ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.hero__inner p',
				'function' => 'html',
			),
		),
	)
);
