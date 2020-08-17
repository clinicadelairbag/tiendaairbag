<?php
/*
	* Plugin Name: Request a Quote for WooCommerce
	* Plugin URI: https://woocommerce.com/products/request-a-quote-plugin/
	* Description: Hide Product Price on shop and product detail page and add a quote button.
	* Author: Addify
	* Author URI: http://www.addifypro.com/
	* Text Domain: addify_rfq
	* Version: 1.4.1
	*
	* Woo: 4872510:f687f573919bd78647d0bcacb5277b76
	* WC requires at least: 3.0.9
	* WC tested up to: 4.0
	*
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {

	function afreg_admin_notice() {

		$afrfq_allowed_tags = array(
			'a' => array(
				'class' => array(),
				'href'  => array(),
				'rel'   => array(),
				'title' => array(),
			),
			'b' => array(),

			'div' => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'p' => array(
				'class' => array(),
			),
			'strong' => array(),

		);

		// Deactivate the plugin
		deactivate_plugins(__FILE__);

		$afrfq_woo_check = '<div id="message" class="error">
			<p><strong>Request a Quote for WooCommerce is inactive.</strong> The <a href="http://wordpress.org/extend/plugins/woocommerce/">WooCommerce plugin</a> must be active for this plugin to work. Please install &amp; activate WooCommerce »</p></div>';
		echo wp_kses( __( $afrfq_woo_check, 'addify_rfq' ), $afrfq_allowed_tags);

	}
	add_action('admin_notices', 'afrfq_admin_notice');
}

if (!class_exists('Addify_Request_For_Quote') ) {

	class Addify_Request_For_Quote {

		public function __construct() {

			$this->afrfq_global_constents_vars();
			register_activation_hook(__FILE__, array($this, 'afrfq_add_quote_page'));
			add_action('wp_loaded', array( $this, 'afrfq_init' ));
			add_action( 'init', array($this, 'afrfq_custom_post_type' ));
			if (is_admin() ) {
				include_once AFRFQ_PLUGIN_DIR . 'admin/class-afrfq-admin.php';
			} else {
				include_once AFRFQ_PLUGIN_DIR . 'front/class-afrfq-front.php';
			}

			add_action('wp_ajax_add_to_quote', array($this, 'afrfq_add_to_quote_callback_function'));
			add_action('wp_ajax_nopriv_add_to_quote', array($this, 'afrfq_add_to_quote_callback_function'));

			add_action('wp_ajax_add_to_quote_single', array($this, 'afrfq_add_to_quote_single_callback_function'));
			add_action('wp_ajax_nopriv_add_to_quote_single', array($this, 'afrfq_add_to_quote_single_callback_function'));

			add_action('wp_ajax_add_to_quote_single_vari', array($this, 'afrfq_add_to_quote_single_vari_callback_function'));
			add_action('wp_ajax_nopriv_add_to_quote_single_vari', array($this, 'afrfq_add_to_quote_single_vari_callback_function'));


			add_action('wp_ajax_remove_quote_item', array($this, 'afrfq_remove_quote_item_callback_function'));
			add_action('wp_ajax_nopriv_remove_quote_item', array($this, 'afrfq_remove_quote_item_callback_function'));
		}

		public function afrfq_global_constents_vars() {

			if (!defined('AFRFQ_URL') ) {
				define('AFRFQ_URL', plugin_dir_url(__FILE__));
			}

			if (!defined('AFRFQ_BASENAME') ) {
				define('AFRFQ_BASENAME', plugin_basename(__FILE__));
			}

			if (! defined('AFRFQ_PLUGIN_DIR') ) {
				define('AFRFQ_PLUGIN_DIR', plugin_dir_path(__FILE__));
			}
		}

		public function afrfq_init() {
			if (function_exists('load_plugin_textdomain') ) {
				load_plugin_textdomain('addify_rfq', false, dirname(plugin_basename(__FILE__)) . '/languages/');
			}
		}

		public function afrfq_custom_post_type() {

			$labels = array(
				'name'                => esc_html__('Request for Quote Rules', 'addify_rfq'),
				'singular_name'       => esc_html__('Request for QuotevRule', 'addify_rfq'),
				'add_new'             => esc_html__('Add New Rule', 'addify_rfq'),
				'add_new_item'        => esc_html__('Add New Rule', 'addify_rfq'),
				'edit_item'           => esc_html__('Edit Rule', 'addify_rfq'),
				'new_item'            => esc_html__('New Rule', 'addify_rfq'),
				'view_item'           => esc_html__('View Rule', 'addify_rfq'),
				'search_items'        => esc_html__('Search Rule', 'addify_rfq'),
				'exclude_from_search' => true,
				'not_found'           => esc_html__('No rule found', 'addify_rfq'),
				'not_found_in_trash'  => esc_html__('No rule found in trash', 'addify_rfq'),
				'parent_item_colon'   => '',
				'all_items'           => esc_html__('All Rules', 'addify_rfq'),
				'menu_name'           => esc_html__('Request for Quote', 'addify_rfq'),
			);

			$args = array(
				'labels' => $labels,
				'menu_icon'  => plugin_dir_url( __FILE__ ) . 'assets/images/small_logo_white.png',
				'public' => false,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'query_var' => true,
				'rewrite' => true,
				'capability_type' => 'post',
				'has_archive' => true,
				'hierarchical' => false,
				'menu_position' => 30,
				'rewrite' => array('slug' => 'addify_rfq', 'with_front'=>false ),
				'supports' => array('title')
			);

			register_post_type( 'addify_rfq', $args );

			register_post_type( 'addify_quote',
				array(
					'public' => true,
					'show_in_menu' => false,
					'labels' => array(
						'name'  => esc_html__('All Quotes', 'addify_rfq'),
					),
					'supports' => array(''),

				)
			);

		}

		public function afrfq_add_quote_page() {

			if (null == get_page_by_path('request-a-quote')) {

				$new_page = array(
					'post_status' => 'publish',
					'post_type' => 'page',
					'post_author' => 1,
					'post_name' => esc_html__('request-a-quote', 'addify_rfq'),
					'post_title' => esc_html__('Request a Quote', 'addify_rfq'),
					'post_content' => '[addify-quote-request-page]',
					'post_parent' => 0,
					'comment_status' => 'closed'
				);

				$page_id = wp_insert_post($new_page);

				update_option('addify_atq_page_id', $page_id);
			} else {
				$page_id = get_page_by_path('request-a-quote');
				update_option('addify_atq_page_id', $page_id);
			}

			if ( empty(get_option('afrfq_fields'))) {

				$newval = array();

				$enable_field       = 'yes';
				$field_required     = 'yes';
				$field_label        = 'Name';
				$field_sort_order   = 1;
				$file_allowed_types = '';
				$field_key          = 'afrfq_name_field';

				$enable_field1       = 'yes';
				$field_required1     = 'yes';
				$field_label1        = 'Email';
				$field_sort_order1   = 2;
				$file_allowed_types1 = '';
				$field_key1          = 'afrfq_email_field';

				$enable_field2       = 'yes';
				$field_required2     = 'yes';
				$field_label2        = 'Message';
				$field_sort_order2   = 3;
				$file_allowed_types2 = '';
				$field_key2          = 'afrfq_message_field';

				$newval['field_0'] = array('enable_field' => $enable_field, 'field_required' => $field_required, 'field_label' => $field_label, 'field_sort_order' => $field_sort_order, 'field_key' => $field_key, 'file_allowed_types' => $file_allowed_types);

				$newval['field_1'] = array('enable_field' => $enable_field1, 'field_required' => $field_required1, 'field_label' => $field_label1, 'field_sort_order' => $field_sort_order1, 'field_key' => $field_key1, 'file_allowed_types' => $file_allowed_types1);

				$newval['field_2'] = array('enable_field' => $enable_field2, 'field_required' => $field_required2, 'field_label' => $field_label2, 'field_sort_order' => $field_sort_order2, 'field_key' => $field_key2, 'file_allowed_types' => $file_allowed_types2);

				update_option('afrfq_fields', serialize(sanitize_meta('afrfq_fields', $newval, '')));
			}
		}

		public function afrfq_add_to_quote_callback_function() {

			global $wp_session;

			if ( ! session_id() ) {
				session_start();
			}

			if (isset($_POST['nonce']) && '' != $_POST['nonce']) {

				$nonce = sanitize_text_field( $_POST['nonce'] );
			} else {
				$nonce = 0;
			}

			if ( ! wp_verify_nonce( $nonce, 'afquote-ajax-nonce' ) ) {

				die ( 'Failed ajax security check!');
			}

			if (!empty($_REQUEST['product_id'])) {

				$product_id = intval($_REQUEST['product_id']);
			} else {
				$product_id = intval(0);
			}
			
			if (isset($_REQUEST['variation_id'])) {
				$product_id = intval($_REQUEST['variation_id']);
			}

			if (!empty($_REQUEST['quantity'])) {
				$product_quantity = intval($_REQUEST['quantity']);
			} else {
				$product_quantity = intval(0);
			}

			if ( !empty( $_REQUEST['woo_addons'])) {

				$woo_addons = sanitize_meta('', $_REQUEST['woo_addons'], '');

			} else {

				$woo_addons = '';
			}

			if ( !empty( $_REQUEST['woo_addons1'])) {

				$woo_addons1 = sanitize_meta('', $_REQUEST['woo_addons1'], '');

			} else {

				$woo_addons1 = '';
			}
			
			$key = -1;

			$quotes = array();
			if (!empty(WC()->session->get( 'quotes' ))) {

				$quotes = WC()->session->get( 'quotes' );
				$keys   = array_keys(array_combine(array_keys($quotes), array_column($quotes, 'pid')), $product_id);
				if (!empty($keys)) {
					$key = $keys[0];
				}
			}

			if ( (int) $key >= 0 ) {

				$quotes[$key]['quantity'] = (int) $quotes[$key]['quantity'] + (int) $product_quantity;
			} else {

				$quote = array('pid' => $product_id, 'quantity' => $product_quantity, 'woo_addons' => $woo_addons, 'woo_addons1' => $woo_addons1);
				array_push($quotes, $quote);
			}

			WC()->session->set('quotes', $quotes);


			if ('yes' == get_option('enable_ajax_shop')) {
				include_once AFRFQ_PLUGIN_DIR . 'ajax_add_to_quote.php';
			} else {

				echo 'success';
			}

			die();

		}

		public function afrfq_add_to_quote_single_vari_callback_function() {

			global $wp_session;

			if ( ! session_id() ) {
				session_start();
			}

			if (isset($_POST['nonce']) && '' != $_POST['nonce']) {

				$nonce = sanitize_text_field( $_POST['nonce'] );
			} else {
				$nonce = 0;
			}

			if ( ! wp_verify_nonce( $nonce, 'afquote-ajax-nonce' ) ) {

				die ( 'Failed ajax security check!');
			}

			if (!empty($_REQUEST['vari_id'])) {
				$vari_id = intval($_REQUEST['vari_id']);
			} else {
				$vari_id = 0;
			}
			
			if (!empty($_REQUEST['product_id'])) {
				$product_id = intval($_REQUEST['product_id']);
			} else {
				$product_id = 0;
			}

			if (!empty($_REQUEST['variation'])) {
				$variation = sanitize_meta('', $_REQUEST['variation'], '');
			} else {
				$variation = array();
			}
			
			if (!empty($_REQUEST['quantity'])) {
				$product_quantity = intval($_REQUEST['quantity']);
			} else {
				$product_quantity = intval(0);
			}

			if ( !empty( $_REQUEST['woo_addons'])) {

				$woo_addons = sanitize_meta('', $_REQUEST['woo_addons'], '');

			} else {

				$woo_addons = '';
			}

			if ( !empty( $_REQUEST['woo_addons1'])) {

				$woo_addons1 = sanitize_meta('', $_REQUEST['woo_addons1'], '');

			} else {

				$woo_addons1 = '';
			}
			
			$key = -1;

			$quotes = array();
			if (!empty(WC()->session->get( 'quotes' ))) {

				$quotes = WC()->session->get( 'quotes' );

				$keys = array_keys(array_combine(array_keys($quotes), array_column($quotes, 'vari_id')), $vari_id);


				if (!empty($keys)) {
					$key = $keys[0];
				}
			}

			if ((int) $key >= 0) {

				$quotes[$key]['quantity'] = (int) $quotes[$key]['quantity'] + (int) $product_quantity;
			} else {

				$quote = array('pid' => $product_id,'vari_id' => $vari_id,  'quantity' => $product_quantity,'variation' => $variation , 'woo_addons' => $woo_addons, 'woo_addons1' => $woo_addons1);
				array_push($quotes, $quote);
			}

			

			WC()->session->set('quotes', $quotes);
			
			if ('yes' == get_option('enable_ajax_product')) {
				include_once AFRFQ_PLUGIN_DIR . 'ajax_add_to_quote.php';
			} else {

				echo 'success';
			}

			die();

		}

		public function afrfq_add_to_quote_single_callback_function() {


			global $wp_session;

			if ( ! session_id() ) {
				session_start();
			}

			if (isset($_POST['nonce']) && '' != $_POST['nonce']) {

				$nonce = sanitize_text_field( $_POST['nonce'] );
			} else {
				$nonce = 0;
			}

			if ( ! wp_verify_nonce( $nonce, 'afquote-ajax-nonce' ) ) {

				die ( 'Failed ajax security check!');
			}

			if (!empty($_REQUEST['product_id'])) {
				$product_id = intval($_REQUEST['product_id']);
			} else {
				$product_id = 0;
			}
			
			if (!empty($_REQUEST['quantity'])) {
				$product_quantity = intval($_REQUEST['quantity']);
			} else {
				$product_quantity = 0;
			}

			if ( !empty( $_REQUEST['woo_addons'])) {

				$woo_addons = sanitize_meta('', $_REQUEST['woo_addons'], '');

			} else {

				$woo_addons = '';
			}

			if ( !empty( $_REQUEST['woo_addons1'])) {

				$woo_addons1 = sanitize_meta('', $_REQUEST['woo_addons1'], '');

			} else {

				$woo_addons1 = '';
			}
			
			$key = -1;

			$quotes = array();
			if (!empty(WC()->session->get( 'quotes' ))) {

				$quotes = WC()->session->get( 'quotes' );
				$keys   = array_keys(array_combine(array_keys($quotes), array_column($quotes, 'pid')), $product_id);
				if (!empty($keys)) {
					$key = $keys[0];
				}
			}

			if ((int) $key >= 0) {

				$quotes[$key]['quantity'] = (int) $quotes[$key]['quantity'] + (int) $product_quantity;
			} else {

				$quote = array('pid' => $product_id, 'quantity' => $product_quantity, 'woo_addons' => $woo_addons, 'woo_addons1' => $woo_addons1);
				array_push($quotes, $quote);
			}

			WC()->session->set('quotes', $quotes);
			
			if ('yes' == get_option('enable_ajax_product')) {
				include_once AFRFQ_PLUGIN_DIR . 'ajax_add_to_quote.php';
			} else {

				echo 'success';
			}

			die();

		}

		public function afrfq_remove_quote_item_callback_function() {

			global $wp_session;

			if ( ! session_id() ) {
				session_start();
			}

			if (isset($_POST['nonce']) && '' != $_POST['nonce']) {

				$nonce = sanitize_text_field( $_POST['nonce'] );
			} else {
				$nonce = 0;
			}

			if ( ! wp_verify_nonce( $nonce, 'afquote-ajax-nonce' ) ) {

				die ( 'Failed ajax security check!');
			}

			if (!empty($_REQUEST['quote_key'])) {
				$quote_key = intval($_REQUEST['quote_key']);
			} else {
				$quote_key = 0;
			}
			
			//print_r($_SESSION);
			$quotes = WC()->session->get( 'quotes' );
			//print_r($quotes);
			unset($quotes[$quote_key]);
			sort($quotes);
			WC()->session->set('quotes', $quotes);
			$quoteItemCount = 0;
			foreach ($quotes as $qouteItem) {

				$quoteItemCount += $qouteItem['quantity'];
			}
			echo intval($quoteItemCount);
			die();
		}
	}

	new Addify_Request_For_Quote();

}

