<?php
Kirki::add_field(
	'blogz',
	array(
		'type'      => 'slider',
		'settings'  => 'resize_logo',
		'label'     => esc_html__( 'Resize Logo', 'blogz' ),
		'section'   => 'title_tagline',
		'priority'  => 9,
		'transport' => 'auto',
		'default'   => '127',
		'choices'   => array(
			'min'  => '1',
			'max'  => '400',
			'step' => '1',
		),
		'output'    => array(
			array(
				'element'       => '.site-branding img',
				'property'      => 'width',
				'value_pattern' => '$px',
			),
		),
		'required'  => array(
			array(
				'setting'  => 'custom_logo',
				'operator' => '!=',
				'value'    => '',
			),
		),
	)
);

Kirki::add_field(
	'blogz',
	array(
		'type'     => 'image',
		'settings' => 'blogz_retina_logo',
		'label'    => esc_html__( 'Retina Logo', 'blogz' ),
		'section'  => 'title_tagline',
		'priority' => 8,
	)
);
