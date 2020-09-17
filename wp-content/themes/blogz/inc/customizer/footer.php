<?php
Kirki::add_field(
	'blogz',
	array(
		'type'      => 'textarea',
		'settings'  => 'subscribe_text',
		'label'     => __( 'Subscribe Text', 'blogz' ),
		'section'   => 'footer',
		'default'   => wp_kses_post( 'Subscribe to our newsletter and get latest news!', 'blogz' ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '#subscribe-text p',
				'function' => 'html',
			),
		),
	)
);

Kirki::add_field(
	'blogz',
	array(
		'type'      => 'text',
		'settings'  => 'subscribe_button_text',
		'label'     => __( 'Subscribe Button Text', 'blogz' ),
		'section'   => 'footer',
		'default'   => wp_kses_post( 'Subscribe', 'blogz' ),
		'transport' => 'postMessage',
	)
);

$footer_bg = get_template_directory_uri() . '/images/footer_bg.jpg';
Kirki::add_field(
	'blogz',
	array(
		'type'     => 'image',
		'settings' => 'footer_bg',
		'label'    => esc_html__( 'Background', 'blogz' ),
		'section'  => 'footer',
		'default'  => $footer_bg,
	)
);

Kirki::add_field(
	'blogz',
	array(
		'type'     => 'image',
		'settings' => 'footer_logo',
		'label'    => esc_html__( 'Logo', 'blogz' ),
		'section'  => 'footer',
	)
);

