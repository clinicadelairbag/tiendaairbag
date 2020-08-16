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
		 	
		 	<iframe width="100%" height="190" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/142466873&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
									
		 	<div class="ajzaa_multi_post_video_masonry_info">
			   <<?php echo esc_attr($ajzaa_blog_title_tag); ?> style="<?php echo esc_attr($ajzaa_custom_blog_title_inline_style); ?>">
					   <a href="<?php the_permalink() ?>" style="color:<?php echo $ajzaa_blog_title_color ?>;"><?php the_title() ?></a>
				   </<?php echo esc_attr($ajzaa_blog_title_tag); ?>>
			   <div>
				   <span style="<?php echo esc_attr($ajzaa_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
				   <span style="<?php echo esc_attr($ajzaa_custom_blog_tags_date_inline_style) ?>"> <?php echo get_the_date() ?>  </span>
				   <span style="<?php echo esc_attr($ajzaa_custom_blog_tags_date_inline_style) ?>"><?php the_category() ?></span>
				   <p style="<?php echo esc_attr($ajzaa_custom_blog_text_inline_style) ?>"><?php echo wp_trim_words(get_the_content(),60); ?></p>
			   </div>
			   <a href="<?php the_permalink() ?>">Continue</a>
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
	   $ajzaa_class_name .= " ajzaa_multi_post_isotop_item all ".$animation_classes;
		?>
		<li id="post-<?php the_ID(); ?>" <?php post_class($ajzaa_class_name); ?> <?php echo esc_attr($data_animated); ?>>
	   	<div class="ajzaa_multi_post_video_left">
	   		<div class="large-4 columns">
	   			
	   		</div>
	   		<div class="large-8 columns ajzaa_multi_post_video_left_info">
			   <<?php echo esc_attr($ajzaa_blog_title_tag); ?> style="<?php echo esc_attr($ajzaa_custom_blog_title_inline_style); ?>">
					   <a href="<?php the_permalink() ?>" style="color:<?php echo $ajzaa_blog_title_color ?>;"><?php the_title() ?></a>
				   </<?php echo esc_attr($ajzaa_blog_title_tag); ?>>
			  	<div>
			    <span style="<?php echo esc_attr($ajzaa_custom_blog_tags_date_inline_style) ?>"><?php echo get_the_date() ?>  </span>
			    <span>by :</span> <span style="<?php echo esc_attr($ajzaa_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
			    <span> in :</span> <span style="<?php echo esc_attr($ajzaa_custom_blog_tags_date_inline_style) ?>"><?php the_category() ?></span>
			    <?php if($ajzaa_blog_display_content == 'yes') { ?>
			    <p style="<?php echo esc_attr($ajzaa_custom_blog_text_inline_style) ?>"><?php echo wp_trim_words(get_the_content(),60); ?></p>
			    <?php } ?>
			    </div>
			   <a href="<?php the_permalink() ?>">Read More</a>
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
					
					<div class="ajzaa_multi_post_video_top_info">
					   <<?php echo esc_attr($ajzaa_blog_title_tag); ?> style="<?php echo esc_attr($ajzaa_custom_blog_title_inline_style); ?>">
					   <a href="<?php the_permalink() ?>" style="color:<?php echo $ajzaa_blog_title_color ?>;"><?php the_title() ?></a>
				   </<?php echo esc_attr($ajzaa_blog_title_tag); ?>>
					   <div>
						   <span style="<?php echo esc_attr($ajzaa_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
						   <span style="<?php echo esc_attr($ajzaa_custom_blog_tags_date_inline_style) ?>">  <?php echo get_the_date() ?>  </span>
						   <span style="<?php echo esc_attr($ajzaa_custom_blog_tags_date_inline_style) ?>"><?php the_category() ?></span>
						   <p style="<?php echo esc_attr($ajzaa_custom_blog_text_inline_style) ?>"><?php echo wp_trim_words(get_the_content(),60); ?></p>
					   </div>
					   <a href="<?php the_permalink() ?>">Continue</a>
				   </div>
				</div>
		   </li>
		<?php	
		}
		
	}
		
   
//__________________one post___________________________
}else {
?>
<div class="ajzaa_one_post_video">
	
	
	
</div>
	
	<?php
}
