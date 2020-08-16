<?php
/**
 * Returns the main instance of Storefront_Product_Pagination to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Storefront_Product_Pagination
 */
function storefront_product_pagination() {
	return Storefront_Product_Pagination::instance();
} // End storefront_product_pagination()