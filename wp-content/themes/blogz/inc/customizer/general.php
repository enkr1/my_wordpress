<?php

$heading       = '<h3 style="margin: 30px -12px 0; padding: 12px; background: #fff; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd;">%s</h3>';
$control_title = '<span class="customize-control-title">%s</span>';

Kirki::add_field(
	'blogz',
	array(
		'type'      => 'text',
		'settings'  => 'read_more_text',
		'label'     => esc_html__( 'Read More Text', 'blogz' ),
		'section'   => 'general',
		'default'   => esc_html__( 'Read Ahead', 'blogz' ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.read-more-text',
				'function' => 'html',
			),
		),
	)
);
