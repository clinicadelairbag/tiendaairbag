<?php 

if(!function_exists('ajzaa_team_shortcode')){
  function ajzaa_team_shortcode($atts) {
    global $ajzaa_fonts_to_enqueue_array;
	  $custom_team_name_inline_style = $custom_job_title_inline_style = $custom_about_inline_style = $custom_skill_name_inline_style = $custom_skill_value_inline_style = $custom_website_inline_style = $custom_social_medias_inline_style = "";
  	extract( shortcode_atts( array(
    'layout_style'     => 'slider',
    'columns_number_mobile' => '4',
    'columns_number_tablet'   => '3',
    'columns_number_desktop'   => '3',
    'picture_position' => 'image_left',
    'css_animation'    => 'no',

    // Team member name typo
    'team_member_name_tag'    => 'h2',
    'team_member_name_font_family'    => 'Montserrat',
    'team_member_name_font_size'    => '28',
    'team_member_name_color'    => '#000',
    'team_member_name_font_weight'    => '900',
    'team_member_name_text_transform'    => 'uppercase',
    'team_member_name_line_height'    => '34',
    'team_member_name_letter_spacing'    => '2',
    'team_member_name_font_style'    => 'normal',

    // Job title typo
    'job_title_tag'    => 'h4',
    'job_title_font_family'    => '',
    'job_title_font_size'    => '14',
    'job_title_color'    => '#626262',
    'job_title_font_weight'    => '400',
    'job_title_text_transform'    => 'None',
    'job_title_line_height'    => '14',
    'job_title_letter_spacing'    => '1',
    'job_title_font_style'    => 'normal',

    // About typo
    'about_font_family'    => 'open sans',
    'about_font_size'    => '14',
    'about_color'    => '#666',
    'about_font_weight'    => '400',
    'about_text_transform'    => 'None',
    'about_line_height'    => '24',
    'about_letter_spacing'    => '.35',
    'about_font_style'    => 'normal',

    // Skills Typo
    'skill_name_font_family'    => 'Montserrat',
    'skill_value_font_family'    => '',
    'skill_name_font_size'    => '14',
    'skill_value_font_size'    => '32',
    'skill_name_color'    => '#000',
    'skill_value_name_color'    => '#333',
    'skill_name_font_weight'    => '900',
    'skill_value_font_weight'    => '400',
    'skill_name_text_transform'    => 'uppercase',
    'skill_value_text_transform'    => 'None',
    'skill_name_letter_spacing'    => '1',
    'skill_value_letter_spacing'    => '1',
    'skill_name_font_style'    => 'normal',
    'skill_value_font_style'    => 'normal',

    // About typo
    'website_font_family'    => 'Montserrat',
    'website_font_size'    => '14',
    'website_color'    => '#000',
    'website_font_weight'    => '700',
    'website_text_transform'    => 'uppercase',
    'website_letter_spacing'    => '.7',
    'website_font_style'    => 'normal',

    // Carousel options
    'elements_to_show_mobile' =>'1',
    'elements_to_show_tablet' =>'4',
    'elements_to_show_desktop' =>'4',
    'elements_to_swipe' => '1',

    // Grid Options
    'static_html_item' => '',
    'static_html_item_position' => 'none',
    'static_html_item_link' => '',
    'static_html_item_bg_color' => '#111',
    'static_html_item_text_color' => '#FFF',
    // Options
    'navigation_style' => 'dotts',
    'dots_position' => 'in',
    'show_skills' => 'yes',
    'skills_layout' => 'progress_bar',
    'show_description' => 'yes',
    'show_website' => 'yes',
    'slider_layout_style' => 'name_jobtitle_biblio',

    // Social Medias Typo
    'show_social_media' => 'yes',
    'social_icons_size' => '16',
    'social_icons_color' => '#fff',



    
    
  ), $atts ) );

    $animation_classes =  "";
    $data_animated = "";
    if(($css_animation != 'no')){
      $animation_classes =  " animated ";
      $data_animated = "data-animated=$css_animation";
    }


    $ajzaa_font_family_team_member_to_enqueue = "";
    // Team member name inline style
    if($team_member_name_font_family != '') {
      $custom_team_name_inline_style .= 'font-family:'.esc_attr($team_member_name_font_family).';';
      $ajzaa_font_family_team_member_to_enqueue .= esc_attr($team_member_name_font_family) . ":";
    }
    if($team_member_name_font_weight != '' && $team_member_name_font_family != '') {
      $custom_team_name_inline_style .= 'font-weight:'.esc_attr($team_member_name_font_weight).';';
      $ajzaa_font_family_team_member_to_enqueue .= esc_attr($team_member_name_font_weight) . "%7C";
    }
    if($team_member_name_font_size != '') {
      $custom_team_name_inline_style .= 'font-size:'.esc_attr($team_member_name_font_size).'px;';
    }
    if($team_member_name_color != '') {
      $custom_team_name_inline_style .= 'color:'.esc_attr($team_member_name_color).';';
    }
    if($team_member_name_text_transform != '') {
      $custom_team_name_inline_style .= 'text-transform:'.esc_attr($team_member_name_text_transform).';';
    }
    if($team_member_name_line_height != '') {
      $custom_team_name_inline_style .= 'line-height:'.esc_attr($team_member_name_line_height).'px;';
    }
    if($team_member_name_letter_spacing != '') {
      $custom_team_name_inline_style .= 'letter-spacing:'.esc_attr($team_member_name_letter_spacing).'px;';
    }
    if($team_member_name_font_style != '') {
      $custom_team_name_inline_style .= 'font-style:'.esc_attr($team_member_name_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_team_member_to_enqueue);

    $ajzaa_font_family_team_member_to_enqueue = "";


    // Team member job title inline style
    if($job_title_font_family != '') {
      $custom_job_title_inline_style .= 'font-family:'.esc_attr($job_title_font_family).';';
      $ajzaa_font_family_team_member_to_enqueue .= esc_attr($job_title_font_family) . ":";
    }
    if($job_title_font_weight != '' && $job_title_font_family != '') {
      $custom_job_title_inline_style .= 'font-weight:'.esc_attr($job_title_font_weight).';';
      $ajzaa_font_family_team_member_to_enqueue .= esc_attr($job_title_font_weight)  . "%7C";
    }
    if($job_title_font_size != '') {
      $custom_job_title_inline_style .= 'font-size:'.esc_attr($job_title_font_size).'px;';
    }
    if($job_title_color != '') {
      $custom_job_title_inline_style .= 'color:'.esc_attr($job_title_color).';';
    }
    if($job_title_text_transform != '') {
      $custom_job_title_inline_style .= 'text-transform:'.esc_attr($job_title_text_transform).';';
    }
    if($job_title_line_height != '') {
      $custom_job_title_inline_style .= 'line-height:'.esc_attr($job_title_line_height).'px;';
    }
    if($job_title_letter_spacing != '') {
      $custom_job_title_inline_style .= 'letter-spacing:'.esc_attr($job_title_letter_spacing).'px;';
    }
    if($job_title_font_style != '') {
      $custom_job_title_inline_style .= 'font-style:'.esc_attr($job_title_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_team_member_to_enqueue);

    $ajzaa_font_family_team_member_to_enqueue = "";


    // Team member About inline style
    if($about_font_family != '') {
      $custom_about_inline_style .= 'font-family:'.esc_attr($about_font_family).';';
      $ajzaa_font_family_team_member_to_enqueue .= esc_attr($about_font_family) . ":";
    }
    if($about_font_weight != '' && $about_font_family != '') {
      $custom_about_inline_style .= 'font-weight:'.esc_attr($about_font_weight).';';
      $ajzaa_font_family_team_member_to_enqueue .= esc_attr($about_font_weight)  . "%7C";
    }
    if($about_font_size != '') {
      $custom_about_inline_style .= 'font-size:'.esc_attr($about_font_size).'px;';
    }
    if($about_color != '') {
      $custom_about_inline_style .= 'color:'.esc_attr($about_color).';';
    }
    if($about_text_transform != '') {
      $custom_about_inline_style .= 'text-transform:'.esc_attr($about_text_transform).';';
    }
    if($about_line_height != '') {
      $custom_about_inline_style .= 'line-height:'.esc_attr($about_line_height).'px;';
    }
    if($about_letter_spacing != '') {
      $custom_about_inline_style .= 'letter-spacing:'.esc_attr($about_letter_spacing).'px;';
    }
    if($about_font_style != '') {
      $custom_about_inline_style .= 'font-style:'.esc_attr($about_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_team_member_to_enqueue);

    $ajzaa_font_family_team_member_to_enqueue = "";

    // Team member Skill name inline style
    if($skill_name_font_family != '') {
      $custom_skill_name_inline_style .= 'font-family:'.esc_attr($skill_name_font_family).';';
      $ajzaa_font_family_team_member_to_enqueue .= esc_attr($skill_name_font_family) . ":";
    }
    if($skill_name_font_weight != '' && $skill_name_font_family != '') {
      $custom_skill_name_inline_style .= 'font-weight:'.esc_attr($skill_name_font_weight).';';
      $ajzaa_font_family_team_member_to_enqueue .= esc_attr($skill_name_font_weight)  . "%7C";
    }
    if($skill_name_font_size != '') {
      $custom_skill_name_inline_style .= 'font-size:'.esc_attr($skill_name_font_size).'px;';
    }
    if($skill_name_color != '') {
      $custom_skill_name_inline_style .= 'color:'.esc_attr($skill_name_color).';';
    }
    if($skill_name_text_transform != '') {
      $custom_skill_name_inline_style .= 'text-transform:'.esc_attr($skill_name_text_transform).';';
    }
    if($skill_name_letter_spacing != '') {
      $custom_skill_name_inline_style .= 'letter-spacing:'.esc_attr($skill_name_letter_spacing).'px;';
    }
    if($skill_name_font_style != '') {
      $custom_skill_name_inline_style .= 'font-style:'.esc_attr($skill_name_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_team_member_to_enqueue);

    $ajzaa_font_family_team_member_to_enqueue = "";

    // Team member Skill name inline style
    if($skill_value_font_family != '') {
      $custom_skill_value_inline_style .= 'font-family:'.esc_attr($skill_value_font_family).';';
      $ajzaa_font_family_team_member_to_enqueue .= esc_attr($skill_value_font_family) . ":";
    }
    if($skill_value_font_weight != '' && $skill_value_font_family != '') {
      $custom_skill_value_inline_style .= 'font-weight:'.esc_attr($skill_value_font_weight).';';
      $ajzaa_font_family_team_member_to_enqueue .= esc_attr($skill_value_font_weight)  . "%7C";
    }
    if($skill_value_font_size != '') {
      $custom_skill_value_inline_style .= 'font-size:'.esc_attr($skill_value_font_size).'px;';
    }
    if($skill_value_name_color != '') {
      $custom_skill_value_inline_style .= 'color:'.esc_attr($skill_value_name_color).';';
    }
    if($skill_value_text_transform != '') {
      $custom_skill_value_inline_style .= 'text-transform:'.esc_attr($skill_value_text_transform).';';
    }
    if($skill_value_letter_spacing != '') {
      $custom_skill_value_inline_style .= 'letter-spacing:'.esc_attr($skill_value_letter_spacing).'px;';
    }
    if($skill_value_font_style != '') {
      $custom_skill_value_inline_style .= 'font-style:'.esc_attr($skill_value_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_team_member_to_enqueue);

    $ajzaa_font_family_team_member_to_enqueue = "";

    // Team member Website inline style
    if($website_font_family != '') {
      $custom_website_inline_style .= 'font-family:'.esc_attr($website_font_family).';';
      $ajzaa_font_family_team_member_to_enqueue .= esc_attr($website_font_family) . ":";
    }
    if($website_font_weight != '' && $website_font_family != '') {
      $custom_website_inline_style .= 'font-weight:'.esc_attr($website_font_weight).';';
      $ajzaa_font_family_team_member_to_enqueue .= esc_attr($website_font_weight)  . "%7C";
    }
    if($website_font_size != '') {
      $custom_website_inline_style .= 'font-size:'.esc_attr($website_font_size).'px;';
    }
    if($website_color != '') {
      $custom_website_inline_style .= 'color:'.esc_attr($website_color).';';
    }
    if($website_text_transform != '') {
      $custom_website_inline_style .= 'text-transform:'.esc_attr($website_text_transform).';';
    }
    if($website_letter_spacing != '') {
      $custom_website_inline_style .= 'letter-spacing:'.esc_attr($website_letter_spacing).'px;';
    }
    if($website_font_style != '') {
      $custom_website_inline_style .= 'font-style:'.esc_attr($website_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_team_member_to_enqueue);

    // Team Member Social Media inline style
    if($social_icons_size != '') {
      $custom_social_medias_inline_style .= 'font-size:'.esc_attr($social_icons_size).';';
    }
    if($social_icons_color != '') {
      $custom_social_medias_inline_style .= 'color:'.esc_attr($social_icons_color).';';
    }



    ob_start(); ?>  
    
     <div class="team-member-container">
       <?php if ($layout_style == "slider"){ ?>
       <div class="<?php if ($show_skills != 'yes'){ echo "hide-skills"; } ?> team-member-slider <?php echo esc_attr($picture_position); ?>" data-navigation="<?php echo esc_attr($navigation_style); ?>">
           <?php if ($picture_position == "image_right"){ ?>
             <?php $loop = new WP_Query( array( 'post_type' => 'wd-team-member' ) );
              while ( $loop->have_posts() ) : $loop->the_post();  ?>
              <div class="wd-team-member-item large-12">
              <div class="large-2 column">&nbsp;</div>
                <div class="team-member-text large-4 column">

                <?php if ($slider_layout_style == "name_jobtitle_biblio") { ?>
                  <<?php echo esc_attr($team_member_name_tag); ?> class="team-member-name first" style="<?php echo esc_attr($custom_team_name_inline_style); ?>">
                   <?php the_title(); ?>
                  </<?php echo esc_attr($team_member_name_tag); ?>>

                  <div class="team-member-job-title second">
                   <?php if(get_post_meta(get_the_ID(), 'team_member_job_title', true) != '') { ?>
                      <<?php echo esc_attr($job_title_tag); ?> style="<?php echo esc_attr($custom_job_title_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_job_title', true)); ?></<?php echo esc_attr($job_title_tag); ?>>
                    <?php } ?>
                  </div>
                  <?php if ($show_description == "yes"){ ?>
                    <div class="team-member-about third">
                      <?php if(get_post_meta(get_the_ID(), 'team_member_about', true) != '') { ?>
                        <p style="<?php echo esc_attr($custom_about_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_about', true)); ?></p>
                      <?php } ?>
                    </div>
                  <?php } ?>
                  
                <?php } ?>

                <?php if ($slider_layout_style == "jobtitle_name_biblio") { ?>
                  
                  <div class="team-member-job-title first">
                   <?php if(get_post_meta(get_the_ID(), 'team_member_job_title', true) != '') { ?>
                      <<?php echo esc_attr($job_title_tag); ?> style="<?php echo esc_attr($custom_job_title_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_job_title', true)); ?></<?php echo esc_attr($job_title_tag); ?>>
                    <?php } ?>
                  </div>

                  <<?php echo esc_attr($team_member_name_tag); ?> class="team-member-name second" style="<?php echo esc_attr($custom_team_name_inline_style); ?>">
                   <?php the_title(); ?>
                  </<?php echo esc_attr($team_member_name_tag); ?>>

                  <?php if ($show_description == "yes"){ ?>
                    <div class="team-member-about third">
                      <?php if(get_post_meta(get_the_ID(), 'team_member_about', true) != '') { ?>
                        <p style="<?php echo esc_attr($custom_about_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_about', true)); ?></p>
                      <?php } ?>
                    </div>
                  <?php } ?>
                <?php } ?>

                  
                  <?php if ($show_skills == "yes"){ ?>
                    <div class="row team-member-skills collapse">
                    <?php if ($skills_layout == 'pie_chart') { ?>
                      <div class="large-4 column">
                        <div class="easyPieChart ">
                          <div class="circular-item-style-team left">
                                <div class="circular-pie-style-team easyPieChart" data-percent="<?php if(get_post_meta(get_the_ID(), 'team_member_skill_1_value', true) != '') { echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_1_value', true)); } ?>" data-color="<?php echo esc_attr($skill_value_name_color); ?>">
                                    <span class="percent" style="<?php echo esc_attr($custom_skill_value_inline_style) ?>"></span>
                                    <canvas width="100" height="100"></canvas>
                                <canvas></canvas></div>
                                <?php if(get_post_meta(get_the_ID(), 'team_member_skill_1', true) != '') { ?>
                                  <div class="skill-name" style="<?php echo esc_attr($custom_skill_name_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_1', true)); ?></div>
                                <?php } ?>
                            </div>
                        </div>
                      </div>
                      <div class="large-4 column">
                        <div class="easyPieChart ">
                          <div class="circular-item-style-team left">
                                <div class="circular-pie-style-team easyPieChart" data-percent="<?php if(get_post_meta(get_the_ID(), 'team_member_skill_2_value', true) != '') { echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_2_value', true)); } ?>" data-color="<?php echo esc_attr($skill_value_name_color); ?>">
                                    <span style="<?php echo esc_attr($custom_skill_value_inline_style) ?>" class="percent"></span>
                                    <canvas width="100" height="100"></canvas>
                                <canvas></canvas></div>
                                <?php if(get_post_meta(get_the_ID(), 'team_member_skill_2', true) != '') { ?>
                                  <div class="skill-name" style="<?php echo esc_attr($custom_skill_name_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_2', true)); ?></div>
                                <?php } ?>
                            </div>
                        </div>
                      </div>
                      <div class="large-4 column">
                        <div class="easyPieChart ">
                          <div class="circular-item-style-team left">
                                <div class="circular-pie-style-team easyPieChart" data-percent="<?php if(get_post_meta(get_the_ID(), 'team_member_skill_3_value', true) != '') { echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_3_value', true)); } ?>" data-color="<?php echo esc_attr($skill_value_name_color); ?>">
                                    <span class="percent" style="<?php echo esc_attr($custom_skill_value_inline_style) ?>"></span>
                                    <canvas width="100" height="100"></canvas>
                                <canvas></canvas></div>
                                <?php if(get_post_meta(get_the_ID(), 'team_member_skill_3', true) != '') { ?>
                                  <div class="skill-name" style="<?php echo esc_attr($custom_skill_name_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_3', true)); ?></div>
                                <?php } ?>
                            </div>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($skills_layout == 'progress_bar') { ?>
                      <div class="wd-progress-bar-container">
                          <ul class="wd-progress-bar">
                            <li>
                              <span class="label-bar text-left"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_1', true)); ?></span>
                              <span class="value right"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_1_value', true)) . '%';  ?></span>
                              <div class="progress large-12  round">
                                <span class="meter" style="width: <?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_1_value', true)) . '%'; ?>"></span>
                              </div>
                            </li>
                            <li>
                              <span class="label-bar text-left"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_2', true)); ?></span>
                              <span class="value right"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_2_value', true)) . '%';  ?></span>
                              <div class="progress large-12  round">
                                <span class="meter" style="width: <?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_2_value', true)) . '%'; ?>"></span>
                              </div>
                            </li>
                            <li>
                              <span class="label-bar text-left"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_3', true)); ?></span>
                              <span class="value right"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_3_value', true)) . '%';  ?></span>
                              <div class="progress large-12  round">
                                <span class="meter" style="width: <?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_3_value', true)) . '%'; ?>"></span>
                              </div>
                            </li>
                          </ul>
                      </div>
                      <?php } ?>
                    </div>
                  <?php } ?>
                  <?php if ($show_website =="yes") { ?>
                    <div class="website">
                        <a style="<?php echo esc_attr($custom_website_inline_style) ?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), 'team_member_website_link', true)); ?>" title="View Website">View Website</a>
                    </div>
                  <?php } ?>
                  
               </div>
             <div class="team-member-picture large-6 column">
               <?php 
                  $image_url = get_post_meta(get_the_ID(), 'team_member_picture', true);
                  $image_id = ajzaa_get_image_id($image_url);
                  print wp_get_attachment_image( $image_id, 'ajzaa_team_member_slider' );
                ?>
             </div>
              </div>
             <?php endwhile; ?>
           <?php } ?>



           <?php if ($picture_position == "image_left"){ ?>
           <?php $loop = new WP_Query( array( 'post_type' => 'wd-team-member' ) );
              while ( $loop->have_posts() ) : $loop->the_post();  ?>
              <div class="wd-team-member-item large-12 <?php if ($show_skills != 'yes'){ echo "hide-skills"; } ?>">
              <div class="team-member-picture large-6 column">
               <?php 
                  $image_url = get_post_meta(get_the_ID(), 'team_member_picture', true);
               $image_url=image_from_url_relatives($image_url);
                  $image_id = ajzaa_get_image_id($image_url);
                  print wp_get_attachment_image( $image_id, 'ajzaa_team_member_slider' );
                ?>
             </div>
                <div class="team-member-text large-4 column">

                <?php if ($slider_layout_style == "name_jobtitle_biblio") { ?>
                  <<?php echo esc_attr($team_member_name_tag); ?> class="team-member-name" style="<?php echo esc_attr($custom_team_name_inline_style); ?>">
                   <?php the_title(); ?>
                  </<?php echo esc_attr($team_member_name_tag); ?>>

                  <div class="team-member-job-title">
                   <?php if(get_post_meta(get_the_ID(), 'team_member_job_title', true) != '') { ?>
                      <<?php echo esc_attr($job_title_tag); ?> style="<?php echo esc_attr($custom_job_title_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_job_title', true)); ?></<?php echo esc_attr($job_title_tag); ?>>
                    <?php } ?>
                  </div>
                  <?php if ($show_description == "yes"){ ?>
                    <div class="team-member-about">
                      <?php if(get_post_meta(get_the_ID(), 'team_member_about', true) != '') { ?>
                        <p style="<?php echo esc_attr($custom_about_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_about', true)); ?></p>
                      <?php } ?>
                    </div>
                  <?php } ?>
                  
                <?php } ?>

                <?php if ($slider_layout_style == "jobtitle_name_biblio") { ?>
                  
                  <div class="team-member-job-title">
                   <?php if(get_post_meta(get_the_ID(), 'team_member_job_title', true) != '') { ?>
                      <<?php echo esc_attr($job_title_tag); ?> style="<?php echo esc_attr($custom_job_title_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_job_title', true)); ?></<?php echo esc_attr($job_title_tag); ?>>
                    <?php } ?>
                  </div>

                  <<?php echo esc_attr($team_member_name_tag); ?> class="team-member-name" style="<?php echo esc_attr($custom_team_name_inline_style); ?>">
                   <?php the_title(); ?>
                  </<?php echo esc_attr($team_member_name_tag); ?>>

                  <?php if ($show_description == "yes"){ ?>
                    <div class="team-member-about">
                      <?php if(get_post_meta(get_the_ID(), 'team_member_about', true) != '') { ?>
                        <p style="<?php echo esc_attr($custom_about_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_about', true)); ?></p>
                      <?php } ?>
                    </div>
                  <?php } ?>
                <?php } ?>

                  
                  <?php if ($show_skills == "yes"){ ?>
                    <div class="row team-member-skills collapse">
                    <?php if ($skills_layout == 'pie_chart') { ?>
                      <div class="large-4 column">
                        <div class="easyPieChart ">
                          <div class="circular-item-style-team left">
                                <div class="circular-pie-style-team easyPieChart" data-percent="<?php if(get_post_meta(get_the_ID(), 'team_member_skill_1_value', true) != '') { echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_1_value', true)); } ?>" data-color="<?php echo esc_attr($skill_value_name_color); ?>">
                                    <span class="percent" style="<?php echo esc_attr($custom_skill_value_inline_style) ?>"></span>
                                    <canvas width="100" height="100"></canvas>
                                <canvas></canvas></div>
                                <?php if(get_post_meta(get_the_ID(), 'team_member_skill_1', true) != '') { ?>
                                  <div class="skill-name" style="<?php echo esc_attr($custom_skill_name_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_1', true)); ?></div>
                                <?php } ?>
                            </div>
                        </div>
                      </div>
                      <div class="large-4 column">
                        <div class="easyPieChart ">
                          <div class="circular-item-style-team left">
                                <div class="circular-pie-style-team easyPieChart" data-percent="<?php if(get_post_meta(get_the_ID(), 'team_member_skill_2_value', true) != '') { echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_2_value', true)); } ?>" data-color="<?php echo esc_attr($skill_value_name_color); ?>">
                                    <span class="percent" style="<?php echo esc_attr($custom_skill_value_inline_style) ?>"></span>
                                    <canvas width="100" height="100"></canvas>
                                <canvas></canvas></div>
                                <?php if(get_post_meta(get_the_ID(), 'team_member_skill_2', true) != '') { ?>
                                  <div class="skill-name" style="<?php echo esc_attr($custom_skill_name_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_2', true)); ?></div>
                                <?php } ?>
                            </div>
                        </div>
                      </div>
                      <div class="large-4 column">
                        <div class="easyPieChart ">
                          <div class="circular-item-style-team left">
                                <div class="circular-pie-style-team easyPieChart" data-percent="<?php if(get_post_meta(get_the_ID(), 'team_member_skill_3_value', true) != '') { echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_3_value', true)); } ?>" data-color="<?php echo esc_attr($skill_value_name_color); ?>">
                                    <span class="percent" style="<?php echo esc_attr($custom_skill_value_inline_style) ?>"></span>
                                    <canvas width="100" height="100"></canvas>
                                <canvas></canvas></div>
                                <?php if(get_post_meta(get_the_ID(), 'team_member_skill_3', true) != '') { ?>
                                  <div class="skill-name" style="<?php echo esc_attr($custom_skill_name_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_3', true)); ?></div>
                                <?php } ?>
                            </div>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($skills_layout == 'progress_bar') { ?>
                      <div class="wd-progress-bar-container">
                        <ul class="wd-progress-bar">
                          <li>
                            <span class="label-bar text-left"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_1', true)); ?></span>
                            <span class="value right"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_1_value', true)) . '%';  ?></span>
                            <div class="progress large-12  round">
                              <span class="meter" style="width: <?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_1_value', true)) . '%'; ?>"></span>
                            </div>
                          </li>
                          <li>
                            <span class="label-bar text-left"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_2', true)); ?></span>
                            <span class="value right"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_2_value', true)) . '%';  ?></span>
                            <div class="progress large-12  round">
                              <span class="meter" style="width: <?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_2_value', true)) . '%'; ?>"></span>
                            </div>
                          </li>
                          <li>
                            <span class="label-bar text-left"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_3', true)); ?></span>
                            <span class="value right"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_3_value', true)) . '%';  ?></span>
                            <div class="progress large-12  round">
                              <span class="meter" style="width: <?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_skill_3_value', true)) . '%'; ?>"></span>
                            </div>
                          </li>
                        </ul>
                    </div>
                      <?php } ?>
                    </div>
                  <?php } ?>
                  <?php if ($show_website =="yes") { ?>
                  <div class="website">
                      <a style="<?php echo esc_attr($custom_website_inline_style) ?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), 'team_member_website_link', true)); ?>" title="View Website">View Website</a>
                  </div>
                  <?php } ?>
               </div>
               <div class="large-2 column">&nbsp;</div>
             
              </div>
             <?php endwhile; ?>
           <?php } ?>
           
        </div> 
       <?php }  elseif ($layout_style == "carousel") { ?>

       <div class="team-member-carousel <?php if ( $dots_position = 'out' ) echo "dot-out"; ?>" data-showmobile="<?php echo esc_attr( $elements_to_show_mobile ); ?>"
          data-showtablet="<?php echo esc_attr( $elements_to_show_tablet ); ?>" data-showdesktop="<?php echo esc_attr( $elements_to_show_desktop ); ?>"
          data-swipe="<?php echo esc_attr( $elements_to_swipe ); ?>" data-navigation="<?php echo esc_attr( $navigation_style ); ?>">
         <?php $loop = new WP_Query( array( 'post_type' => 'wd-team-member' ) );
          while ( $loop->have_posts() ) : $loop->the_post();  ?>
            <div class="team-member-carousel-item <?php echo esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
              <div class="team-member-carousel-img">
                <?php 
                  $image_url = get_post_meta(get_the_ID(), 'team_member_picture', true);
                $image_url=image_from_url_relatives($image_url);
                  $image_id = ajzaa_get_image_id($image_url);
                  print wp_get_attachment_image( $image_id, 'ajzaa_team_member_carousel' );
                ?>
              </div>
              <div class="team-member-carousel-text">
              
                <?php if ($slider_layout_style == "name_jobtitle_biblio") { ?>
                <div class="large-7 column">
                  <<?php echo esc_attr($team_member_name_tag); ?> class="team-member-name" style="<?php echo esc_attr($custom_team_name_inline_style); ?>">
                   <?php the_title(); ?>
                  </<?php echo esc_attr($team_member_name_tag); ?>>

                  <div class="team-member-job-title">
                   <?php if(get_post_meta(get_the_ID(), 'team_member_job_title', true) != '') { ?>
                      <<?php echo esc_attr($job_title_tag); ?> style="<?php echo esc_attr($custom_job_title_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_job_title', true)); ?></<?php echo esc_attr($job_title_tag); ?>>
                    <?php } ?>
                  </div>
                </div>
                  
                <?php } ?>

                <?php if ($slider_layout_style == "jobtitle_name_biblio") { ?>
                  <div class="large-7 column">
                    <div class="team-member-job-title">
                     <?php if(get_post_meta(get_the_ID(), 'team_member_job_title', true) != '') { ?>
                        <<?php echo esc_attr($job_title_tag); ?> style="<?php echo esc_attr($custom_job_title_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_job_title', true)); ?></<?php echo esc_attr($job_title_tag); ?>>
                      <?php } ?>
                    </div>

                    <<?php echo esc_attr($team_member_name_tag); ?> class="team-member-name" style="<?php echo esc_attr($custom_team_name_inline_style); ?>">
                     <?php the_title(); ?>
                    </<?php echo esc_attr($team_member_name_tag); ?>>
                  </div>
                  

                  <?php if ($show_description == "yes"){ ?>
                    <div class="team-member-about">
                      <?php if(get_post_meta(get_the_ID(), 'team_member_about', true) != '') { ?>
                        <p style="<?php echo esc_attr($custom_about_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_about', true)); ?></p>
                      <?php } ?>
                    </div>
                  <?php } ?>
                <?php } ?>
              
              
                <?php if ($show_social_media == "yes"){ ?>
                  <div class="team-member-social-medias large-5 column">
                    <ul>
                      <?php if(get_post_meta(get_the_ID(), 'team_member_twitter', true) != '') { ?>
                        <li>
                          <a style="<?php echo esc_attr($custom_social_medias_inline_style); ?>" href="<?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_twitter', true)); ?>" title="twitter"><i style="<?php echo "font-size:" . esc_attr($social_icons_size) . "px"; ?>" class="fa fa-twitter"></i></a>
                        </li>
                      <?php } ?>
                      <?php if(get_post_meta(get_the_ID(), 'team_member_facebook', true) != '') { ?>
                        <li>
                          <a style="<?php echo esc_attr($custom_social_medias_inline_style); ?>" href="<?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_facebook', true)); ?>" title="Facebook"><i style="<?php echo "font-size:" . esc_attr($social_icons_size) . "px"; ?>" class="fa fa-facebook"></i></a>
                        </li>
                      <?php } ?>
                      <?php if(get_post_meta(get_the_ID(), 'team_member_gplus', true) != '') { ?>
                        <li>
                          <a style="<?php echo esc_attr($custom_social_medias_inline_style); ?>" href="<?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_gplus', true)); ?>" title="googleplus"><i style="<?php echo "font-size:" . esc_attr($social_icons_size) . "px"; ?>" class="fa fa-google-plus"></i></a>
                        </li>
                      <?php } ?>
                      <?php if(get_post_meta(get_the_ID(), 'team_member_instagram', true) != '') { ?>
                        <li>
                          <a style="<?php echo esc_attr($custom_social_medias_inline_style); ?>" href="<?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_instagram', true)); ?>" title="instagram"><i style="<?php echo "font-size:" . esc_attr($social_icons_size) . "px"; ?>" class="fa fa-instagram"></i></a>
                        </li>
                      <?php } ?>
                      <?php if(get_post_meta(get_the_ID(), 'team_member_linkedin', true) != '') { ?>
                        <li>
                          <a style="<?php echo esc_attr($custom_social_medias_inline_style); ?>" href="<?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_linkedin', true)); ?>" title="linkedin"><i style="<?php echo "font-size:" . esc_attr($social_icons_size) . "px"; ?>" class="fa fa-linkedin"></i></a>
                        </li>
                      <?php } ?>
                      <?php if(get_post_meta(get_the_ID(), 'team_member_dribbble', true) != '') { ?>
                        <li>
                          <a style="<?php echo esc_attr($custom_social_medias_inline_style); ?>" href="<?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_dribbble', true)); ?>" title="dribbble"><i style="<?php echo "font-size:" . esc_attr($social_icons_size) . "px"; ?>" class="fa fa-dribbble"></i></a>
                        </li>
                      <?php } ?>
                    </ul>
                  </div>
                <?php } ?>
              </div>
            </div>
         <?php endwhile; ?>
       </div>
      <?php } else{ ?>
        <ul class="team-member-grid large-block-grid-<?php echo esc_attr($columns_number_desktop); ?> medium-block-grid-<?php echo esc_attr($columns_number_tablet); ?> small-block-grid-<?php echo esc_attr($columns_number_mobile); ?>">
        <?php 
        
        if ($static_html_item_position == "before"){ ?>
          <li class="team-member-grid-item static-html" style="background-color: <?php echo esc_attr($static_html_item_bg_color) . ';color:' . esc_attr($static_html_item_text_color); ?>">
          <div class="static-html-content">
            <?php if ($static_html_item_link != '') { ?>
              <a style="color: <?php echo esc_attr($static_html_item_text_color); ?>" href="<?php echo esc_url($static_html_item_link); ?>" title=""><?php echo $static_html_item; ?></a>
            <?php } else {
              echo esc_html($static_html_item);
              } ?>
          </div>
          </li>
        <?php } ?>
        <?php $loop = new WP_Query( array( 'post_type' => 'wd-team-member') );
          while ( $loop->have_posts() ) : $loop->the_post();  ?>
          <li class="team-member-grid-item">
            <div class="team-member-grid-img">
                <?php 
                  $image_url = get_post_meta(get_the_ID(), 'team_member_picture', true);
                $image_url=image_from_url_relatives($image_url);
                  $image_id = ajzaa_get_image_id($image_url);
                  print wp_get_attachment_image( $image_id, 'ajzaa_team_member_grid' );
                ?>
              </div>
              <div class="team-member-grid-text">
              
                <?php if ($slider_layout_style == "name_jobtitle_biblio") { ?>
                  <<?php echo esc_attr($team_member_name_tag); ?> class="team-member-name" style="<?php echo esc_attr($custom_team_name_inline_style); ?>">
                   <?php the_title(); ?>
                  </<?php echo esc_attr($team_member_name_tag); ?>>

                  <div class="team-member-job-title">
                   <?php if(get_post_meta(get_the_ID(), 'team_member_job_title', true) != '') { ?>
                      <<?php echo esc_attr($job_title_tag); ?> style="<?php echo esc_attr($custom_job_title_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_job_title', true)); ?></<?php echo esc_attr($job_title_tag); ?>>
                    <?php } ?>
                  </div>
                  <?php if ($show_description == "yes"){ ?>
                    <div class="team-member-about">
                      <?php if(get_post_meta(get_the_ID(), 'team_member_about', true) != '') { ?>
                        <p style="<?php echo esc_attr($custom_about_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_about', true)); ?></p>
                      <?php } ?>
                    </div>
                  <?php } ?>
                  
                <?php } ?>

                <?php if ($slider_layout_style == "jobtitle_name_biblio") { ?>
                  
                  <div class="team-member-job-title">
                   <?php if(get_post_meta(get_the_ID(), 'team_member_job_title', true) != '') { ?>
                      <<?php echo esc_attr($job_title_tag); ?> style="<?php echo esc_attr($custom_job_title_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_job_title', true)); ?></<?php echo esc_attr($job_title_tag); ?>>
                    <?php } ?>
                  </div>

                  <<?php echo esc_attr($team_member_name_tag); ?> class="team-member-name" style="<?php echo esc_attr($custom_team_name_inline_style); ?>">
                   <?php the_title(); ?>
                  </<?php echo esc_attr($team_member_name_tag); ?>>

                  <?php if ($show_description == "yes"){ ?>
                    <div class="team-member-about">
                      <?php if(get_post_meta(get_the_ID(), 'team_member_about', true) != '') { ?>
                        <p style="<?php echo esc_attr($custom_about_inline_style); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_about', true)); ?></p>
                      <?php } ?>
                    </div>
                  <?php } ?>
                <?php } ?>
              
              
                <?php if ($show_social_media == "yes"){ ?>
                  <div class="team-member-social-medias">
                    <ul>
                      <?php if(get_post_meta(get_the_ID(), 'team_member_twitter', true) != '') { ?>
                        <li>
                          <a style="<?php echo esc_attr($custom_social_medias_inline_style); ?>" href="<?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_twitter', true)); ?>" title="twitter"><i style="<?php echo "font-size:" . esc_attr($social_icons_size) . "px"; ?>" class="fa fa-twitter"></i></a>
                        </li>
                      <?php } ?>
                      <?php if(get_post_meta(get_the_ID(), 'team_member_facebook', true) != '') { ?>
                        <li>
                          <a style="<?php echo esc_attr($custom_social_medias_inline_style); ?>" href="<?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_facebook', true)); ?>" title="Facebook"><i style="<?php echo "font-size:" . esc_attr($social_icons_size) . "px"; ?>" class="fa fa-facebook"></i></a>
                        </li>
                      <?php } ?>
                      <?php if(get_post_meta(get_the_ID(), 'team_member_gplus', true) != '') { ?>
                        <li>
                          <a style="<?php echo esc_attr($custom_social_medias_inline_style); ?>" href="<?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_gplus', true)); ?>" title="googleplus"><i style="<?php echo "font-size:" . esc_attr($social_icons_size) . "px"; ?>" class="fa fa-google-plus"></i></a>
                        </li>
                      <?php } ?>
                      <?php if(get_post_meta(get_the_ID(), 'team_member_instagram', true) != '') { ?>
                        <li>
                          <a style="<?php echo esc_attr($custom_social_medias_inline_style); ?>" href="<?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_instagram', true)); ?>" title="instagram"><i style="<?php echo "font-size:" . esc_attr($social_icons_size) . "px"; ?>" class="fa fa-instagram"></i></a>
                        </li>
                      <?php } ?>
                      <?php if(get_post_meta(get_the_ID(), 'team_member_linkedin', true) != '') { ?>
                        <li>
                          <a style="<?php echo esc_attr($custom_social_medias_inline_style); ?>" href="<?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_linkedin', true)); ?>" title="linkedin"><i style="<?php echo "font-size:" . esc_attr($social_icons_size) . "px"; ?>" class="fa fa-linkedin"></i></a>
                        </li>
                      <?php } ?>
                      <?php if(get_post_meta(get_the_ID(), 'team_member_dribbble', true) != '') { ?>
                        <li>
                          <a style="<?php echo esc_attr($custom_social_medias_inline_style); ?>" href="<?php echo esc_attr(get_post_meta(get_the_ID(), 'team_member_dribbble', true)); ?>" title="dribbble"><i style="<?php echo "font-size:" . esc_attr($social_icons_size) . "px"; ?>" class="fa fa-dribbble"></i></a>
                        </li>
                      <?php } ?>
                    </ul>
                  </div>
                <?php } ?>
              </div>
          </li>
          <?php endwhile; ?>
        <?php if ($static_html_item_position == "after"){ ?>
          <li class="team-member-grid-item static-html" style="background-color: <?php echo esc_attr($static_html_item_bg_color) . ';color:' . esc_attr($static_html_item_text_color); ?>">
          <div class="static-html-content">
            <?php if ($static_html_item_link != '') { ?>
              <a style="color: <?php echo esc_attr($static_html_item_text_color); ?>" href="<?php echo esc_url($static_html_item_link); ?>" title=""><?php echo $static_html_item; ?></a>
            <?php } else {
              echo esc_html($static_html_item);
              } ?>
          </div>
          </li>
        <?php } ?>
        </ul>
      <?php } ?>
     </div>
    
   <?php  
      return ob_get_clean();
      }
  add_shortcode( 'ajzaa_team_members', 'ajzaa_team_shortcode' );
}
