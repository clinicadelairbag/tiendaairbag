<?php 

/*============================= Row =====================================*/

vc_add_param("vc_row",
	array(
		'type' => 'colorpicker',
		'heading' => esc_html__( 'Text Color', 'ajzaa' ),
		'param_name' => 'font_color',
		'description' => esc_html__( 'Select font color', 'ajzaa' ),
	)
);
vc_add_param("vc_row", array(
  "type" => "checkbox",
  "class" => "",
  "heading" => "Parallax",
  "param_name" => "parallax",
  "value" => array("Use background as parallax ?" => "yes" )
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Parallax Speed",
	"param_name" => "speed",
	'dependency' => array(
		'element' => 'parallax',
		'not_empty' => true,
	),
));
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"heading" => "Delimiter Style",
	"param_name" => "ajzaa_row_delimiter_style",
	"value" => array('none' => "none",
	                 'Vertical line at the bottom center' => "vertical_line_bottom_center",
	                 'Vertical line at the bottom right' => "vertical_line_bottom_right",
	                 'Vertical line at the bottom left' => "vertical_line_bottom_left",
	                ),
	"group" => "Delimiter"
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Delimiter Height",
	"param_name" => "ajzaa_row_delimiter_height",
	"dependency" => Array("element" => "ajzaa_row_delimiter_style",
	                      "value" => array('vertical_line_bottom_center',
		                                     'vertical_line_bottom_right',
		                                     'vertical_line_bottom_left')),
	"group" => "Delimiter"
));
vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"heading" => esc_html__("Border Color", 'ajzaa'),
	"param_name" => "ajzaa_row_delimiter_color",
	"value" => "#bbb",
	"dependency" => Array("element" => "ajzaa_row_delimiter_style",
	                      "value" => array('vertical_line_bottom_center',
										                     'vertical_line_bottom_right',
										                     'vertical_line_bottom_left')),
	"group" => "Delimiter"
));


vc_add_param("vc_row", array(
  "type" => "checkbox",
  "class" => "",
  "heading" => "Equal Height Columns",
  "param_name" => "equalizer",
  "value" => array("Create equal height content on your row ?" => "yes" )
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Animation Delay (ms)",
	"param_name" => "animation_delay",
	"description"     => "Animation delay to add to this row children.",
	/*'dependency' => array(
		'element' => 'parallax',
		'not_empty' => true,
	),*/
));