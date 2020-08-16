<?php

if (!defined( 'ABSPATH')) exit;
 
class wcqv_frontend{
	
	public $wcqv_plugin_dir_url;
    public $wcqv_options;
    public $wcqv_style;

	function __construct($wcqv_plugin_dir_url){

		$this->wcqv_plugin_dir_url = $wcqv_plugin_dir_url;
		$this->wcqv_options = get_option('wcqv_options');
  		$this->wcqv_style   = get_option('wcqv_style');

        add_action( 'wp_enqueue_scripts', array($this,'wcqv_load_assets'));
		add_action( 'woocommerce_after_shop_loop_item', array($this,'wcqv_add_button') );
		add_action( 'wp_footer', array($this, 'wcqv_remodel_model'));
		add_action( 'wp_ajax_wcqv_get_product', array($this,'wcqv_get_product') );
        add_action( 'wp_ajax_nopriv_wcqv_get_product', array($this,'wcqv_get_product') );

        add_action('wcqv_show_product_sale_flash','woocommerce_show_product_sale_flash');
        add_action('wcqv_show_product_images', array($this,'wcqv_woocommerce_show_product_images'));

        add_action( 'wcqv_product_data', 'woocommerce_template_single_title');
        add_action( 'wcqv_product_data', 'woocommerce_template_single_rating' );
        add_action( 'wcqv_product_data', 'woocommerce_template_single_price');
        add_action( 'wcqv_product_data', 'woocommerce_template_single_excerpt');
        add_action( 'wcqv_product_data', 'woocommerce_template_single_add_to_cart');
        add_action( 'wcqv_product_data', 'woocommerce_template_single_meta' );
 
	}
    



