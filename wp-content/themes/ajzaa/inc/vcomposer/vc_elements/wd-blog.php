<?php
global $vc_add_css_animation;
global $ajzaa_fonts_array;
$ajzaa_posts = get_posts(array('post_type' => 'post','posts_per_page'   => '99999',));
$ajzaa_posts_array = array();
foreach ( $ajzaa_posts as $key => $post ) {
	$ajzaa_posts_array[$post->post_title] = $post->ID;
}
$ajzaa_terms = get_terms( array('category'), array('hide_empty' => FALSE) );
$ajzaa_cat_array = array('all');
foreach ($ajzaa_terms as $key => $term) {
	$ajzaa_cat_array[]=$term->name;
}

vc_map( array(
	"name" => esc_html__("Recent From Blog", 'ajzaa'),
	"base" => "ajzaa_blog",
	"icon" => get_template_directory_uri()."/images/icon/meknes.png",
	"content_element" => true,
	"is_container" => FALSE,
	"category" => 'Webdevia Shortcodes',
	"params" => array(
	
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Blog type", 'ajzaa'),
			"param_name" => "ajzaa_blog_type",
			"value" => array(
					'Latest Posts'=>'ajzaa_multi_post',
					'One Post'=>'ajzaa_one_post',
					'Free Style'=>'ajzaa_free_style'
					
					),
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Image Size", 'ajzaa'),
			"param_name" => "ajzaa_blog_image_size",
			"value" => '',
			"description" =>'Enter image size  Alternatively enter size in pixels (Example: 200x100 (Width x Height) or 200 (Width)).'
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Chose One Post", 'ajzaa'),
			"param_name" => "ajzaa_blog_affichage_one_post",
			"value" => array(
					'Show Latest Post'=>'ajzaa_blog_latest_post',
					'chose frome List'=>'ajzaa_blog_Post_from_list'
					),
					"dependency" => Array("element" => "ajzaa_blog_type", "value" => array('ajzaa_one_post')),
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Blog Post List", 'ajzaa'),
			"param_name" => "ajzaa_blog_post_list",
			"value" => $ajzaa_posts_array,
			"dependency" => Array("element" => "ajzaa_blog_type", "value" => array('ajzaa_one_post')),
			"dependency" => Array("element" => "ajzaa_blog_affichage_one_post", "value" => array('ajzaa_blog_Post_from_list')),
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Show / Hide Filter Categories", 'ajzaa'),
			"param_name" => "ajzaa_blog_display_filter",
			"std" => "yes",
			'value' => array( 
					'Hide Filter'=>'ajzaa_blog_hide_filter' ),
					'Show Filter'=>'ajzaa_blog_show_filter',
			"dependency" => Array("element" => "ajzaa_blog_type", "value" => array('ajzaa_multi_post')),
			
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Blog Category", 'ajzaa'),
			"param_name" => "ajzaa_blog_category",
			"value" => $ajzaa_cat_array,
			"dependency" => Array("element" => "ajzaa_blog_type", "value" => array('ajzaa_multi_post')),
			"dependency" => Array("element" => "ajzaa_blog_display_filter", "value" => array('ajzaa_blog_hide_filter')),
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Item perpage", 'ajzaa'),
			"param_name" => "ajzaa_blog_item_perpage",
			"value" => '',
			"dependency" => Array("element" => "ajzaa_blog_type", "value" => array('ajzaa_multi_post')),
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Columns", 'ajzaa'),
			"param_name" => "ajzaa_blog_columns",
			"value" => array('1','2','3','4','5','6','7'),
			"dependency" => Array("element" => "ajzaa_blog_type", "value" => array('ajzaa_multi_post')),
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Blog Style", 'ajzaa'),
			"param_name" => "ajzaa_blog_style",
			"value" => array(
					'Grid'=>'ajzaa_grid_blog',
					'Massonry'=>'ajzaa_masonry_blog'
					
					),
					"dependency" => Array("element" => "ajzaa_blog_type", "value" => array('ajzaa_multi_post')),
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Display Style", 'ajzaa'),
			"param_name" => "ajzaa_blog_affichage_type",
			"value" => array(
					'Image Post in Top'=>'ajzaa_blog_image_top',
					'Image Post in Left'=>'ajzaa_blog_image_left',

					),
					"dependency" => Array("element" => "ajzaa_blog_type", "value" => array('ajzaa_multi_post')),
					"dependency" => Array("element" => "ajzaa_blog_style", "value" => array('ajzaa_grid_blog')),
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Display Content", 'ajzaa'),
			"param_name" => "ajzaa_blog_display_content",
			"std" => "yes",
			'value' => array( esc_html__( 'Yes, Please', 'ajzaa' ) => 'yes' ),
			"dependency" => Array("element" => "ajzaa_blog_affichage_type", "value" => array('ajzaa_blog_image_left','ajzaa_multi_post')),
		),


		// ________Blog Title Typo
        array(
             "heading" => esc_html__("Blog Title Tag", 'ajzaa'),
             "type" => "dropdown",
             "param_name" => "ajzaa_blog_title_tag",
             "value" => array('H6 (Default)' => 'h6',
                                                'H1' => 'h1',
                                                'H2' => 'h2',
                                                'H3' => 'h3',
                                                'H4' => 'h4',
                                                'H5' => 'h5',
                                                'P' => 'p',
                                                'Span' => 'span',
                                                ),
             "group" => "Title Style",
          ),
        array(
             "type" => "dropdown",
             'value' => $ajzaa_fonts_array,
             "heading" => esc_html__("Font Family", 'ajzaa'),
             "param_name" => "ajzaa_blog_title_font_family",
             "group" => "Title Style",
        ),
        array(
             "type" => "textfield",
             "class" => "",
             "heading" => esc_html__("Font Size", 'ajzaa'),
             "param_name" => "ajzaa_blog_title_font_size",
             "min" => 14,
             "suffix" => "px",
             "group" => "Title Style",
        ),
        array(
             "type" => "colorpicker",
             "class" => "",
             "heading" => esc_html__("Font Color", 'ajzaa'),
             "param_name" => "ajzaa_blog_title_color",
             "value" => "",
             "group" => "Title Style",
        ),
        array(
             "type" => "dropdown",
             "heading"           =>   esc_html__("Font Weight", 'ajzaa'),
             "param_name"   =>   "ajzaa_blog_title_font_weight",
             'value' => array(
                  esc_html__('Default', 'ajzaa') =>   '900',
                  '100'     =>   '100',
                  '200'     =>   '200',
                  '300'     =>   '300',
                  '500'     =>   '500',
                  '600'     =>   '600',
                  '700'     =>   '700',
                  '800'     =>   '800',
                  '400'     =>   '400',
             ),
             "group" => "Title Style",
        ),
        array(
             "type" => "dropdown",
             "heading" => esc_html__("Text Transform", 'ajzaa'),
             "param_name" => "ajzaa_blog_title_text_transform",
             'value' => array(
                  esc_html__('Default', 'ajzaa') =>   'none',
                  'Lowercase'    =>   'lowercase',
                  'Uppercase'    =>   'uppercase',
                  'Capitalize'   =>   'capitalize',
                  'Inherit' =>   'inherit',
             ),
             "group" => "Title Style",
        ),
        array(
             "type" => "textfield",
             "class" => "",
             "heading" => esc_html__("Line Height", 'ajzaa'),
             "param_name" => "ajzaa_blog_title_line_height",
             "value" => "",
             "suffix" => "px",
             "group" => "Title Style",
        ),
        array(
             "type" => "textfield",
             "class" => "",
             "heading" => esc_html__("Letter spacing", 'ajzaa'),
             "param_name" => "ajzaa_blog_title_letter_spacing",
             "value" => "",
             "suffix" => "px",
             "group" => "Title Style",
        ),
        array(
             "type" => "dropdown",
             "heading"           =>   esc_html__("Font Style", 'ajzaa'),
             "param_name"   =>   "ajzaa_blog_title_font_style",
             'value' => array(
                  esc_html__('Normal', 'ajzaa')  =>   'normal',
                  esc_html__('Italic','ajzaa')        =>   'italic',
                  esc_html__('Inherit','ajzaa')       =>   'inherit',
                  esc_html__('Initial','ajzaa')       =>   'initial',
             ),
             "group" => "Title Style",
        ),

        // ________Blog Text Typo
        array(
             "type" => "dropdown",
             'value' => $ajzaa_fonts_array,
             "heading" => esc_html__("Font Family", 'ajzaa'),
             "param_name" => "ajzaa_blog_text_font_family",
             "group" => "Text Style",
        ),
        array(
             "type" => "textfield",
             "class" => "",
             "heading" => esc_html__("Font Size", 'ajzaa'),
             "param_name" => "ajzaa_blog_text_font_size",
             "min" => 14,
             "suffix" => "px",
             "group" => "Text Style",
        ),
        array(
             "type" => "colorpicker",
             "class" => "",
             "heading" => esc_html__("Font Color", 'ajzaa'),
             "param_name" => "ajzaa_blog_text_color",
             "value" => "",
             "group" => "Text Style",
        ),
        array(
             "type" => "dropdown",
             "heading"           =>   esc_html__("Font Weight", 'ajzaa'),
             "param_name"   =>   "ajzaa_blog_text_font_weight",
             'value' => array(
                  esc_html__('Default', 'ajzaa') =>   '400',
                  '100'     =>   '100',
                  '200'     =>   '200',
                  '300'     =>   '300',
                  '500'     =>   '500',
                  '600'     =>   '600',
                  '700'     =>   '700',
                  '800'     =>   '800',
                  '900'     =>   '900',
             ),
             "group" => "Text Style",
        ),
        array(
             "type" => "dropdown",
             "heading" => esc_html__("Text Transform", 'ajzaa'),
             "param_name" => "ajzaa_blog_text_text_transform",
             'value' => array(
                  esc_html__('Default', 'ajzaa') =>   'none',
                  'Lowercase'    =>   'lowercase',
                  'Uppercase'    =>   'uppercase',
                  'Capitalize'   =>   'capitalize',
                  'Inherit' =>   'inherit',
             ),
             "group" => "Text Style",
        ),
        array(
             "type" => "textfield",
             "class" => "",
             "heading" => esc_html__("Line Height", 'ajzaa'),
             "param_name" => "ajzaa_blog_text_line_height",
             "value" => "",
             "suffix" => "px",
             "group" => "Text Style",
        ),
        array(
             "type" => "textfield",
             "class" => "",
             "heading" => esc_html__("Letter spacing", 'ajzaa'),
             "param_name" => "ajzaa_blog_text_letter_spacing",
             "value" => "",
             "suffix" => "px",
             "group" => "Text Style",
        ),
        array(
             "type" => "dropdown",
             "heading"           =>   esc_html__("Font Style", 'ajzaa'),
             "param_name"   =>   "ajzaa_blog_text_font_style",
             'value' => array(
                  esc_html__('Normal', 'ajzaa')  =>   'normal',
                  esc_html__('Italic','ajzaa')        =>   'italic',
                  esc_html__('Inherit','ajzaa')       =>   'inherit',
                  esc_html__('Initial','ajzaa')       =>   'initial',
             ),
             "group" => "Text Style",
        ),


        // ________Blog Author Typo
        array(
             "type" => "dropdown",
             'value' => $ajzaa_fonts_array,
             "heading" => esc_html__("Font Family", 'ajzaa'),
             "param_name" => "ajzaa_blog_author_font_family",
             "group" => "Text Author",
        ),
        array(
             "type" => "textfield",
             "class" => "",
             "heading" => esc_html__("Font Size", 'ajzaa'),
             "param_name" => "ajzaa_blog_author_font_size",
             "min" => 14,
             "suffix" => "px",
             "group" => "Text Author",
        ),
        array(
             "type" => "colorpicker",
             "class" => "",
             "heading" => esc_html__("Font Color", 'ajzaa'),
             "param_name" => "ajzaa_blog_author_color",
             "value" => "",
             "group" => "Text Author",
        ),
        array(
             "type" => "dropdown",
             "heading"           =>   esc_html__("Font Weight", 'ajzaa'),
             "param_name"   =>   "ajzaa_blog_author_font_weight",
             'value' => array(
                  esc_html__('Default', 'ajzaa') =>   '900',
                  '100'     =>   '100',
                  '200'     =>   '200',
                  '300'     =>   '300',
                  '500'     =>   '500',
                  '600'     =>   '600',
                  '700'     =>   '700',
                  '800'     =>   '800',
                  '400'     =>   '400',
             ),
             "group" => "Text Author",
        ),
        array(
             "type" => "dropdown",
             "heading" => esc_html__("Text Transform", 'ajzaa'),
             "param_name" => "ajzaa_blog_author_text_transform",
             'value' => array(
                  esc_html__('Default', 'ajzaa') =>   'none',
                  'Lowercase'    =>   'lowercase',
                  'Uppercase'    =>   'uppercase',
                  'Capitalize'   =>   'capitalize',
                  'Inherit' =>   'inherit',
             ),
             "group" => "Text Author",
        ),
        array(
             "type" => "textfield",
             "class" => "",
             "heading" => esc_html__("Line Height", 'ajzaa'),
             "param_name" => "ajzaa_blog_author_line_height",
             "value" => "",
             "suffix" => "px",
             "group" => "Text Author",
        ),
        array(
             "type" => "textfield",
             "class" => "",
             "heading" => esc_html__("Letter spacing", 'ajzaa'),
             "param_name" => "ajzaa_blog_author_letter_spacing",
             "value" => "",
             "suffix" => "px",
             "group" => "Text Author",
        ),
        array(
             "type" => "dropdown",
             "heading"           =>   esc_html__("Font Style", 'ajzaa'),
             "param_name"   =>   "ajzaa_blog_author_font_style",
             'value' => array(
                  esc_html__('Normal', 'ajzaa')  =>   'normal',
                  esc_html__('Italic','ajzaa')        =>   'italic',
                  esc_html__('Inherit','ajzaa')       =>   'inherit',
                  esc_html__('Initial','ajzaa')       =>   'initial',
             ),
             "group" => "Text Author",
        ),

        // ________Blog Author Typo
        array(
             "type" => "dropdown",
             'value' => $ajzaa_fonts_array,
             "heading" => esc_html__("Blog Tags And Post Date Font Family", 'ajzaa'),
             "param_name" => "ajzaa_blog_tags_date_font_family",
             "group" => "Text Author",
        ),
        array(
             "type" => "textfield",
             "class" => "",
             "heading" => esc_html__("Blog Tags And Post Date Font Size", 'ajzaa'),
             "param_name" => "ajzaa_blog_tags_date_font_size",
             "min" => 14,
             "suffix" => "px",
             "group" => "Text Author",
        ),
        array(
             "type" => "colorpicker",
             "class" => "",
             "heading" => esc_html__("Blog Tags And Post Date Font Color", 'ajzaa'),
             "param_name" => "ajzaa_blog_tags_date_color",
             "value" => "",
             "group" => "Text Author",
        ),
        array(
             "type" => "dropdown",
             "heading"           =>   esc_html__("Blog Tags And Post Date Font Weight", 'ajzaa'),
             "param_name"   =>   "ajzaa_blog_tags_date_font_weight",
             'value' => array(
                  esc_html__('Default', 'ajzaa') =>   '900',
                  '100'     =>   '100',
                  '200'     =>   '200',
                  '300'     =>   '300',
                  '500'     =>   '500',
                  '600'     =>   '600',
                  '700'     =>   '700',
                  '800'     =>   '800',
                  '400'     =>   '400',
             ),
             "group" => "Text Author",
        ),
        array(
             "type" => "dropdown",
             "heading" => esc_html__("Blog Tags And Post Date Text Transform", 'ajzaa'),
             "param_name" => "ajzaa_blog_tags_date_text_transform",
             'value' => array(
                  esc_html__('Default', 'ajzaa') =>   'none',
                  'Lowercase'    =>   'lowercase',
                  'Uppercase'    =>   'uppercase',
                  'Capitalize'   =>   'capitalize',
                  'Inherit' =>   'inherit',
             ),
             "group" => "Text Author",
        ),
        array(
             "type" => "textfield",
             "class" => "",
             "heading" => esc_html__("Blog Tags And Post Date Line Height", 'ajzaa'),
             "param_name" => "ajzaa_blog_tags_date_line_height",
             "value" => "",
             "suffix" => "px",
             "group" => "Text Author",
        ),
        array(
             "type" => "textfield",
             "class" => "",
             "heading" => esc_html__("Blog Tags And Post Date Letter spacing", 'ajzaa'),
             "param_name" => "ajzaa_blog_tags_date_letter_spacing",
             "value" => "",
             "suffix" => "px",
             "group" => "Text Author",
        ),
        array(
             "type" => "dropdown",
             "heading"           =>   esc_html__("Blog Tags And Post Date Font Style", 'ajzaa'),
             "param_name"   =>   "ajzaa_blog_tags_date_font_style",
             'value' => array(
                  esc_html__('Normal', 'ajzaa')  =>   'normal',
                  esc_html__('Italic','ajzaa')        =>   'italic',
                  esc_html__('Inherit','ajzaa')       =>   'inherit',
                  esc_html__('Initial','ajzaa')       =>   'initial',
             ),
             "group" => "Text Author",
        ),
		
		
		$vc_add_css_animation


	)
) );