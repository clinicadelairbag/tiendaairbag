<?php

class ajzaa_Customizer_Controls_Social_Icons extends ajzaa_Customizer_Controls {

    public $controls = array();

    public function __construct() {
        $this->section = 'ajzaa_social_icons';
     //   $this->priority = new ajzaa_Customizer_Priority(0, 1);

        parent::__construct();

        add_action( 'customize_register', array( $this, 'add_controls' ), 30 );
        add_action( 'customize_register', array( $this, 'set_controls' ), 35 );
    }

    public function add_controls( $wp_customize ) {
        $this->controls = array(
            'ajzaa_options_array[ajzaa_show_top_social_bare]' => array(
                'label' => __( 'Show Top Bar', 'ajzaa' ),
                'type' => 'checkbox',
                'description' => 'Show or hide top bar',
                'default' => ajzaa_get_option('ajzaa_show_top_social_bare')
            ),
            'ajzaa_options_array[ajzaa_facebook]' => array(
                'label' => __( 'Facebook', 'ajzaa' ),
                'type' => 'text',
                'default' => ajzaa_get_option('ajzaa_facebook'),
                'description' => 'Facebook',
                'input_attrs' => array(
                    'placeholder' => esc_html__('Your Facebook Page Link','ajzaa')
                )
            ),
            'ajzaa_options_array[ajzaa_twitter]' => array(
                'label' => __( 'Twitter', 'ajzaa' ),
                'type' => 'text',
                'default' => ajzaa_get_option('ajzaa_twitter'),
                'description' => 'Twitter',
                'input_attrs' => array(
                    'placeholder' => esc_html__('Your Twitter Page Link','ajzaa')
                )
            ),
            'ajzaa_options_array[ajzaa_google_plus]' => array(
                'label' => __( 'Google+', 'ajzaa' ),
                'type' => 'text',
                'default' => ajzaa_get_option('ajzaa_google_plus'),
                'description' => 'Google+',
                'input_attrs' => array(
                    'placeholder' => esc_html__('Your Google+ Page Link','ajzaa')
                )
            ),
            'ajzaa_options_array[ajzaa_phone]' => array(
                'label' => __( 'Phone', 'ajzaa' ),
                'type' => 'text',
                'default' => ajzaa_get_option('ajzaa_phone'),
                'description' => 'Phone',
                'input_attrs' => array(
                    'placeholder' => esc_html__('Your Phone number','ajzaa')
                )
            ),
            'ajzaa_options_array[ajzaa_address]' => array(
                'label' => __( 'Address', 'ajzaa' ),
                'type' => 'text',
                'default' => ajzaa_get_option('ajzaa_address'),
                'description' => 'Address',
                'input_attrs' => array(
                    'placeholder' => esc_html__('Your first Address','ajzaa')
                )
            )
        );

        return $this->controls;
    }

}

new ajzaa_Customizer_Controls_Social_Icons();