    public function wcqv_woocommerce_show_product_images(){

		global $post, $product, $woocommerce;

		?>
		<div class="images">
		<?php 

        if ( has_post_thumbnail() ) {
			$attachment_count = count( $product->get_gallery_image_ids() );
			$gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
			$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
			$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title'	 => $props['title'],
				'alt'    => $props['alt'],
			) );
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $props['url'], $props['caption'], $image ), $post->ID );
		} else {
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
		}


		$attachment_ids = $product->get_gallery_image_ids();
		if ( $attachment_ids ) :
			$loop 		= 0;
			$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
			?>
			<div class="thumbnails <?php echo 'columns-' . $columns; ?>"><?php
				foreach ( $attachment_ids as $attachment_id ) {
					$classes = array( 'thumbnail' );
					if ( $loop === 0 || $loop % $columns === 0 )
						$classes[] = 'first';
					if ( ( $loop + 1 ) % $columns === 0 )
						$classes[] = 'last';
					$image_link = wp_get_attachment_url( $attachment_id );
					if ( ! $image_link )
						continue;
					$image_title 	= esc_attr( get_the_title( $attachment_id ) );
					$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
					$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
						'title'	=> $image_title,
						'alt'	=> $image_title
						) );
					$image_class = esc_attr( implode( ' ', $classes ) );
					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" >%s</a>', $image_link, $image_class, $image_caption, $image ), $attachment_id, $post->ID, $image_class );
					$loop++;
				}
			?>
				
			</div>
		<?php endif; ?>
		</div>
		<?php
    }




	public function wcqv_load_assets(){
        
        wp_enqueue_style  ( 'wcqv_remodal_default_css',    $this->wcqv_plugin_dir_url.'css/style.css');
		wp_register_script( 'wcqv_frontend_js', $this->wcqv_plugin_dir_url.'js/frontend.js',array('jquery'),'1.0', true);
		$frontend_data = array(

		'wcqv_nonce'          => wp_create_nonce('wcqv_nonce'),
		'ajaxurl'             => admin_url( 'admin-ajax.php' ),
		'wcqv_plugin_dir_url' => $this->wcqv_plugin_dir_url
 

		);

		wp_localize_script( 'wcqv_frontend_js', 'wcqv_frontend_obj', $frontend_data );
		wp_enqueue_script ( 'jquery' );
		wp_enqueue_script ( 'wcqv_frontend_js' );
		wp_register_script( 'wcqv_remodal_js',$this->wcqv_plugin_dir_url.'js/remodal.js',array('jquery'),'1.0', true);
		wp_enqueue_script('wcqv_remodal_js');

		global $woocommerce;
 
		 
		wp_enqueue_script( 'prettyPhoto', $this->wcqv_plugin_dir_url.'js/prettyPhoto/jquery.prettyPhoto.js', array( 'jquery' ), '3.1.6', true );
		wp_enqueue_style( 'woocommerce_prettyPhoto_css', $woocommerce->plugin_url() . '/assets/css/prettyPhoto.css' );
		
		wp_enqueue_script( 'wc-add-to-cart-variation' );
		wp_enqueue_script('thickbox');

 
	    $custom_css = '
	    .remodal .remodal-close{
	    	color:'.$this->wcqv_style['close_btn'].';
	    }
	    .remodal .remodal-close:hover{
	    	background-color:'.$this->wcqv_style['close_btn_bg'].';
	    }
	    .woocommerce .remodal{
	    	background-color:'.$this->wcqv_style['modal_bg'].';
	    }
	    .wcqv_prev h4,.wcqv_next h4{
	    	color :'.$this->wcqv_style['navigation_txt'].';
	    }
	    .wcqv_prev,.wcqv_next{
	    	background :'.$this->wcqv_style['navigation_bg'].';
	    }
        .woocommerce a.quick_view{
            background-color: '.$this->wcqv_style['close_btn'].' ;
        }';
        wp_add_inline_style( 'wcqv_remodal_default_css', $custom_css );


         
	}


	public function wcqv_remodel_model(){
 
		echo '<div class="remodal" data-remodal-id="modal" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDesc">
		  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
		    <div id = "wcqv_contend"></div>
		</div>';

		 
	}


	public function wcqv_add_button(){

		global $post;
        echo '<a data-product-id="'.$post->ID.'"class="quick_view button" >
        <span>'.$this->wcqv_options['button_lable'].'</span></a>';
	}


	public function wcqv_get_product(){

		global $woocommerce;

		$suffix      = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$lightbox_en = get_option( 'woocommerce_enable_lightbox' ) == 'yes' ? true : false;

		
		global $post;
		$product_id = $_POST['product_id'];
		if(intval($product_id)){

			 wp( 'p=' . $product_id . '&post_type=product' );
 	         ob_start();
 	

		 	while ( have_posts() ) : the_post(); ?>
	 	    <script>
		 	    var url = <?php echo "'"."$this->wcqv_plugin_dir_url/js/prettyPhoto.init.js'"; ?>;
		 	    jQuery.getScript(url);
		 	    var wc_add_to_cart_variation_params = {"ajax_url":"\/wp-admin\/admin-ajax.php"};     
	            jQuery.getScript("<?php echo $woocommerce->plugin_url(); ?>/assets/js/frontend/add-to-cart-variation.min.js");
	 	    </script>
 	        <div class="product">  

 	                <div id="product-<?php the_ID(); ?>" <?php post_class('product'); ?> >  
 	                        <?php do_action('wcqv_show_product_sale_flash'); ?> 

 	                           <?php do_action( 'wcqv_show_product_images' );  ?>
                               
	 	                        <div class="summary entry-summary scrollable">
	 	                                <div class="summary-content">   
	                                       <?php

	                                        do_action( 'wcqv_product_data' );

	                                        ?>
	 	                                </div>
	 	                        </div>
	 	                         <div class="scrollbar_bg"></div>
 
 	                </div> 
 	        </div>
 	       
 	        <?php endwhile;

            	$post                  = get_post($product_id);
            	$next_post             = get_next_post();
			    $prev_post             = get_previous_post();
			    $next_post_id          = ($next_post != null)?$next_post->ID:'';
			    $prev_post_id          = ($prev_post != null)?$prev_post->ID:'';
			    $next_post_title       = ($next_post != null)?$next_post->post_title:'';
 		     	$prev_post_title       = ($prev_post != null)?$prev_post->post_title:'';
			 	$next_thumbnail        = ($next_post != null)?get_the_post_thumbnail( $next_post->ID,
			 		                  'shop_thumbnail',''):'';
 		     	$prev_thumbnail        = ($prev_post != null)?get_the_post_thumbnail( $prev_post->ID,
 		     		                   'shop_thumbnail',''):'';

 	        ?> 
            
 	        <div class ="wcqv_prev_data" data-wcqv-prev-id = "<?php echo $prev_post_id; ?>">
 	        <?php echo $prev_post_title; ?>
 	            <?php echo $prev_thumbnail; ?> 
 	        </div> 
 	        <div class ="wcqv_next_data" data-wcqv-next-id = "<?php echo $next_post_id; ?>">
 	        <?php echo $next_post_title; ?>
 	             <?php echo $next_thumbnail; ?> 
 	        </div> 

 	        <?php
 	                  
 	        echo  ob_get_clean();
 	
 	        exit();
            
			
	    }
	}
	
}

?>