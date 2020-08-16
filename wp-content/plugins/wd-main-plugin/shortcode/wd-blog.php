<?php 
if(!function_exists('ajzaa_blog')){
function ajzaa_blog($atts) {
  global $ajzaa_fonts_to_enqueue_array;
  extract( shortcode_atts( array(
    $ajzaa_custom_blog_title_inline_style = $ajzaa_custom_blog_text_inline_style = $ajzaa_custom_blog_author_inline_style = $ajzaa_custom_blog_tags_date_inline_style = "",
  	
    'ajzaa_blog_type' => 'ajzaa_multi_post',
    'ajzaa_blog_affichage_one_post' => 'ajzaa_blog_latest_post',
    'ajzaa_blog_post_list' => '',
    "ajzaa_blog_image_size" => '290x190',
    'ajzaa_blog_display_filter' => 'ajzaa_blog_show_filter',
    'ajzaa_blog_category' => '',
    
    'ajzaa_blog_item_perpage' => '3',
    'ajzaa_blog_columns' => '3',
    'ajzaa_blog_style' => 'ajzaa_grid_blog',
    'ajzaa_blog_affichage_type' => 'ajzaa_blog_image_top',
    'ajzaa_blog_display_content' => 'yes',

    'ajzaa_blog_title_tag' => 'h2',
    'ajzaa_blog_title_font_family' => '',
    'ajzaa_blog_title_font_size' => '18',
    'ajzaa_blog_title_color' => '#000',
    'ajzaa_blog_title_font_weight' => '',
    'ajzaa_blog_title_text_transform' => '',
    'ajzaa_blog_title_line_height' => '24',
    'ajzaa_blog_title_letter_spacing' => '',
    'ajzaa_blog_title_font_style' => 'normal',


    'ajzaa_blog_text_font_family' => '',
    'ajzaa_blog_text_font_size' => '',
    'ajzaa_blog_text_color' => '',
    'ajzaa_blog_text_font_weight' => '',
    'ajzaa_blog_text_text_transform' => '',
    'ajzaa_blog_text_line_height' => '',
    'ajzaa_blog_text_letter_spacing' => '',
    'ajzaa_blog_text_font_style' => '',


    'ajzaa_blog_author_font_family' => '',
    'ajzaa_blog_author_font_size' => '12',
    'ajzaa_blog_author_color' => '#000',
    'ajzaa_blog_author_font_weight' => '700',
    'ajzaa_blog_author_text_transform' => 'uppercase',
    'ajzaa_blog_author_line_height' => '10',
    'ajzaa_blog_author_letter_spacing' => '0.3',
    'ajzaa_blog_author_font_style' => 'normal',


    'ajzaa_blog_tags_date_font_family' => '',
    'ajzaa_blog_tags_date_font_size' => '13',
    'ajzaa_blog_tags_date_color' => '#666',
    'ajzaa_blog_tags_date_font_weight' => '',
    'ajzaa_blog_tags_date_text_transform' => '',
    'ajzaa_blog_tags_date_line_height' => '22',
    'ajzaa_blog_tags_date_letter_spacing' => '0.33',
    'ajzaa_blog_tags_date_font_style' => 'normal',

    'css_animation' => 'no'
  ), $atts ) );



  $ajzaa_font_family_blog_to_enqueue = "";

    if($ajzaa_blog_title_font_family != '' && $ajzaa_blog_title_font_family != 'Default') {
      $ajzaa_custom_blog_title_inline_style .= 'font-family:'.esc_attr($ajzaa_blog_title_font_family).';';
      $ajzaa_font_family_blog_to_enqueue .= esc_attr($ajzaa_blog_title_font_family) . ":";
    }
    if($ajzaa_blog_title_font_weight != '' && $ajzaa_blog_title_font_family != '') {
      $ajzaa_custom_blog_title_inline_style .= 'font-weight:'.esc_attr($ajzaa_blog_title_font_weight).';';
      $ajzaa_font_family_blog_to_enqueue .= esc_attr($ajzaa_blog_title_font_weight) . "%7C";
    }
    if($ajzaa_blog_title_font_size != '') {
      $ajzaa_custom_blog_title_inline_style .= 'font-size:'.esc_attr($ajzaa_blog_title_font_size).'px;';
    }
    if($ajzaa_blog_title_color != '') {
      $ajzaa_custom_blog_title_inline_style .= 'color:'.esc_attr($ajzaa_blog_title_color).';';
    }
    if($ajzaa_blog_title_text_transform != '') {
      $ajzaa_custom_blog_title_inline_style .= 'text-transform:'.esc_attr($ajzaa_blog_title_text_transform).';';
    }
    if($ajzaa_blog_title_line_height != '') {
      $ajzaa_custom_blog_title_inline_style .= 'line-height:'.esc_attr($ajzaa_blog_title_line_height).'px;';
    }
    if($ajzaa_blog_title_letter_spacing != '') {
      $ajzaa_custom_blog_title_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_blog_title_letter_spacing).'px;';
    }
    if($ajzaa_blog_title_font_style != '') {
      $ajzaa_custom_blog_title_inline_style .= 'font-style:'.esc_attr($ajzaa_blog_title_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_blog_to_enqueue);





    $ajzaa_font_family_blog_to_enqueue = "";

    if($ajzaa_blog_text_font_family != '' && $ajzaa_blog_text_font_family != 'Default') {
      $ajzaa_custom_blog_text_inline_style .= 'font-family:'.esc_attr($ajzaa_blog_text_font_family).';';
      $ajzaa_font_family_blog_to_enqueue .= esc_attr($ajzaa_blog_text_font_family) . ":";
    }
    if($ajzaa_blog_text_font_weight != '' && $ajzaa_blog_text_font_family != '') {
      $ajzaa_custom_blog_text_inline_style .= 'font-weight:'.esc_attr($ajzaa_blog_text_font_weight).';';
      $ajzaa_font_family_blog_to_enqueue .= esc_attr($ajzaa_blog_text_font_weight) . "%7C";
    }
    if($ajzaa_blog_text_font_size != '') {
      $ajzaa_custom_blog_text_inline_style .= 'font-size:'.esc_attr($ajzaa_blog_text_font_size).'px;';
    }
    if($ajzaa_blog_text_color != '') {
      $ajzaa_custom_blog_text_inline_style .= 'color:'.esc_attr($ajzaa_blog_text_color).';';
    }
    if($ajzaa_blog_text_text_transform != '') {
      $ajzaa_custom_blog_text_inline_style .= 'text-transform:'.esc_attr($ajzaa_blog_text_text_transform).';';
    }
    if($ajzaa_blog_text_line_height != '') {
      $ajzaa_custom_blog_text_inline_style .= 'line-height:'.esc_attr($ajzaa_blog_text_line_height).'px;';
    }
    if($ajzaa_blog_text_letter_spacing != '') {
      $ajzaa_custom_blog_text_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_blog_text_letter_spacing).'px;';
    }
    if($ajzaa_blog_text_font_style != '') {
      $ajzaa_custom_blog_text_inline_style .= 'font-style:'.esc_attr($ajzaa_blog_text_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_blog_to_enqueue);



    $ajzaa_font_family_blog_to_enqueue = "";

    if($ajzaa_blog_author_font_family != '' && $ajzaa_blog_author_font_family != 'Default') {
      $ajzaa_custom_blog_author_inline_style .= 'font-family:'.esc_attr($ajzaa_blog_author_font_family).';';
      $ajzaa_font_family_blog_to_enqueue .= esc_attr($ajzaa_blog_author_font_family) . ":";
    }
    if($ajzaa_blog_author_font_weight != '' && $ajzaa_blog_author_font_family != '') {
      $ajzaa_custom_blog_author_inline_style .= 'font-weight:'.esc_attr($ajzaa_blog_author_font_weight).';';
      $ajzaa_font_family_blog_to_enqueue .= esc_attr($ajzaa_blog_author_font_weight) . "%7C";
    }
    if($ajzaa_blog_author_font_size != '') {
      $ajzaa_custom_blog_author_inline_style .= 'font-size:'.esc_attr($ajzaa_blog_author_font_size).'px;';
    }
    if($ajzaa_blog_author_color != '') {
      $ajzaa_custom_blog_author_inline_style .= 'color:'.esc_attr($ajzaa_blog_author_color).';';
    }
    if($ajzaa_blog_author_text_transform != '') {
      $ajzaa_custom_blog_author_inline_style .= 'text-transform:'.esc_attr($ajzaa_blog_author_text_transform).';';
    }
    if($ajzaa_blog_author_line_height != '') {
      $ajzaa_custom_blog_author_inline_style .= 'line-height:'.esc_attr($ajzaa_blog_author_line_height).'px;';
    }
    if($ajzaa_blog_author_letter_spacing != '') {
      $ajzaa_custom_blog_author_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_blog_author_letter_spacing).'px;';
    }
    if($ajzaa_blog_author_font_style != '') {
      $ajzaa_custom_blog_author_inline_style .= 'font-style:'.esc_attr($ajzaa_blog_author_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_blog_to_enqueue);




	$ajzaa_custom_blog_name_inline_style = '';
    $ajzaa_font_family_blog_to_enqueue = "";
    
    if($ajzaa_blog_tags_date_font_family != '' && $ajzaa_blog_tags_date_font_family != 'Default') {
      $ajzaa_custom_blog_tags_date_inline_style .= 'font-family:'.esc_attr($ajzaa_blog_tags_date_font_family).';';
      $ajzaa_font_family_blog_to_enqueue .= esc_attr($ajzaa_blog_tags_date_font_family) . ":";
    }
    if($ajzaa_blog_tags_date_font_weight != '' && $ajzaa_blog_tags_date_font_family != '') {
      $ajzaa_custom_blog_tags_date_inline_style .= 'font-weight:'.esc_attr($ajzaa_blog_tags_date_font_weight).';';
      $ajzaa_font_family_blog_to_enqueue .= esc_attr($ajzaa_blog_tags_date_font_weight) . "%7C";
    }
    if($ajzaa_blog_tags_date_font_size != '') {
      $ajzaa_custom_blog_tags_date_inline_style .= 'font-size:'.esc_attr($ajzaa_blog_tags_date_font_size).'px;';
    }
    if($ajzaa_blog_tags_date_color != '') {
      $ajzaa_custom_blog_tags_date_inline_style .= 'color:'.esc_attr($ajzaa_blog_tags_date_color).';';
    }
    if($ajzaa_blog_tags_date_text_transform != '') {
      $ajzaa_custom_blog_tags_date_inline_style .= 'text-transform:'.esc_attr($ajzaa_blog_tags_date_text_transform).';';
    }
    if($ajzaa_blog_tags_date_line_height != '') {
      $ajzaa_custom_blog_tags_date_inline_style .= 'line-height:'.esc_attr($ajzaa_blog_tags_date_line_height).'px;';
    }
    if($ajzaa_blog_tags_date_letter_spacing != '') {
      $ajzaa_custom_blog_tags_date_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_blog_tags_date_letter_spacing).'px;';
    }
    if($ajzaa_blog_tags_date_font_style != '') {
      $ajzaa_custom_blog_tags_date_inline_style .= 'font-style:'.esc_attr($ajzaa_blog_tags_date_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_blog_to_enqueue);


    
  ob_start();
  $animation_classes =  "";
      $data_animated = "";
  if(($css_animation != 'no')){
      $animation_classes =  " animated ";
      $data_animated = "data-animated=$css_animation";
}
  $sap = str_replace(array('X','x'),'X',$ajzaa_blog_image_size);
  $ajzaa_image_size_ = explode( 'X', $sap) ;
  if(isset($ajzaa_image_size_[0])){
  	$ajzaa_image_size_w = $ajzaa_image_size_[0];
  }
  if(isset($ajzaa_image_size_[1])){
  	$ajzaa_image_size_h = $ajzaa_image_size_[1];
  }else{
  	$ajzaa_image_size_h = '';
  }
  

?>
<div class="blog-container">
  <?php 
  if($ajzaa_blog_type  == 'ajzaa_one_post')  {
    include( plugin_dir_path( __FILE__ ).'blog/one-post.php' )?>
  <?php }elseif($ajzaa_blog_type  == 'ajzaa_free_style') {
    include( plugin_dir_path( __FILE__ ).'blog/freestyle.php' );
  }else{      
     include( plugin_dir_path( __FILE__ ). 'blog/multi-post.php' );
    ?>
  <?php } ?>
</div>
	


  <?php return ob_get_clean();
  }
add_shortcode( 'ajzaa_blog', 'ajzaa_blog' ); }  ?>