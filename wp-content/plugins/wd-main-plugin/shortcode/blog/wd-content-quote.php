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
			<div class="ajzaa_one_post_quote">
				<div>
					<blockquote style="<?php echo esc_attr($ajzaa_custom_blog_text_inline_style) ?>"><?php the_content() ?></blockquote>
				        <div  class="ajzaa_author">
				        	<span style="<?php echo esc_attr($ajzaa_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
				        </div>     
					<i class="fa fa-quote-right"></i>
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
			<div class="ajzaa_one_post_quote">
				<div>
					<blockquote style="<?php echo esc_attr($ajzaa_custom_blog_text_inline_style) ?>"><?php the_content() ?></blockquote>
				        <div  class="ajzaa_author">
				        	<span style="<?php echo esc_attr($ajzaa_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
				        </div>     
					<i class="fa fa-quote-right"></i>
				</div>
				
			</div>
			</li>
			<?php
			
		//----------------post image top -------------------
		}else{
			//var_dump('grid image top');
			$ajzaa_class_name = ajzaa_get_post_category ();
			$ajzaa_class_name .= " ajzaa_multi_post_isotop_item all ".$animation_classes;
		?>
		<li id="post-<?php the_ID(); ?>" <?php post_class($ajzaa_class_name); ?> <?php echo esc_attr($data_animated); ?>>
				<div class="ajzaa_one_post_quote">
				<div>
					<blockquote style="<?php echo esc_attr($ajzaa_custom_blog_text_inline_style) ?>"><?php the_content() ?></blockquote>
				        <div  class="ajzaa_author">
				        	<span style="<?php echo esc_attr($ajzaa_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
				        </div>     
					<i class="fa fa-quote-right"></i>
				</div>
				
			</div>
			</li>
			<?php
			
		}
		
	}
		
   
//__________________one post___________________________
}elseif($ajzaa_blog_type == 'ajzaa_one_post') {
	
	?>
	<div class="ajzaa_one_post_quote <?php echo esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
		<div>
			<blockquote style="<?php echo esc_attr($ajzaa_custom_blog_text_inline_style) ?>"><?php the_content() ?></blockquote>
		        <div  class="ajzaa_author">
		        	<span style="<?php echo esc_attr($ajzaa_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
		        </div>     
			<i class="fa fa-quote-right"></i>
		</div>
		
	</div>
<?php 
}else{
	if($ajzaa_counter == 1) {
		?>
		<div class="large-12 columns ajzaa_freestyle_quote_position_<?php echo esc_attr($ajzaa_counter) .' '. esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
			<div class="ajzaa_one_post_quote">
				<i class="fa fa-quote-right"></i>
				<div>
					<blockquote style="<?php echo esc_attr($ajzaa_custom_blog_text_inline_style) ?>"><?php the_content() ?></blockquote>
				        <div  class="ajzaa_author">
				        	<span style="<?php echo esc_attr($ajzaa_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
				        </div>     
					
				</div>
			</div>
		</div>
	<?php
	}elseif($ajzaa_counter == 4) {
		?>
	<div class="ajzaa_freestyle_quote_position_<?php echo esc_attr($ajzaa_counter) .' '. esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
			<div class="ajzaa_one_post_quote">
				<i class="fa fa-quote-right"></i>
				<div>
					<blockquote style="<?php echo esc_attr($ajzaa_custom_blog_text_inline_style) ?>"><?php the_content() ?></blockquote>
				        <div  class="ajzaa_author">
				        	<span style="<?php echo esc_attr($ajzaa_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
				        </div>
				</div>
				
			</div>
			
		</div>
	<?php
	}else{
		?>
		<div class="large-6 columns ajzaa_freestyle_quote_position_<?php echo esc_attr($ajzaa_counter) .' '. esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
				<div class="ajzaa_one_post_quote">
					<i class="fa fa-quote-right"></i>
				<div>
					<blockquote style="<?php echo esc_attr($ajzaa_custom_blog_text_inline_style) ?>"><?php the_content() ?></blockquote>
				        <div  class="ajzaa_author">
				        	<span style="<?php echo esc_attr($ajzaa_custom_blog_author_inline_style) ?>"><?php the_author() ?></span>
				        </div>     
					
				</div>
				
			</div>
			</div>
	<?php
	}
}
 
