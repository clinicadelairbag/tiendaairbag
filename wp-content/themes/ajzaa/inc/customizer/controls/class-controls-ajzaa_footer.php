<?php

class ajzaa_Customizer_Controls_Footer extends ajzaa_Customizer_Controls {

    public $controls = array();

    public function __construct() {
        $this->section = 'ajzaa_footer';
        $this->priority = new ajzaa_Customizer_Priority(49, 1);

        parent::__construct();

        add_action( 'customize_register', array( $this, 'add_controls' ), 30 );
        add_action( 'customize_register', array( $this, 'set_controls' ), 35 );
    }

    public function add_controls( $wp_customize ) {
        $this->controls = array(
            'ajzaa_options_array[ajzaa_footer_columns]' => array(
                'label' => __( 'Footer columns', 'ajzaa' ),
                'type'    => 'radio',
                'default' => ajzaa_get_option('ajzaa_footer_columns'),
                'choices' => array(
                    'one_columns' => __( '1 Column', 'ajzaa' ),
                    'tow_a_columns' => __( '2 columns (1/2 + 1/2)', 'ajzaa' ),
                    'tow_b_columns' => __( '2 columns (1/3 + 2/3)', 'ajzaa' ),
                    'tow_c_columns' => __( '2 columns (2/3 + 1/3)', 'ajzaa' ),
                    'three_columns' => __( '3 columns', 'ajzaa' )
                ),
                'sanitize_callback' => 'esc_attr',
                'description' => __( 'Footer columns', 'ajzaa' )
            ),
            'ajzaa_options_array[ajzaa_copyright]' => array(
                'label' => __( 'Footer Copyright Text', 'ajzaa' ),
                'type' => 'text',
                'default' => ajzaa_get_option('ajzaa_copyright'),
                'description' => 'Footer copyright text',
                'input_attrs' => array(
                    'placeholder' => esc_html__('Footer copyright text','ajzaa')
                )
            )
        );

        return $this->controls;
    }

}

new ajzaa_Customizer_Controls_Footer();
