<?php
Kirki::add_field(
	'blogz',
	array(
		'type'      => 'textarea',
		'settings'  => 'topbar_text',
		'label'     => __( 'Topbar Text', 'blogz' ),
		'section'   => 'topbar',
		'default'   => esc_html__( 'BlogZ. Modern & Clean and Minimal Blog Wordpress Theme', 'blogz' ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.topbar__text',
				'function' => 'html',
			),
		),
	)
);

Kirki::add_field(
	'blogz',
	array(
		'type'      => 'checkbox',
		'settings'  => 'hide_topbar_social',
		'label'     => esc_html__( 'Hide Social Menu', 'blogz' ),
		'section'   => 'topbar',
		'default'   => '0',
		'transport' => 'postMessage',
	)
);
