<?php
/**
 * @todo Redo
 */
class ajzaa_Customizer {

    public function __construct() {
        $files = array(
            'class-customizer-priority.php',
            'class-customizer-panels.php',
            'class-customizer-controls.php',
            'class-customizer-css.php'

        );

        foreach ( $files as $file ) {
            include_once( trailingslashit( get_template_directory() . '/inc/customizer/') . $file );
        }


        $this->setup_actions();
    }

    public function setup_actions() {
        add_action( 'customize_register', array( $this, 'custom_controls' ) );
        add_action( 'customize_register', array( $this, 'init_panels' ) );

        $this->init_panels();
    }

    public function custom_controls() {
        include_once( get_template_directory() . '/inc/customizer/control/class-control-multicheck.php' );
    }

    public function init_panels() {
        $this->panels = new ajzaa_Customizer_Panels();
    }

}
