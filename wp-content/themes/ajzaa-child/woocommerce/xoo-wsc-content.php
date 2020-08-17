<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

$empty_cart_txt 	= isset( $options['sc-empty-text']) ? $options['sc-empty-text'] : __('Tu carrito esta vacío.','side-cart-woocommerce');
$head_title 		= isset($options['sc-head-text']) ? $options['sc-head-text']: __("Su carrito",'side-cart-woocommerce'); //Head Title

?>


<div class="xoo-wsc-header">
    <?php do_action( 'xoo_wsc_before_header' ); ?>
    <span class="xoo-wsc-ctxt"><?php esc_attr_e($head_title,'side-cart-woocommerce'); ?></span>
    <span class="xoo-wsc-icon-cross xoo-wsc-close"></span>
</div>

<div class="xoo-wsc-body">

    <?php do_action( 'xoo_wsc_before_product_summary' ); ?>

    <div class="xoo-wsc-content">
        <?php do_action( 'woocommerce_before_cart_contents' ); ?>
        <?php if(WC()->cart->is_empty()): ?>
            <span class="xoo-wsc-ecnt"><?php esc_attr_e($empty_cart_txt,'side-cart-woocommerce'); ?></span>
        <?php else: ?>

            <?php
            $subtotal_txt 	= isset($options['sc-subtotal-text']) ? $options['sc-subtotal-text']: __("Subtotal:",'side-cart-woocommerce');
            $shipping_txt 	= isset($options['sc-shipping-text']) ? $options['sc-shipping-text']: __("Para conocer el costo de envío, proceda al pago.",'side-cart-woocommerce');
            $show_ptotal 	= isset( $options['sc-show-ptotal']) ? $options['sc-show-ptotal'] : 1;


            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );



                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );




                    $product_name =  apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );



                    $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

                    $product_subtotal = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );

                    $attributes = '';

                    //Variation
                    $attributes .= $_product->is_type('variable') || $_product->is_type('variation') ? wc_get_formatted_variation($_product) : '';
                    // Meta data
                    if(version_compare( WC()->version , '3.3.0' , "<" )){
                        $attributes .=  WC()->cart->get_item_data( $cart_item );
                    }
                    else{
                        $attributes .=  wc_get_formatted_cart_item_data( $cart_item );
                    }


                    //Woocommerce Bundled Products
                    $bundled_parent  = $bundled_child = null;
                    $extra_classes 	 = array();
                    if(isset($cart_item['bundled_items'])){
                        $bundled_parent = true;
                        $extra_classes[] = 'xoo-wsc-bundled-parent';
                    }
                    elseif(isset($cart_item['bundled_by'])){
                        $bundled_child = true;
                        $extra_classes[] = 'xoo-wsc-bundled-child';
                    }


                    //Mix and match
                    if(isset($cart_item['mnm_contents'])){
                        $bundled_parent = true;
                        $extra_classes[] = 'xoo-wsc-mnm-parent';
                    }
                    elseif(isset($cart_item['mnm_container'])){
                        $bundled_child = true;
                        $extra_classes[] = 'xoo-wsc-mnm-child';
                    }

                    //Composite products
                    if(isset($cart_item['composite_children'])){
                        $bundled_parent = true;
                        $extra_classes[] = 'xoo-wsc-comp-parent';
                    }
                    elseif(isset($cart_item['composite_parent'])){
                        $bundled_child = true;
                        $extra_classes[] = 'xoo-wsc-comp-child';
                    }

                    if($bundled_parent){
                        $extra_classes[] = 'xoo-wsc-is-parent';
                    }
                    elseif($bundled_child){
                        $extra_classes[] = 'xoo-wsc-is-child';
                    }


                    ?>

                    <div class="xoo-wsc-product <?php echo implode(' ',$extra_classes); ?>" data-xoo_wsc="<?php echo $cart_item_key; ?>">
                        <div class="xoo-wsc-img-col">

                            <a href="<?php echo $product_permalink; ?>"><?php echo $thumbnail; ?></a>
                            <?php if(!$bundled_child): ?>
                                <a href="#" class="xoo-wsc-remove"><?php _e('Eliminar','side-cart-woocommerce'); ?></a>
                            <?php endif; ?>

                        </div>
                        <div class="xoo-wsc-sum-col">

                            <?php do_action('xoo_wsc_before_product_summary',$_product); ?>

                            <?php echo $product_name; ?>

                            <?php echo $attributes ? $attributes : ''; ?>

                            <?php if(!$bundled_child): ?>

                                <div class="xoo-wsc-price">
                                    <span><?php echo $cart_item['quantity']; ?></span> X <span><?php echo $product_price; ?></span>
                                    <?php if($show_ptotal == 1): ?>
                                        = <span><?php echo $product_subtotal; ?></span>
                                    <?php endif; ?>
                                </div>

                            <?php else: ?>
                                <div class="xoo-wsc-child-qty"><span><?php _e('Cant:','side-cart-for-woocommerce'); ?></span><span><?php echo $cart_item['quantity']; ?></span></div>
                            <?php endif; ?>

                            <?php do_action('xoo_wsc_after_product_summary',$_product); ?>

                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php endif; ?>

        <div class="xoo-wsc-updating">
            <span class="xoo-wsc-icon-spinner2" aria-hidden="true"></span>
            <span class="xoo-wsc-uopac"></span>
        </div>
    </div>

    <?php do_action( 'xoo_wsc_after_product_summary' ); ?>

</div>