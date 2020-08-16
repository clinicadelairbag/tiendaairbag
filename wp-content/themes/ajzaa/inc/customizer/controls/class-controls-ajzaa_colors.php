<?php

class ajzaa_Customizer_Controls_Colors extends ajzaa_Customizer_Controls {

    public $controls = array();

    public function __construct() {
        $this->section = 'ajzaa_colors';
        //  $this->priority = new ajzaa_Customizer_Priority(0, 1);

        parent::__construct();

        add_action( 'customize_register', array( $this, 'add_controls' ), 30 );
        add_action( 'customize_register', array( $this, 'set_controls' ), 35 );
    }

    public function add_controls( $wp_customize ) {
        $this->controls = array(
            'ajzaa_options_array[ajzaa_primary_color]' => array(
                'label' => __( 'Primary Color', 'ajzaa' ),
                'type' => 'WP_Customize_Color_Control',
                'default' => ajzaa_get_option('ajzaa_primary_color'),
                'description' => 'ajzaa primary color control'
            ),
            'ajzaa_options_array[ajzaa_secondary_color]' => array(
                'label' => __( 'Secondary Color', 'ajzaa' ),
                'type' => 'WP_Customize_Color_Control',
                'default' => ajzaa_get_option('ajzaa_secondary_color'),
                'description' => 'ajzaa secondary color control'
            ),
            'ajzaa_options_array[ajzaa_nav_bg_color]' => array(
                'label' => __( 'Navigation Background Color', 'ajzaa' ),
                'type' => 'WP_Customize_Color_Control',
                'default' => ajzaa_get_option('ajzaa_nav_bg_color'),
                'description' => 'Navigation background color control'
            ),
            'ajzaa_options_array[ajzaa_nav_text_color]' => array(
                'label' => __( 'Navigation Text Color', 'ajzaa' ),
                'type' => 'WP_Customize_Color_Control',
                'default' => ajzaa_get_option('ajzaa_nav_text_color'),
                'description' => 'Navigation text color control'
            ),
            'ajzaa_options_array[ajzaa_top_header_bg_color]' => array(
                'label' => __( 'Top Header Background Color', 'ajzaa' ),
                'type' => 'WP_Customize_Color_Control',
                'default' => ajzaa_get_option('ajzaa_top_header_bg_color'),
                'description' => 'Top header background color control'
            ),
            'ajzaa_options_array[ajzaa_top_header_text_color]' => array(
                'label' => __( 'Top Header Text Color', 'ajzaa' ),
                'type' => 'WP_Customize_Color_Control',
                'default' => ajzaa_get_option('ajzaa_top_header_text_color'),
                'description' => 'Top header text color control'
            )
        );

        return $this->controls;
    }

}

new ajzaa_Customizer_Controls_Colors();
