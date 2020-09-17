<?php
namespace Elementor;

class Quattuor_Header extends Widget_Base {
	
	public function get_name() {
		return 'quattuor-header';
	}
	
	public function get_title() {
		return 'Quattuor Header';
	}
	
	public function get_icon() {
		return 'fa fa-bars';
	}
	
	public function get_categories() {
		return [ 'basic' ];
	}
	
	protected function _register_controls() {


        // Logo Section
	    $this->start_controls_section(
			'logo_section',
			[
				'label' => __( 'Site Logo', 'quattuor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Logo Image', 'quattuor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->add_control(
			'logo_show',
			[
				'label' => __( 'Show', 'quattuor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'slogo' => __( 'Logo', 'quattuor' ),
					'stitle' => __( 'Title', 'quattuor' ),
				],
				'default' => 'stitle',
			]
		);



		$this->end_controls_section();
		
		
		// Menu Section
		$this->start_controls_section(
			'menu_section',
			[
				'label' => __( 'Menu Items', 'quattuor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'list_title', [
				'label' => __( 'Menu', 'quattuor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Menu Title' , 'quattuor' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_url', [
				'label' => __( 'Link', 'quattuor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'quattuor' ),
				'show_external' => true,
			]
		);

		$this->add_control(
			'list',
			[
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Home', 'quattuor' ),
						'list_url' => __( '#home', 'quattuor' ),
						
					],
					[
						'list_title' => __( 'About', 'quattuor' ),
						'list_url' => __( '#about', 'quattuor' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();
	
        // Style Section
	    $this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style', 'quattuor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'toggle_icon',
			[
				'label' => __( 'Toggle Menu Icon', 'quattuor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-bars',
					
				],
			]
		);
		
		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'header_color',
			[
				'label' => __( 'Header Color', 'quattuor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'.site-header' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'font_family',
			[
				'label' => __( 'Font Family', 'quattuor' ),
				'type' => \Elementor\Controls_Manager::FONT,
				'default' => "'Open Sans', sans-serif",
				'selectors' => [
					'.site-header' => 'font-family: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();
	}
	
	protected function render() {

        $settings = $this->get_settings_for_display();
        
        
		echo '<header class="site-header" style="border:none">
		<div class="site-title">
		<h1><a href="'.esc_url(home_url()).'">';
		 
		if ($settings['logo_show'] == "stitle"){echo get_bloginfo("name");}else{echo wp_get_attachment_image( $settings['image']['id'], array(260,60) );}
		 
		echo "</a></h1></div><a href=\"javascript:void(0);\" onclick=\"document.getElementById('nav').classList.toggle('nav-open');\" class=\"nav-toggle\">";
		\Elementor\Icons_Manager::render_icon( $settings['toggle_icon']);
		echo '</a><nav class="nav" id="nav">';
		 
		if ( $settings['list'] ) {
				echo '<ul id="elementor-quattuor-menu" class="menu">';
				foreach (  $settings['list'] as $item ) {
					echo '<li id="menu-"'.$item['_id'].' class="elementor-quattuor-menu-item"><a href="'.$item['list_url']['url'].'">'.$item['list_title'].'</a></li>';
				}
				echo '</ul>';
			}

		  echo '</ul></nav></header>';

		}
	
	protected function _content_template() {

	}
	
}