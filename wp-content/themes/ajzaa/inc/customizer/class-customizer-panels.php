<?php

class ajzaa_Customizer_Panels {

    public function __construct() {
        $this->priority = new ajzaa_Customizer_Priority(0, 10);

        add_action( 'customize_register', array( $this, 'register_panels' ), 9 );
      //  add_action( 'customize_register', array( $this, 'organize_appearance' ), 11 );
    }

    public function panel_list() {
        $this->panels = array();


        $this->panels[ 'ajzaa_options' ] = array(
            'title' => __( 'ajzaa options', 'ajzaa' ),
            'sections' => array(
                'ajzaa_general' => array(
                    'title' => __( 'General Settings', 'ajzaa' ),
                ),
                'ajzaa_colors' => array(
                    'title' => __( 'Colors Settings', 'ajzaa' ),
                ),
                'ajzaa_social_icons' => array(
                    'title' => __( 'Social Icons Settings', 'ajzaa' ),
                ),
                'ajzaa_custom_css_js' => array(
                    'title' => __( 'Custom CSS & JS', 'ajzaa' ),
                ),
                'ajzaa_footer' => array(
                    'title' => __( 'Footer Settings', 'ajzaa' ),
                )
            )
        );


        return $this->panels;
    }

    public function register_panels( $wp_customize ) {
        $panels = $this->panel_list();

        foreach ( $panels as $key => $panel ) {
            $defaults = array(
                'priority' => $this->priority->next()
            );

            $panel = wp_parse_args( $defaults, $panel );

            $wp_customize->add_panel( $key, $panel );

            $sections = isset( $panel[ 'sections' ] ) ? $panel[ 'sections' ] : false;

            if ( $sections ) {
                $this->add_sections( $key, $sections, $wp_customize );
            }
        }
    }

    public function add_sections( $panel, $sections, $wp_customize ) {
        foreach ( $sections as $key => $section ) {
            $wp_customize->add_section( $key, array(
                'title' => $section[ 'title' ],
                'panel' => $panel,
                'priority' => isset( $section[ 'priority' ] ) ? $section[ 'priority' ] : $this->priority->next(),
                'description' => isset( $section[ 'description' ] ) ? $section['description' ] : ''
            ) );

            include_once( get_template_directory() . '/inc/customizer/controls/class-controls-' . $key . '.php' );
        }
    }

    public function organize_appearance( $wp_customize ) {
        $wp_customize->get_section( 'ajzaa_general' )->panel = 'ajzaa_options';
        $wp_customize->get_section( 'ajzaa_colors' )->panel = 'ajzaa_options';
        $wp_customize->get_section( 'ajzaa_social_icons' )->panel = 'ajzaa_options';
        $wp_customize->get_section( 'ajzaa_custom_css_js' )->panel = 'ajzaa_options';
        $wp_customize->get_section( 'ajzaa_footer' )->panel = 'ajzaa_options';

        return $wp_customize;
    }

}
