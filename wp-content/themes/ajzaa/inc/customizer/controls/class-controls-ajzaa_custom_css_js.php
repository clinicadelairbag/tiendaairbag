<?php

class ajzaa_Customizer_Controls_Custom_CSS_JS extends ajzaa_Customizer_Controls {

    public $controls = array();

    public function __construct() {
        $this->section = 'ajzaa_custom_css_js';
        $this->priority = new ajzaa_Customizer_Priority(49, 1);

        parent::__construct();

        add_action( 'customize_register', array( $this, 'add_controls' ), 30 );
        add_action( 'customize_register', array( $this, 'set_controls' ), 35 );
    }

    public function add_controls( $wp_customize ) {
        $this->controls = array(
            'ajzaa_options_array[ajzaa_theme_custom_css]' => array(
                'label' => __( 'Custom CSS', 'ajzaa' ),
                'type' => 'textarea',
                'default' => ajzaa_get_option('ajzaa_theme_custom_css'),
                'description' => 'Custom CSS',
                'input_attrs' => array(
                    'placeholder' => esc_html__('Put your style here','ajzaa')
                )
            ),
            'ajzaa_options_array[ajzaa_theme_custom_js]' => array(
                'label' => __( 'Custom JavaScript', 'ajzaa' ),
                'type' => 'textarea',
                'default' => ajzaa_get_option('ajzaa_theme_custom_js'),
                'description' => 'Custom JavaScript',
                'input_attrs' => array(
                    'placeholder' => esc_html__('Put your JavaScript here','ajzaa')
                )
            ),
        );

        return $this->controls;
    }

}

new ajzaa_Customizer_Controls_Custom_CSS_JS();
