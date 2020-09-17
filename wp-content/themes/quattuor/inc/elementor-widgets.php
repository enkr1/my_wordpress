<?php

if ( did_action( 'elementor/loaded' ) ) {
    class Quattuor_Elementor_Widgets {

        protected static $instance = null;

        public static function get_instance() {
            if ( ! isset( static::$instance ) ) {
                static::$instance = new static;
            }

            return static::$instance;
        }

        protected function __construct() {
            require_once('elementor-widgets-header.php');
            add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
        }

        public function register_widgets() {
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Quattuor_Header() );
        }

    }

    add_action( 'init', 'my_elementor_init' );
    function my_elementor_init() {
        Quattuor_Elementor_Widgets::get_instance();
    }
}