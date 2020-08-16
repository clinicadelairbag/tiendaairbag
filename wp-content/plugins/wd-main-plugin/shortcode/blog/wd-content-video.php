<?php
if($ajzaa_blog_type == 'ajzaa_multi_post') {
//_____________multi post  ________________________	
	//----------- masonry Posts ---------------
	if($ajzaa_blog_style != 'ajzaa_grid_blog') {
		//var_dump('masonry');
		$ajzaa_class_name = ajzaa_get_post_category ();
		$ajzaa_class_name .= " ajzaa_multi_post_isotop_item all ".$animation_classes;
		?>
		<li id="post-<?php the_ID(); ?>" <?php post_class($ajzaa_class_name); ?> <?php echo esc_attr($data_animated); ?>>
		 <div class="ajzaa_multi_post_video_masonry">
		 	
									<?php $_video_type = get_post_meta(get_the_ID(), "video_type", true);?>
									
									<?php if($_video_type == "youtube") { ?>
										<iframe width="100%" height="<?php echo esc_attr($ajzaa_image_size_h) ?>" src="https://www.youtube.com/embed/<?php echo get_post_meta(get_the_ID(), "ajzaa_youtube_link", true);  ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
										
									<?php } else if ($_video_type == "vimeo"){ ?>
										
										<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta(get_the_ID(), "ajzaa_vimeo_id", true);  ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
									
									<?php } else if ($_video_type == "self_hosted"){ ?>
										
										
										<video
							        controls preload="auto" width="<?php echo esc_attr($ajzaa_image_size_w) ?>" height="<?php echo esc_attr($ajzaa_image_size_h) ?>" >
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_mp4", true) ?>" type='video/mp4' />
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_webm", true)?>" type='video/webm' />
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_ogv", true);  ?>" type='video/ogg' />
							       
							      </video>
										
								<?php } ?>
										
		 	<div class="ajzaa_multi_post_video_masonry_info">
			   <<?php echo esc_attr($ajzaa_blog_title_tag); ?> style="<?php echo esc_attr($ajzaa_custom_blog_title_inline_style); ?>">
					   <a href="<?php the_permalink() ?>" style="color:<?php echo $ajzaa_blog_title_color ?>;"><?php the_title() ?></a>
				   </<?php echo esc_attr($ajzaa_blog_title_tag); ?>>
			   <div>
				   <span style="<?php echo esc_attr($ajzaa_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
				   <span style="<?php echo esc_attr($ajzaa_custom_blog_tags_date_inline_style) ?>">  <?php echo get_the_date() ?>  </span>
				   <?php the_category() ?>
				   <p style="<?php echo esc_attr($ajzaa_custom_blog_text_inline_style) ?>"><?php echo wp_trim_words(get_the_content(),25); ?></p>
			   </div>
			   <div class="wd-redmore"><a href="<?php the_permalink() ?>">Continue</a><i class="ion-ios-arrow-thin-right"></i></div>
		   </div>
		 </div>
	   </li>
		<?php
	//----------- Grid Posts ---------------	
	}else{
		//----------------post image left -------------------
		if($ajzaa_blog_affichage_type == 'ajzaa_blog_image_left'){
			//var_dump('grid image left');
			$ajzaa_class_name = ajzaa_get_post_category ();
	   $ajzaa_class_name .= " ajzaa_multi_post_isotop_item wd-image-left all ".$animation_classes;
		?>
		<li id="post-<?php the_ID(); ?>" <?php post_class($ajzaa_class_name); ?> <?php echo esc_attr($data_animated); ?>>
	   
	   	<div class="ajzaa_multi_post_video_left clearfix">
	   		<div class="large-4 columns">
	   			<?php $_video_type = get_post_meta(get_the_ID(), "video_type", true);?>
									
									<?php if($_video_type == "youtube") { ?>
										
										<iframe width="100%" height="<?php echo esc_attr($ajzaa_image_size_h) ?>" src="https://www.youtube.com/embed/<?php echo get_post_meta(get_the_ID(), "ajzaa_youtube_link", true);  ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
									
									<?php } else if ($_video_type == "vimeo"){ ?>
										
										<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta(get_the_ID(), "ajzaa_vimeo_id", true);  ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
									
									<?php } else if ($_video_type == "self_hosted"){ ?>
										
										
										<video
							        controls preload="auto" width="<?php echo esc_attr($ajzaa_image_size_w) ?>" height="<?php echo esc_attr($ajzaa_image_size_h) ?>" >
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_mp4", true) ?>" type='video/mp4' />
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_webm", true)?>" type='video/webm' />
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_ogv", true);  ?>" type='video/ogg' />
							      </video>
										
								<?php } ?>
	   		</div>
	   		<div class="large-8 columns ajzaa_multi_post_video_left_info">
			   <<?php echo esc_attr($ajzaa_blog_title_tag); ?> style="<?php echo esc_attr($ajzaa_custom_blog_title_inline_style); ?>">
					   <a href="<?php the_permalink() ?>" style="color:<?php echo $ajzaa_blog_title_color ?>;"><?php the_title() ?></a>
				 </<?php echo esc_attr($ajzaa_blog_title_tag); ?>>
			  	<div>
			    <span style="<?php echo esc_attr($ajzaa_custom_blog_tags_date_inline_style) ?>">  <?php echo get_the_date() ?>  </span>
			   <span style="<?php echo esc_attr($ajzaa_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
			   <?php the_category() ?>
			    <?php if($ajzaa_blog_display_content == 'yes') { ?>
			    <p style="<?php echo esc_attr($ajzaa_custom_blog_text_inline_style) ?>"><?php echo wp_trim_words(get_the_content(),20); ?></p>
			    <?php } ?>
			    </div>
			   <div class="wd-redmore"><a href="<?php the_permalink() ?>">Read More</a><i class="ion-ios-arrow-thin-right"></i></div>
		   </div>
		</div>
	   </li>
		<?php
		//----------------post image top -------------------
		}else{
		$ajzaa_class_name = ajzaa_get_post_category ();
			$ajzaa_class_name .= " ajzaa_multi_post_isotop_item all ".$animation_classes;
		?>
		<li id="post-<?php the_ID(); ?>" <?php post_class($ajzaa_class_name); ?> <?php echo esc_attr($data_animated); ?>>
				<div class="ajzaa_multi_post_video_top">
					<?php $_video_type = get_post_meta(get_the_ID(), "video_type", true);?>
									
									<?php if($_video_type == "youtube") { ?>
										
										<iframe width="100%" height="<?php echo esc_attr($ajzaa_image_size_h) ?>" src="https://www.youtube.com/embed/<?php echo get_post_meta(get_the_ID(), "ajzaa_youtube_link", true);  ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
									
									<?php } else if ($_video_type == "vimeo"){ ?>
										
										<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta(get_the_ID(), "ajzaa_vimeo_id", true);  ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
									
									<?php } else if ($_video_type == "self_hosted"){ ?>
										
										
										<video
							        controls preload="auto" width="<?php echo esc_attr($ajzaa_image_size_w) ?>" height="<?php echo esc_attr($ajzaa_image_size_h) ?>" >
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_mp4", true) ?>" type='video/mp4' />
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_webm", true)?>" type='video/webm' />
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_ogv", true);  ?>" type='video/ogg' />
							       
							      </video>
										
								<?php } ?>
					<div class="ajzaa_multi_post_video_top_info">
					   <<?php echo esc_attr($ajzaa_blog_title_tag); ?> style="<?php echo esc_attr($ajzaa_custom_blog_title_inline_style); ?>">
					   <a href="<?php the_permalink() ?>" style="color:<?php echo $ajzaa_blog_title_color ?>;"><?php the_title() ?></a>
				   </<?php echo esc_attr($ajzaa_blog_title_tag); ?>>
					   <div>
						   <span style="<?php echo esc_attr($ajzaa_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
						   <span style="<?php echo esc_attr($ajzaa_custom_blog_tags_date_inline_style) ?>">  <?php echo get_the_date() ?>  </span>
						   <?php the_category() ?>
						   <p style="<?php echo esc_attr($ajzaa_custom_blog_text_inline_style) ?>"><?php echo wp_trim_words(get_the_content(),25); ?></p>
					   </div>
					  <div class="wd-redmore"><a  href="<?php the_permalink() ?>">Continue</a><i class="ion-ios-arrow-thin-right"></i></div> 
				   </div>
				</div>
		   </li>
		<?php	
		}
		
	}
		
   
//__________________one post___________________________
}elseif($ajzaa_blog_type == 'ajzaa_one_post') {
?>
<div class="ajzaa_one_post_video <?php echo esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
	
	
	
</div>
	
	<?php
}else{
	if($ajzaa_counter == 1) {
		?>
		<div class="large-12 columns ajzaa_freestyle_content_position_<?php echo esc_attr($ajzaa_counter) .' '. esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
			<div class="large-6 columns">
				<?php $_video_type = get_post_meta(get_the_ID(), "video_type", true);?>
									
									<?php if($_video_type == "youtube") { ?>
										
										<iframe width="100%" height="<?php echo esc_attr($ajzaa_image_size_h) ?>" src="https://www.youtube.com/embed/<?php echo get_post_meta(get_the_ID(), "ajzaa_youtube_link", true);  ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
									
									<?php } else if ($_video_type == "vimeo"){ ?>
										
										<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta(get_the_ID(), "ajzaa_vimeo_id", true);  ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
									
									<?php } else if ($_video_type == "self_hosted"){ ?>
										
										
										<video
							        controls preload="auto" width="<?php echo  $ajzaa_image_size_w ?>" height="<?php echo esc_attr($ajzaa_image_size_h) ?>" >
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_mp4", true) ?>" type='video/mp4' />
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_webm", true)?>" type='video/webm' />
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_ogv", true);  ?>" type='video/ogg' />
							       
							      </video>
										
								<?php } ?>
			</div>
			
				<div class="large-6 columns ajzaa_freestyle_content_position_<?php echo esc_attr($ajzaa_counter) ?>_info">
					<<?php echo esc_attr($ajzaa_blog_title_tag); ?> style="<?php echo esc_attr($ajzaa_custom_blog_title_inline_style); ?>">
					   <a href="<?php the_permalink() ?>" style="color:<?php echo $ajzaa_blog_title_color ?>;"><?php the_title() ?></a>
				   </<?php echo esc_attr($ajzaa_blog_title_tag); ?>>
					<div>
						<span style="<?php echo esc_attr($ajzaa_custom_blog_tags_date_inline_style) ?>">  <?php echo get_the_date() ?>  </span>
			     	<span style="<?php echo esc_attr($ajzaa_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
			     	<?php the_category() ?>
					</div>
			    	<div class="wd-redmore"><a href="<?php the_permalink() ?>">Continue</a><i class="ion-ios-arrow-thin-right"></i></div>
				</div>
			
		</div>
	<?php
	}elseif($ajzaa_counter == 4) {
		?>
	<div class="ajzaa_freestyle_content_position_<?php echo esc_attr($ajzaa_counter) .' '. esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
			<div>
				<?php $_video_type = get_post_meta(get_the_ID(), "video_type", true);?>
									
									<?php if($_video_type == "youtube") { ?>
										
										<iframe width="100%" height="<?php echo esc_attr($ajzaa_image_size_h) ?>" src="https://www.youtube.com/embed/<?php echo get_post_meta(get_the_ID(), "ajzaa_youtube_link", true);  ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
									
									<?php } else if ($_video_type == "vimeo"){ ?>
										
										<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta(get_the_ID(), "ajzaa_vimeo_id", true);  ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
									
									<?php } else if ($_video_type == "self_hosted"){ ?>
										
										
										<video
							        controls preload="auto" width="<?php echo  $ajzaa_image_size_w ?>" height="<?php echo esc_attr($ajzaa_image_size_h) ?>" >
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_mp4", true) ?>" type='video/mp4' />
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_webm", true)?>" type='video/webm' />
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_ogv", true);  ?>" type='video/ogg' />
							       
							      </video>
										
								<?php } ?>
			</div>
			
				<div class="ajzaa_freestyle_content_position_<?php echo esc_attr($ajzaa_counter) ?>_info">
					<<?php echo esc_attr($ajzaa_blog_title_tag); ?> style="<?php echo esc_attr($ajzaa_custom_blog_title_inline_style); ?>">
					   <a href="<?php the_permalink() ?>" style="color:<?php echo $ajzaa_blog_title_color ?>;"><?php the_title() ?></a>
				   </<?php echo esc_attr($ajzaa_blog_title_tag); ?>>
					<div>
						<span style="<?php echo esc_attr($ajzaa_custom_blog_tags_date_inline_style) ?>">  <?php echo get_the_date() ?>  </span>
			     	<span style="<?php echo esc_attr($ajzaa_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
			     	<?php the_category() ?>
					</div>
			    	<div class="wd-redmore"><a href="<?php the_permalink() ?>">Continue</a><i class="ion-ios-arrow-thin-right"></i></div>
				</div>
			
		</div>
	<?php
	}else{
		?>
		<div class="large-6 columns ajzaa_freestyle_content_position_<?php echo esc_attr($ajzaa_counter) .' '. $animation_classes; ?>" <?php echo esc_attr($data_animated); ?>>
				<?php $_video_type = get_post_meta(get_the_ID(), "video_type", true);?>
									
									<?php if($_video_type == "youtube") { ?>
										
										<iframe width="100%" height="<?php echo esc_attr($ajzaa_image_size_h) ?>" src="https://www.youtube.com/embed/<?php echo get_post_meta(get_the_ID(), "ajzaa_youtube_link", true);  ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
									
									<?php } else if ($_video_type == "vimeo"){ ?>
										
										<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta(get_the_ID(), "ajzaa_vimeo_id", true);  ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
									
									<?php } else if ($_video_type == "self_hosted"){ ?>
										
										
										<video
							        controls preload="auto" width="<?php echo  $ajzaa_image_size_w ?>" height="<?php echo esc_attr($ajzaa_image_size_h) ?>" >
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_mp4", true) ?>" type='video/mp4' />
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_webm", true)?>" type='video/webm' />
							       <source src="<?php echo get_post_meta(get_the_ID(), "ajzaa_video_ogv", true);  ?>" type='video/ogg' />
							       
							      </video>
										
								<?php } ?>
			</div>
	<?php
	}
	
}
