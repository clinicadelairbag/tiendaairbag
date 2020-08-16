<?php
if ( !class_exists('ajzaa_CustomFields') ) {

	class ajzaa_CustomFields {
		/**
		* @var  string  $ajzaa_prefix  The prefix for storing custom fields in the postmeta table
		*/
		var $ajzaa_prefix = '';
		/**
		* @var  array  $ajzaa_postTypes  An array of public custom post types, plus the standard "post" and "page" - add the custom types you want to include here
		*/
		var $ajzaa_postTypes = array( "page", "post", "testimonials", "wd-team-member", "portfolio");
		/**
		* @var  array  $ajzaa_customFields  Defines the custom fields available
		*/
		var $ajzaa_customFields =	array(

		// ---------------------Pages---------------------
			//// Header Settings
			array(
				"name"			=> "header_style",
				"title"			=> "Header Style",
				"description"	=> "",
				"float_left" 	=> "yes",
				"clear_after" 	=> "",
				"type"			=> "selectbox",
				"values"		=> array(
					"default"		=>	"Default",
					"1"		=>	"Header 1",
					"2"		=>	"Header 2",
					"3"		=>	"Header 3",
					"4"		=>	"Header 4",
					"5"		=>	"Header 5",
					"6"		=>	"Header 6",
					"none"		=>	"None"
				),
				"scope"			=>	array("page"),
				"meta_id"			=>	"header-settings",
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "header_bg",
				"title"			=> "Transparent Header Background",
				"description"	=> "",
				"float_left" 	=> "yes",
				"clear_after" 	=> "",
				"type"			=> "selectbox",
				"values"		=> array(
					"transparent"	=>	"Transparent",
					"colored"		  =>	"Colored"
				),
				"scope"			=>	array("page"),
				"meta_id"			=>	"header-settings",
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "ajzaa_header_color",
				"title"			=> "Header Color",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after" 	=> "",
				"type"			=> "colorpicker",
				"scope"			=>	array("page"),
				"meta_id"			=>	"header-settings",
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			//// Page Settings
			array(
				"name"			=> "show_titlebar",
				"title"			=> "Show Title Bar",
				"description"	=> "",
				"float_left" 	=> "yes",
				"clear_after" 	=> "",
				"type"			=> "selectbox",
				"values"		=> array(
					"yes"		=>	"Yes",
					"no"		=>	"No"
				),
				"scope"			=>	array("page"),
				"meta_id"			=>	"page-settings",
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "ajzaa_page_sub_title",
				"title"			=> "Sub Title",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after" 	=> "",
				"type"			=> "text",
				"scope"			=>	array("page"),
				"meta_id"			=>	"page-settings",
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "ajzaa_page_titlebar_bmargin",
				"title"			=> "Titlebar Margin Bottom",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after" 	=> "",
				"type"			=> "text",
				"scope"			=>	array("page"),
				"meta_id"			=>	"page-settings",
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "ajzaa_page_title_area_bg_img",
				"title"			=> "Title area background image",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after" 	=> "",
				"type"			=> "image-title-image",
				"scope"			=>	array("page"),
				"meta_id"			=>	"page-settings",
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),

		// ---------------------Pages/>---------------------
		// ---------------------Wd Team---------------------
			array(
				"name"			=> "team_member_job_title",
				"title"			=> "Team Member Job title",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("wd-team-member"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "team_member_picture",
				"title"			=> "Picture",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after" 	=> "",
				"type"			=> "image-title-image",
				"scope"			=>	array("wd-team-member"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "team_member_about",
				"title"			=> "About Team Member",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("wd-team-member"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "team_member_skill_1",
				"title"			=> "Skill 1",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("wd-team-member"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),

			array(
				"name"			=> "team_member_skill_1_value",
				"title"			=> "Skill 1 Percentage",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("wd-team-member"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "team_member_skill_2",
				"title"			=> "Skill 2",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("wd-team-member"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),

			array(
				"name"			=> "team_member_skill_2_value",
				"title"			=> "Skill 2 Percentage",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("wd-team-member"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "team_member_skill_3",
				"title"			=> "Skill 3",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("wd-team-member"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),

			array(
				"name"			=> "team_member_skill_3_value",
				"title"			=> "Skill 3 Percentage",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("wd-team-member"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "team_member_twitter",
				"title"			=> "Twitter",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("wd-team-member"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "team_member_facebook",
				"title"			=> "Facebook",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("wd-team-member"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "team_member_dribbble",
				"title"			=> "Dribbble",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("wd-team-member"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "team_member_gplus",
				"title"			=> "Google Plus",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("wd-team-member"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "team_member_instagram",
				"title"			=> "Instagram",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("wd-team-member"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "team_member_linkedin",
				"title"			=> "LinkedIn",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("wd-team-member"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "team_member_website_link",
				"title"			=> "Website Link",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("wd-team-member"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),

			// ---------------------Wd Team/>---------------------
			// ---------------------Portfolio---------------------
			array(
				"name"			=> "portfolio_client_name",
				"title"			=> "Client Name",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("portfolio"),
				"capability"	=> "manage_options",
				"meta_id"			=>	"page-settings",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "portfolio_period",
				"title"			=> "Period",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("portfolio"),
				"capability"	=> "manage_options",
				"meta_id"			=>	"page-settings",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "portfolio_location",
				"title"			=> "Location",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("portfolio"),
				"capability"	=> "manage_options",
				"meta_id"			=>	"page-settings",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "portfolio_author",
				"title"			=> "Author",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("portfolio"),
				"capability"	=> "manage_options",
				"meta_id"			=>	"page-settings",
				"dependency" 	=> ""
			),

			array(
				"name"			=> "portfolio_type",
				"title"			=> "Portfolio Type",
				"description"	=> "",
				"float_left" 	=> "yes",
				"clear_after" 	=> "",
				"type"			=> "selectbox",
				"values"		=> array(
					"video_youtube"				=>	"Portfolio Youtube Video",
					"video_vimeo"					=>	"Portfolio Vimeo Video",
					"video_self_hosted"		=>	"Portfolio Self Hosted Video"
				),
				"scope"			=>	array("portfolio"),
				"meta_id"			=>	"video_setting",
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "portfolio_youtube_link",
				"title"			=> "Youtube Link",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("portfolio"),
				"meta_id"			=>	"video_setting",
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "portfolio_vimeo_id",
				"title"			=> "Vimeo Id",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("portfolio"),
				"meta_id"			=>	"video_setting",
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "portfolio_video_webm",
				"title"			=> "Video webm",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("portfolio"),
				"meta_id"			=>	"video_setting",
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "portfolio_video_mp4",
				"title"			=> "Video mp4",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("portfolio"),
				"meta_id"			=>	"video_setting",
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "portfolio_video_ogv",
				"title"			=> "Video ogv",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("portfolio"),
				"meta_id"			=>	"video_setting",
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "portfolio_audio",
				"title"			=> "Audio Url",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"meta_id"			=>	"sound_setting",
				"type"			=> "text",
				"scope"			=>	array("portfolio"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),


			// ---------------------Portfolio/>---------------------
			// ---------------------testimonail---------------------
			array(
				"name"			=> "testimonail_image",
				"title"			=> "Image",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after" 	=> "",
				"type"			=> "image-title-image",
				"scope"			=>	array("testimonials"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),
			array(
				"name"			=> "job_title",
				"title"			=> "Job title",
				"description"	=> "",
				"float_left" 	=> "",
				"clear_after"	=> "",
				"type"			=> "text",
				"scope"			=>	array("testimonials"),
				"capability"	=> "manage_options",
				"dependency" 	=> ""
			),

			// ---------------------testimonail/>---------------------


		);



		function __construct() {
			add_action( 'admin_menu', array( &$this, 'ajzaa_createCustomFields' ) );
			add_action( 'save_post', array( &$this, 'ajzaa_saveCustomFields' ), 1, 2 );
			// Comment this line out if you want to keep default custom fields meta box
			add_action( 'do_meta_boxes', array( &$this, 'ajzaa_removeDefaultCustomFields' ), 10, 3 );
		}
		/**
		* Remove the default Custom Fields meta box
		*/
		function ajzaa_removeDefaultCustomFields( $type, $context, $post ) {
			foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
				foreach ( $this->ajzaa_postTypes as $postType ) {
					remove_meta_box( 'postcustom', $postType, $context );
				}
			}
		}
		/**
		* Create the new Custom Fields meta box
		*/
		function ajzaa_createCustomFields() {
			if ( function_exists( 'add_meta_box' ) ) {
				foreach ( $this->ajzaa_postTypes as $postType ) {
					if($postType == "page") {
						add_meta_box( 'page-settings',    'Page Settings',   array( &$this, 'ajzaa_displayCustomFields' ), 'page', 'side', 'low' );
						add_meta_box( 'header-settings',  'Header Settings', array( &$this, 'ajzaa_displayCustomFields_header' ), 'page', 'side', 'low' );
					}
					if($postType == "wd-team-member") {
						add_meta_box( 'my-custom-fields', 'Team information', array( &$this, 'ajzaa_displayCustomFields' ), 'wd-team-member', 'advanced', 'high' );
					}
					if($postType == "testimonials") {
						add_meta_box( 'my-custom-fields', 'Testimonials image', array( &$this, 'ajzaa_displayCustomFields' ), 'testimonials', 'advanced', 'high' );
					}
					if($postType == "portfolio") {
						add_meta_box( 'custom-fields', 'portfolio information', array( &$this, 'ajzaa_displayCustomFields' ), 'portfolio', 'advanced', 'high' );
						add_meta_box( 'custom-fields-audio', 'audio portfolio format', array( &$this, 'ajzaa_sound_setting' ), 'portfolio', 'advanced', 'high' );
						add_meta_box( 'custom-fields-video', 'video portfolio format', array( &$this, 'ajzaa_video_setting' ), 'portfolio', 'advanced', 'high' );
					}
					if($postType == "post") {
					}
				}
			}
		}
		/**
		* Display the new Custom Fields meta box
		*/
		function ajzaa_displayCustomFields_header(){
			$this->ajzaa_displayCustomFields("header-settings");
		}
		function ajzaa_sound_setting(){
			$this->ajzaa_displayCustomFields("sound_setting");
		}
		function ajzaa_video_setting(){
			$this->ajzaa_displayCustomFields("video_setting");
		}

		function ajzaa_displayCustomFields($current_meta_id) {

			if(!is_string($current_meta_id)){
				$current_meta_id = "page-settings";
			}
			global $post;
			global $wdoptions_proya;
			global $fontArrays;
			?>
			<div class="form-wrap">
				<?php
				wp_nonce_field( 'my-custom-fields', 'my-custom-fields_wpnonce', false, true );
				foreach ( $this->ajzaa_customFields as $customField ) {
					// Check scope
					$scope = $customField[ 'scope' ];
					$meta_id = isset($customField[ 'meta_id' ]) ? $customField[ 'meta_id' ] : false;
					$dependency = $customField[ 'dependency' ];
					$output = false;
					foreach ( $scope as $scopeItem ) {
						switch ( $scopeItem ) {
							default: {
								if ( $post->post_type == $scopeItem && ($current_meta_id == $meta_id || $meta_id == false ) ){
									if($dependency != ""){
										foreach ( $dependency as $dependencyKey => $dependencyValue ) {
											foreach ( $dependencyValue as $dependencyVal ) {
												if(isset($wdoptions_proya[$dependencyKey]) && $wdoptions_proya[$dependencyKey] == $dependencyVal){
													$output = true;
													break;
												}
											}
										}
									}else{
										$output = true;
									}
								}else{
									break;
								}
							}
						}
						if ( $output ) break;
					}
					// Check capability
					if ( !current_user_can( $customField['capability'], $post->ID ) )
						$output = false;
					// Output if allowed
					if ( $output ) { ?>
							<?php
							switch ( $customField[ 'type' ] ) {
								case "checkbox": {
									// Checkbox
									if ( $customField[ 'float_left' ] == 'yes'){$float_left = 'float_left';} else {$float_left = '';}
									echo '<div class="form-field '. $float_left .' form-required">';
									echo '<label for="' . $this->ajzaa_prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
									echo '<input type="checkbox" name="' . $this->ajzaa_prefix . $customField['name'] . '" id="' . $this->ajzaa_prefix . $customField['name'] . '" value="yes"';
									if ( get_post_meta( $post->ID, $this->ajzaa_prefix . $customField['name'], true ) == "yes" )
										echo ' checked="checked"';
									echo '" style="width: auto;" />';
									echo '</div>';
									break;
								}

								case "selectbox": {
									// Selectbox
									if ( $customField[ 'float_left' ] == 'yes' ) {$float_left = 'float_left';} else {$float_left = '';}
									echo '<div class="form-field '. $float_left . ' form-required">';
									echo '<label for="' . $this->ajzaa_prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
									echo '<select name="' . $this->ajzaa_prefix . $customField[ 'name' ] . '" id="' . $this->ajzaa_prefix . $customField[ 'name' ] . '"> ';
									?>
										<?php foreach ($customField['values'] as $valuesKey => $valuesValue) { ?>
											<option value="<?php echo esc_attr($valuesKey); ?>" <?php if (get_post_meta( $post->ID, $this->ajzaa_prefix . $customField['name'], true ) == $valuesKey ) { ?> selected="selected" <?php } ?>><?php echo esc_attr($valuesValue); ?></option>
										<?php } ?>

									<?php
									echo '</select>';
									echo '</div>';
									break;
								}
								case "selectbox-category": {
									$categories = get_categories();
									if ( $customField[ 'float_left' ] == 'yes'){$float_left = 'float_left';} else {$float_left = '';}
									echo '<div class="form-field '. $float_left .' form-required">';
									echo '<label for="' . $this->ajzaa_prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
									echo '<select name="' . $this->ajzaa_prefix . $customField[ 'name' ] . '" id="' . $this->ajzaa_prefix . $customField[ 'name' ] . '"> ';
										echo '<option value=""></option>';
										foreach($categories as $category) :
											echo '<option value="'. $category->term_id .'"';
											if (get_post_meta( $post->ID, $this->ajzaa_prefix . $customField[ 'name' ], true ) == $category->term_id ) { echo 'selected="selected"';}
											echo '>';
											echo esc_attr($category->name);
											?>&nbsp;&nbsp;&nbsp;<?php
											echo '</option>';

										endforeach;
									echo '</select>';
									echo '</div>';
									break;
								}
								case "image-title-image": {
								wp_enqueue_media();

									?>
							    <script type="text/javascript">
							    jQuery(document).ready(function($) {

							    	jQuery('.upload_button').click(function(){
									  wp.media.editor.send.attachment = function(props, attachment){
									    jQuery('.title_image').val(attachment.url);
									  }
									  wp.media.editor.open(this);

									  return false;
									  });

							    });
							    </script>

					    <?php

									if ( $customField[ 'float_left' ] == 'yes'){$float_left = 'float_left';} else {$float_left = '';}
									echo '<div class="form-field '. $float_left .' form-required">';
									$ajzaa_page_bg_img = get_post_meta($post->ID, 'ajzaa_page_title_area_bg_img', true);
									//print $ajzaa_page_bg_img;
									echo '<label for="' . $this->ajzaa_prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
									echo '<div class="image_holder"><input type="text" id="' . $this->ajzaa_prefix . $customField[ 'name' ] .'" name="' . $this->ajzaa_prefix . $customField[ 'name' ] . '" class="title_image" value="'.htmlspecialchars( get_post_meta( $post->ID, $this->ajzaa_prefix . $customField[ 'name' ], true ) ).'" /><input class="upload_button button-primary" type="button" value="Upload file"></div>';
									echo '</div>';
									break;
								}
								case "font-family": {
									// Selectbox
									if ( $customField[ 'float_left' ] == 'yes'){$float_left = 'float_left';} else {$float_left = '';}
									echo '<div class="form-field '. $float_left .' ">';
									echo '<label for="' . $this->ajzaa_prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
									echo '<select name="' . $this->ajzaa_prefix . $customField[ 'name' ] . '" id="' . $this->ajzaa_prefix . $customField[ 'name' ] . '"> ';
									?>
										<option value="" <?php if (get_post_meta( $post->ID, $this->ajzaa_prefix . $customField[ 'name' ], true ) == "-1" ) { ?> selected="selected" <?php } ?>>Default</option>
										<?php foreach($fontArrays as $fontArray) { ?>
											<option <?php if (get_post_meta( $post->ID, $this->ajzaa_prefix . $customField[ 'name' ], true ) == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									<?php
									echo '</select>';
									echo '</div>';
									break;
								}
								case "colorpicker": {


									add_action( 'load-widgets.php', 'ajzaa_load_color_picker' );
						      wp_enqueue_style( 'wp-color-picker' );
						      wp_enqueue_script( 'wp-color-picker' );
						      //Colorpicker
									wp_enqueue_media();

							    wp_enqueue_script('wp-color-picker');
							    wp_enqueue_style( 'wp-color-picker' );

							    wp_enqueue_script('colorpick',    get_template_directory_uri() . "/js/bootstrap-colorpicker.min.js", array( 'jquery' ) );
							    wp_enqueue_style ('colorpick',    get_template_directory_uri() . "/stylesheets/bootstrap-colorpicker.min.css");

							    ?>
							    <script type="text/javascript">
							    jQuery(document).ready(function($) {

							    	$('.wd-color-picker').colorpicker(
						          {format: 'rgba'}
						        );

							    	jQuery('#ajzaa_upload_btn').click(function(){
									  wp.media.editor.send.attachment = function(props, attachment){
									    jQuery('#ajzaa_logo_filed').val(attachment.url);
									  }
									  wp.media.editor.open(this);

									  return false;
									  });

							    });
							    </script>

					    <?php


									if ( $customField[ 'float_left' ] == 'yes'){$float_left = 'float_left';} else {$float_left = '';}
									echo '<div class="form-field '. $float_left .' colorpicker_input">';
									echo '<label for="' . $this->ajzaa_prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<div class="colorSelector"><div style="background-color:'.htmlspecialchars( get_post_meta( $post->ID, $this->ajzaa_prefix . $customField[ 'name' ], true ) ) .'"></div></div>';
									echo '<input type="text" class="wd-color-picker" data-default-color="#C0392B" name="' . $this->ajzaa_prefix . $customField[ 'name' ] . '" id="' . $this->ajzaa_prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->ajzaa_prefix . $customField[ 'name' ], true ) ) . '" size="10" maxlength="10" />';
									echo '</div>';
									break;
								}
								case "textarea":
								case "wysiwyg": {
									// Text area
									if ( $customField[ 'float_left' ] == 'yes'){$float_left = 'float_left';} else {$float_left = '';}
									echo '<div class="form-field '. $float_left .' form-required">';
									echo '<label for="' . $this->ajzaa_prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<textarea name="' . $this->ajzaa_prefix . $customField[ 'name' ] . '" id="' . $this->ajzaa_prefix . $customField[ 'name' ] . '" columns="30" rows="3">' . htmlspecialchars( get_post_meta( $post->ID, $this->ajzaa_prefix . $customField[ 'name' ], true ) ) . '</textarea>';




									// WYSIWYG
									if ( $customField[ 'type' ] == "wysiwyg" ) { ?>
										<script type="text/javascript">
											jQuery( document ).ready( function() {
												jQuery( "<?php echo   $this->ajzaa_prefix . $customField[ 'name' ]; ?>" ).addClass( "mceEditor" );
												if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
													tinyMCE.execCommand( "mceAddControl", false, "<?php echo   $this->ajzaa_prefix . $customField[ 'name' ]; ?>" );
												}
											});
										</script>
									<?php }
									echo '</div>';
									break;
								}
								case "short-text-200": {
									// Plain text field
									if ( $customField[ 'float_left' ] == 'yes'){$float_left = 'float_left';} else {$float_left = '';}
									echo '<div class="form-field '. $float_left .' short_text_200">';
									echo '<label for="' . $this->ajzaa_prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<input type="text" name="' . $this->ajzaa_prefix . $customField[ 'name' ] . '" id="' . $this->ajzaa_prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->ajzaa_prefix . $customField[ 'name' ], true ) ) . '" />';
									echo '</div>';
									break;
								}
								case "hidden": {

									break;
								}
								default: {
									// Plain text field
									if ( $customField[ 'float_left' ] == 'yes'){$float_left = 'float_left';} else {$float_left = '';}
									echo '<div class="form-field '. $float_left .' form-required">';
									echo '<label for="' . $this->ajzaa_prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<input type="text" name="' . $this->ajzaa_prefix . $customField[ 'name' ] . '" id="' . $this->ajzaa_prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->ajzaa_prefix . $customField[ 'name' ], true ) ) . '" />';
									echo '</div>';
									break;
								}
							}
							?>
							<?php if ( $customField[ 'description' ] ) echo '<p>' . $customField[ 'description' ] . '</p>'; ?>
							<?php if ( $customField[ 'clear_after' ] == 'yes' ) echo '<div class="clear"></div>'; ?>

					<?php
					}
				} ?>
			</div>
			<?php
		}



		/**
		* Save the new Custom Fields values
		*/
		function ajzaa_saveCustomFields( $post_id, $post ) {
			if ( !isset( $_POST[ 'my-custom-fields_wpnonce' ] ) || !wp_verify_nonce( $_POST[ 'my-custom-fields_wpnonce' ], 'my-custom-fields' ) )
				return;
			if ( !current_user_can( 'edit_post', $post_id ) )
				return;
			if ( ! in_array( $post->post_type, $this->ajzaa_postTypes ) )
				return;
			foreach ( $this->ajzaa_customFields as $customField ) {
				if ( current_user_can( $customField['capability'], $post_id ) ) {

					if ( isset( $_POST[ $this->ajzaa_prefix . $customField['name'] ] ) && trim( $_POST[ $this->ajzaa_prefix . $customField['name'] ] !== '') ) {

						$value = $_POST[ $this->ajzaa_prefix . $customField['name'] ];
						// Auto-paragraphs for any WYSIWYG
						if ( $customField['type'] == "wysiwyg" ) $value = wpautop( $value );
						update_post_meta( $post_id, $this->ajzaa_prefix . $customField[ 'name' ], $value );
					} else {
						delete_post_meta( $post_id, $this->ajzaa_prefix . $customField[ 'name' ] );
					}
				}
			}


		}





	} // End Class

} // End if class exists statement
// Instantiate the class
if(class_exists('ajzaa_CustomFields')) {
	$ajzaa_CustomFields_var = new ajzaa_CustomFields();
}
/*--------------------meta box multi image uploade-------------------*/
if(isset($_POST['ajzaa_portfolio-image-gallery'])) {
	function ajzaa_save_meta_box_image ($post_id) {
		update_post_meta($post_id, 'ajzaa_portfolio-image-gallery', $_POST['ajzaa_portfolio-image-gallery']);
	}

	add_action('save_post', 'ajzaa_save_meta_box_image');
}
//ajax 
if(!function_exists('ajzaa_gallery_upload_get_images')) {
	function ajzaa_gallery_upload_get_images () {
		$ids = $_POST['ids'];
		$ids = explode(",", $ids);
		foreach($ids as $id):
			$image = wp_get_attachment_image_src($id, 'thumbnail', true);
			echo '<li class="wd-gallery-image-holder"><img src="' . $image[0] . '"/></li>';
		endforeach;
		exit;
	}
}
add_action('wp_ajax_ajzaa_gallery_upload_get_images', 'ajzaa_gallery_upload_get_images');
