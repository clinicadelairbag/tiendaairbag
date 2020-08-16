<?php

/*============================= Video =====================================*/
if(function_exists('vc_remove_param')) {
  vc_remove_param('vc_video','title');
  vc_remove_param('vc_video','link');
  vc_remove_param('vc_tour','title');
  vc_remove_param('vc_single_image','onclick');
}

vc_add_param('vc_video',array(
    'type' => 'dropdown',
    'class' => '',
    'heading' => esc_html__('Video mode...', 'ajzaa'),
    'param_name' => 'video_module_mode',
    'value' => array(
      esc_html__('Simple video', 'ajzaa') => 'simple',
      esc_html__('Full screen video', 'ajzaa') => 'full_screen'
    ),
  )
);
vc_add_param('vc_video',array(
    'type' => 'textfield',
    'heading' => esc_html__( 'Video link', 'ajzaa' ),
    'param_name' => 'link',
    'admin_label' => true,
    'description' => sprintf( esc_html__( 'Link to the video. More about supported formats at %s.', 'ajzaa' ), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>' ),
    'dependency' => array('element' => 'video_module_mode','value' => array('simple')),
  )
);
vc_add_param('vc_video',array(
    'type' => 'attach_image',
    'class' => '',
    'heading' => esc_html__('Thumbnail Image', 'ajzaa'),
    'param_name' => 'video_thumb_image',
    'value' => '',
    'description' => esc_html__('Upload or select video thumbnail image from media gallery.', 'ajzaa'),
  )
);
vc_add_param('vc_video',array(
    'type' => 'textfield',
    'class' => '',
    'heading' => esc_html__('Thumbnail Image resize', 'ajzaa'),
    'param_name' => 'video_thumb_image_size',
    'value' => '800x530',
    'description' => esc_html__('select video thumbnail image size.', 'ajzaa'),
  )
);
vc_add_param('vc_video',array(
    'type' => 'dropdown',
    'class' => '',
    'heading' => esc_html__('Video source', 'ajzaa'),
    'param_name' => 'video_source',
    'value' => array(
      esc_html__('Youtube', 'ajzaa') => 'youtube',
      esc_html__('Vimeo', 'ajzaa') => 'vimeo'
    ),
    //'description' => esc_html__('Upload or select video thumbnail image from media gallery.', 'ajzaa'),
    'dependency' => array('element' => 'video_module_mode','value' => array('full_screen')),
  )
);
vc_add_param('vc_video',array(
    'type' => 'textfield',
    'heading' => esc_html__( 'Video ID', 'ajzaa' ),
    'param_name' => 'video_id',
    'admin_label' => true,
    //'description' => esc_html__( '', 'ajzaa' ),
    'dependency' => array('element' => 'video_module_mode','value' => array('full_screen')),
  )
);
vc_add_param('vc_video',array(
    'type' => 'dropdown',
    'class' => '',
    'heading' => esc_html__('Label Alignment','ajzaa'),
    'param_name' => 'module_alignment',
    "value" => array(
      esc_html__('Left','ajzaa') => "text-left",
      esc_html__('Center','ajzaa') => "text-center",
      esc_html__('Right','ajzaa') => "text-right"
    ),
    'dependency' => array('element' => 'video_module_mode','value' => array('full_screen')),
  )
);
vc_add_param('vc_video',array(
    'type' => 'dropdown',
    'class' => '',
    'heading' => esc_html__('Modal Size (width)','ajzaa'),
    'param_name' => 'modal_size',
    "value" => array(
      esc_html__('Medium (60%)','ajzaa') => "medium",
      esc_html__('Small (40%)','ajzaa') => "small",
      esc_html__('Tiny (30%)','ajzaa') => "tiny",
      esc_html__('Large (70%)','ajzaa') => "large",
      esc_html__('XLarge (95%)','ajzaa') => "xlarge",
      esc_html__('Full (100%)','ajzaa') => "full"
    ),
    'dependency' => array('element' => 'video_module_mode','value' => array('full_screen')),
  )
);
vc_add_param('vc_video',array(
    'type' => 'colorpicker',
    'class' => '',
    'heading' => esc_html__('Icon color', 'ajzaa'),
    'param_name' => 'icon_color',
    'value' => '#ffffff',
    'dependency' => array('element' => 'video_module_mode','value' => array('full_screen')),
  )
);
vc_add_param('vc_video',array(
    'type' => 'colorpicker',
    'class' => '',
    'heading' => esc_html__('Label background', 'ajzaa'),
    'param_name' => 'label_background',
    'value' => 'rgba(0,0,0,0.0)',
    'dependency' => array('element' => 'video_module_mode','value' => array('full_screen')),
  )
);