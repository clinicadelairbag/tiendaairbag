<?php
/**
 * Plugin Name:			Storefront Product Pagination
 * Plugin URI:			http://woothemes.com/storefront/
 * Description:			Add unobstrusive links to next/previous products on your WooCommerce single product pages.
 * Version:				1.2.4
 * Author:				WooThemes
 * Author URI:			http://woothemes.com/
 * Requires at least:	4.0
 * Tested up to:		4.9
 *
 * Text Domain: storefront-product-pagination
 * Domain Path: /languages/
 *
 * @package Storefront_Product_Pagination
 * @category Core
 * @author James Koster
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Only load plugin if Storefront version is under 2.3.0.
 *
 * @since 1.2.4
 * @return void
 */
function storefront_product_pagination_init() {
	global $storefront_version;

	if ( class_exists( 'Storefront' ) && version_compare( $storefront_version, '2.3.0', '<' ) ) {
		require 'classes/class-storefront-product-pagination.php';
		require 'functions/functions.php';

		storefront_product_pagination();
	}
} // end storefront_product_pagination_init()

add_action( 'after_setup_theme', 'storefront_product_pagination_init' );