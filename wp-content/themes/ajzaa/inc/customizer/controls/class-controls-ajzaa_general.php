<?php

class ajzaa_Customizer_Controls_General extends ajzaa_Customizer_Controls {

    public $controls = array();

    public function __construct() {
        $this->section = 'ajzaa_general';
     //   $this->priority = new ajzaa_Customizer_Priority(0, 1);

        parent::__construct();

        add_action( 'customize_register', array( $this, 'add_controls' ), 30 );
        add_action( 'customize_register', array( $this, 'set_controls' ), 35 );
    }

    public function add_controls( $wp_customize ) {
        $this->controls = array(
            'ajzaa_options_array[ajzaa_logo_path]' => array(
                'label' => __( 'Logo Link', 'ajzaa' ),
                'type' => 'WP_Customize_Image_Control',
                'default' => ajzaa_get_option('ajzaa_logo_path'),
                'description' => 'Logo link',
                'settings' => 'ajzaa_options_array[ajzaa_logo_path]'
            ),
            'ajzaa_options_array[ajzaa_bg_single_post_path]' => array(
                'label' => __( 'Background Title Bar for Single Post', 'ajzaa' ),
                'type' => 'WP_Customize_Image_Control',
                'default' => ajzaa_get_option('ajzaa_bg_single_post_path'),
                'description' => 'Background title bar for single post',
                'settings' => 'ajzaa_options_array[ajzaa_bg_single_post_path]'
            )
        );

        return $this->controls;
    }

}

new ajzaa_Customizer_Controls_General();
