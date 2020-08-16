<?php
/*
Plugin Name: Woo Quick View
Plugin URI: http://ciphercoin.com/
Description: Woo Quick View plugin allows the customers to have a brief overview of every product in a light box.
Author: Arshid
Author URI: http://ciphercoin.com/
Text Domain: woo-quick-view
Version: 1.1.0
*/


register_activation_hook( __FILE__, 'wcqv_quick_view_activate' );
function wcqv_quick_view_activate(){

	add_option( 'wpcqv_view_install_date', date('Y-m-d G:i:s'), '', 'yes');

	$data = array(
		'enable_quick_view' => '1',
		'enable_mobile'     => '0',
		'button_lable'      => 'Quick View'
		);
	add_option( 'wcqv_options', $data, '', 'yes' );

	$data = array(
		'modal_bg'   		=> '#fff',
		'close_btn'   		=> '#95979c',
		'close_btn_bg' 		=> '#4C6298',
		'navigation_bg'		=> 'rgba(255, 255, 255, 0.2)',
		'navigation_txt'    => '#fff'

		);
	add_option( 'wcqv_style', $data, '', 'yes' );
}


register_deactivation_hook( __FILE__, 'wcqv_quick_view_deactivate' );
function wcqv_quick_view_deactivate(){
    
	delete_option( 'wcqv_style' );
    delete_option( 'wcqv_options' );
    delete_option( 'wpcqv_view_install_date' );

}


add_action('plugins_loaded','wqv_load_class_files');

function wqv_load_class_files(){

    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
 
		require_once 'classes/class.frontend.php';
		require_once 'classes/class.backend.php';

		load_plugin_textdomain( 'woocommerce-quick-view', false, plugin_basename( dirname( __FILE__ ) ) . '/lang' ); 
		

		$wcqv_plugin_dir_url  = plugin_dir_url( __FILE__ );
		$data                 = get_option('wcqv_options');
		$load_backend         = new wcqv_backend($wcqv_plugin_dir_url);
		$enable_mobile        = ($data['enable_mobile']==='1')?true:false;


		if ( $load_backend->mobile_detect() ){

			if($enable_mobile  && ($data['enable_quick_view'] == 1)){
			
				$load_frontend 	  = new wcqv_frontend($wcqv_plugin_dir_url);
			}

		}else{

			if ( $data['enable_quick_view'] == 1 ){
			 	$load_frontend 	  = new wcqv_frontend($wcqv_plugin_dir_url);
			}

		}

	}
}


//Add settings link on plugin page
function wcqv_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=woocommerce-quick-qiew">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'wcqv_settings_link' );




