<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<?php wp_head() ?>
</head>
<body <?php body_class() ?>>
<?php


    if (function_exists( 'WC' )) {
	if(ajzaa_is_blog()){
		$page_for_posts = get_option( 'page_for_posts' );
		$page_header_style = ajzaa_get_option( 'ajzaa_header_style', '1' );
	}elseif(is_shop()){
		$page_header_style = get_post_meta(get_option( 'woocommerce_shop_page_id' ), "header_style", true);
	}elseif(is_product()){
		$page_header_style = get_post_meta(get_option( 'woocommerce_shop_page_id' ), "header_style", true);
	}elseif(is_cart()){
		$page_header_style = get_post_meta(get_option( 'woocommerce_cart_page_id' ), "header_style", true);
	}elseif(is_checkout()){
		$page_header_style = get_post_meta(get_option( 'woocommerce_checkout_page_id' ), "header_style", true);
	}elseif(is_account_page()){
		$page_header_style = get_post_meta(get_option( 'woocommerce_myaccount_page_id' ), "header_style", true);
	}elseif(is_404()){
		$page_header_style = "default";
	}
}
    if(ajzaa_is_blog() || is_404()) {
        if (get_option('page_for_posts') != 0) {
            $page_for_posts = get_option('page_for_posts');
            $page_header_style = get_post_meta($page_for_posts, "header_style", true);
        } else {
            $page_header_style = "default";
        }
    } else {
        if (isset($posts[0]->ID)) {
            $page_header_style = get_post_meta($posts[0]->ID, "header_style", true);
        } else {
            $page_header_style = ajzaa_get_option('ajzaa_header_style', '1');
        }
    }

if($page_header_style == ''){
	$page_header_style = 1;
}


if(is_search() || is_archive()){
	get_template_part('parts/header/header', ajzaa_get_option( 'ajzaa_header_style', '1' ));
}elseif($page_header_style != "default" && $page_header_style != "none"){
	get_template_part('parts/header/header', $page_header_style);
}elseif( ajzaa_get_option( 'ajzaa_header_style', '1' ) == "none" or $page_header_style == "none" ){

}else{
	get_template_part('parts/header/header', ajzaa_get_option( 'ajzaa_header_style', '1' ));
}


