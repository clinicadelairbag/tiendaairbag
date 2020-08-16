<?php
if ($ajzaa_blog_type == 'ajzaa_multi_post') {
	//_____________multi post  ________________________
	//----------- masonry Posts ---------------
	if ($ajzaa_blog_style != 'ajzaa_grid_blog') {
		$ajzaa_class_name = ajzaa_get_post_category ();
		$ajzaa_class_name .= " ajzaa_multi_post_isotop_item all " . $animation_classes;
		?>
		<li id="post-<?php the_ID (); ?>" <?php post_class ($ajzaa_class_name); ?>>
  <div class="ajzaa_multi_post_gallery_masonry">
    <ul class="ajzaa_blog_post_gallery_masonry">
      <?php $portfolio_image_gallery_val = get_post_meta (get_the_ID (), 'ajzaa_portfolio-image-gallery', true);
      if ($portfolio_image_gallery_val != '')
	      $portfolio_image_gallery_array = explode (',', $portfolio_image_gallery_val);
      if (isset($portfolio_image_gallery_array) && count ($portfolio_image_gallery_array) != 0) :
	      foreach ($portfolio_image_gallery_array as $gimg_id) :
		      $thumb = wp_get_attachment_image_src ($gimg_id, 'full');
		      if ($ajzaa_image_size_h != '') {
			      $image = ajzaa_resize ($thumb[0], $ajzaa_image_size_w, $ajzaa_image_size_h, true);
		      }
		      ?>
		      <li><img src="<?php echo $image ?>" alt="<?php echo get_the_title () ?>"/></li><?php
	      endforeach;
      endif;
      ?>
    </ul>
    <div class="ajzaa_multi_post_gallery_masonry_info">
      <h2><a href="<?php the_permalink () ?>"><?php the_title () ?></a></h2>
      <div>
        <span><?php the_author () ?></span>
        <span>  <?php echo get_the_date () ?>  </span>
	      <?php the_category () ?>
	      <p><?php echo wp_trim_words (get_the_content (), 25); ?></p>
      </div>
      <div class="wd-redmore"><a href="<?php the_permalink () ?>"><?php echo esc_html__ ("Continue", 'ajzaa') ?></a><i
		      class="ion-ios-arrow-thin-right"></i></div>
    </div>
  </div>
</li>
		<?php
		//----------- Grid Posts ---------------
	}
	else {
		//----------------post image left -------------------
		if ($ajzaa_blog_affichage_type == 'ajzaa_blog_image_left') {
			//var_dump('grid image left');
			$ajzaa_class_name = ajzaa_get_post_category ();
			$ajzaa_class_name .= " ajzaa_multi_post_isotop_item wd-image-left all " . $animation_classes;
			?>
			<li id="post-<?php the_ID (); ?>" <?php post_class ($ajzaa_class_name); ?> <?php echo esc_attr ($data_animated); ?>>
				<div class="large-12 columns ajzaa_multi_post_gallery_left_image">
					<div class="columns large-4">
						<ul class="ajzaa_blog_post_gallery_left_image">
							<?php $portfolio_image_gallery_val = get_post_meta (get_the_ID (), 'ajzaa_portfolio-image-gallery', true);
							if ($portfolio_image_gallery_val != '')
								$portfolio_image_gallery_array = explode (',', $portfolio_image_gallery_val);
							if (isset($portfolio_image_gallery_array) && count ($portfolio_image_gallery_array) != 0) :
								foreach ($portfolio_image_gallery_array as $gimg_id) :
									$thumb = wp_get_attachment_image_src ($gimg_id, 'full');
									if ($ajzaa_image_size_h != '') {
										$image = ajzaa_resize ($thumb[0], $ajzaa_image_size_w, $ajzaa_image_size_h, true);
									}
									else {
										$image = ajzaa_resize ($thumb[0], $ajzaa_image_size_w, true);
									} ?>
									<li><img src="<?php echo $image ?>" alt="<?php echo get_the_title () ?>"/></li><?php
								endforeach;
							endif;
							?>
						</ul>
					</div>
					<div class="large-8 columns ajzaa_multi_post_gallery_left_image_info">
						<<?php echo esc_attr ($ajzaa_blog_title_tag); ?>
						style="<?php echo esc_attr ($ajzaa_custom_blog_name_inline_style); ?>">
						<a href="<?php the_permalink () ?>" style="color:<?php echo $ajzaa_blog_title_color ?>;"><?php the_title () ?></a>
					</<?php echo esc_attr ($ajzaa_blog_title_tag); ?>>
					<div>
						<span style="<?php echo esc_attr ($ajzaa_custom_blog_tags_date_inline_style) ?>"><?php echo get_the_date () ?>  </span>
						<span style="<?php echo esc_attr ($ajzaa_custom_blog_author_inline_style) ?>"> <?php the_author () ?></span>
						<?php the_category () ?>
						<?php if ($ajzaa_blog_display_content == 'yes') { ?>
							<p style="<?php echo esc_attr ($ajzaa_custom_blog_text_inline_style) ?>"><?php echo wp_trim_words (get_the_content (), 20); ?></p>
						<?php } ?>
					</div>
					<div class="wd-redmore"><a href="<?php the_permalink () ?>">Read
							More</a><i class="ion-ios-arrow-thin-right"></i></div>
				</div>
				</div>
			</li>
			<?php
			//----------------post image top -------------------
		}
		else {
			$ajzaa_class_name = ajzaa_get_post_category ();
			$ajzaa_class_name .= " ajzaa_multi_post_isotop_item all " . $animation_classes;
			?>
			<li id="post-<?php the_ID (); ?>" <?php post_class ($ajzaa_class_name); ?>>
  <div class="ajzaa_multi_post_gallery_masonry">
    <ul class="ajzaa_blog_post_gallery_masonry">
      <?php $portfolio_image_gallery_val = get_post_meta (get_the_ID (), 'ajzaa_portfolio-image-gallery', true);
      if ($portfolio_image_gallery_val != '')
	      $portfolio_image_gallery_array = explode (',', $portfolio_image_gallery_val);
      if (isset($portfolio_image_gallery_array) && count ($portfolio_image_gallery_array) != 0) :
	      foreach ($portfolio_image_gallery_array as $gimg_id) :
		      $thumb = wp_get_attachment_image_src ($gimg_id, 'full');
		      if ($ajzaa_image_size_h != '') {
			      $image = ajzaa_resize ($thumb[0], $ajzaa_image_size_w, $ajzaa_image_size_h, true);
		      }
		      ?>
		      <li><img src="<?php echo $image ?>" alt="<?php echo get_the_title () ?>"/></li><?php
	      endforeach;
      endif;
      ?>
    </ul>
    <div class="ajzaa_multi_post_gallery_masonry_info">
      <h2><a href="<?php the_permalink () ?>"><?php the_title () ?></a></h2>
      <div>
        <span><?php the_author () ?></span>
        <span>  <?php echo get_the_date () ?>  </span>
	      <?php the_category () ?>
	      <p><?php echo wp_trim_words (get_the_content (), 25); ?></p>
      </div>
      <div class="wd-redmore"><a href="<?php the_permalink () ?>"><?php echo esc_html__ ("Continue", 'ajzaa') ?></a><i
		      class="ion-ios-arrow-thin-right"></i></div>
    </div>
  </div>
</li>


			<?php
		}

	}


	//__________________one post___________________________
}
elseif ($ajzaa_blog_type == 'ajzaa_one_post') {
	?>
	<div class="ajzaa_one_post_gallery <?php echo esc_attr ($animation_classes); ?>" <?php echo esc_attr ($data_animated); ?>>
		<ul class="ajzaa_blog_post_gallery">
			<?php $portfolio_image_gallery_val = get_post_meta (get_the_ID (), 'ajzaa_portfolio-image-gallery', true);
			if ($portfolio_image_gallery_val != '')
				$portfolio_image_gallery_array = explode (',', $portfolio_image_gallery_val);
			if (isset($portfolio_image_gallery_array) && count ($portfolio_image_gallery_array) != 0) :
				foreach ($portfolio_image_gallery_array as $gimg_id) :
					$thumb = wp_get_attachment_image_src ($gimg_id, 'full');
					if ($ajzaa_image_size_h != '') {
						$image = ajzaa_resize ($thumb[0], $ajzaa_image_size_w, $ajzaa_image_size_h, true);
					}
					else {
						$image = ajzaa_resize ($thumb[0], $ajzaa_image_size_w, 477, true);
					}
					?>
					<li><img src="<? echo $image ?>" alt="<?php echo get_the_title () ?>"/></li><?php
				endforeach;
			endif;
			?>
		</ul>

		<div class="ajzaa_one_post_gallery_info">
			<<?php echo esc_attr ($ajzaa_blog_title_tag); ?>
			style="<?php echo esc_attr ($ajzaa_custom_blog_name_inline_style); ?>">
			<a href="<?php the_permalink () ?>" style="color:<?php echo $ajzaa_blog_title_color ?>;"><?php the_title () ?></a>
		</<?php echo esc_attr ($ajzaa_blog_title_tag); ?>>
		<div>
			<span><?php echo get_the_date () ?>  </span>
			<span> <?php the_author () ?></span>
			<?php the_category () ?>
		</div>
		<a class="button small" href="<?php the_permalink () ?>">Continue</a>
	</div>
	</div>
	<?php
}
else {
	if ($ajzaa_counter == 1) {
		?>
		<div class="large-12 columns ajzaa_freestyle_content_position_<?php echo esc_attr ($ajzaa_counter) . ' ' . $animation_classes; ?>" <?php echo esc_attr ($data_animated); ?>>
			<div class="large-6 columns">
				<ul class="ajzaa_blog_post_gallery">
					<?php $portfolio_image_gallery_val = get_post_meta (get_the_ID (), 'ajzaa_portfolio-image-gallery', true);
					if ($portfolio_image_gallery_val != '')
						$portfolio_image_gallery_array = explode (',', $portfolio_image_gallery_val);
					if (isset($portfolio_image_gallery_array) && count ($portfolio_image_gallery_array) != 0) :
						foreach ($portfolio_image_gallery_array as $gimg_id) :
							$thumb = wp_get_attachment_image_src ($gimg_id, 'full');
							if ($ajzaa_image_size_h != '') {
								$image = ajzaa_resize ($thumb[0], $ajzaa_image_size_w, $ajzaa_image_size_h, true);
							}
							else {
								$image = ajzaa_resize ($thumb[0], $ajzaa_image_size_w, true);
							}
							echo '<li><img src="' . $image . '" alt="' . get_the_title () . '"/></li>';
						endforeach;
					endif;
					?>
				</ul>
			</div>

			<div class="large-6 columns ajzaa_freestyle_content_position_<?php echo esc_attr ($ajzaa_counter) . ' ' . esc_attr ($animation_classes); ?>_info">
				<<?php echo esc_attr ($ajzaa_blog_title_tag); ?>
				style="<?php echo esc_attr ($ajzaa_custom_blog_name_inline_style); ?>">
				<a href="<?php the_permalink () ?>" style="color:<?php echo $ajzaa_blog_title_color ?>;"><?php the_title () ?></a>
			</<?php echo esc_attr ($ajzaa_blog_title_tag); ?>>
			<div>
				<span style="<?php echo esc_attr ($ajzaa_custom_blog_tags_date_inline_style) ?>"> <?php echo get_the_date () ?></span>
				<span style="<?php echo esc_attr ($ajzaa_custom_blog_author_inline_style) ?>"><?php the_author () ?></span>
				<?php the_category () ?>
			</div>
			<div class="wd-redmore"><a href="<?php the_permalink () ?>">Continue</a><i class="ion-ios-arrow-thin-right"></i>
			</div>
		</div>

		</div>
		<?php
	}
	elseif ($ajzaa_counter == 4) {
		?>
		<div class="ajzaa_freestyle_content_position_<?php echo esc_attr ($ajzaa_counter) . ' ' . esc_attr ($animation_classes); ?>" <?php echo esc_attr ($data_animated); ?>>
			<div>
				<ul class="ajzaa_blog_post_gallery">
					<?php $portfolio_image_gallery_val = get_post_meta (get_the_ID (), 'ajzaa_portfolio-image-gallery', true);
					if ($portfolio_image_gallery_val != '')
						$portfolio_image_gallery_array = explode (',', $portfolio_image_gallery_val);
					if (isset($portfolio_image_gallery_array) && count ($portfolio_image_gallery_array) != 0) :
						foreach ($portfolio_image_gallery_array as $gimg_id) :
							$thumb = wp_get_attachment_image_src ($gimg_id, 'full');
							if ($ajzaa_image_size_h != '') {
								$image = ajzaa_resize ($thumb[0], $ajzaa_image_size_w, $ajzaa_image_size_h, true);
							}
							else {
								$image = ajzaa_resize ($thumb[0], $ajzaa_image_size_w, true);
							}
							echo '<li><img src="' . $image . '" alt="' . get_the_title () . '" /></li>';
						endforeach;
					endif;
					?>
				</ul>
			</div>

			<div class="ajzaa_freestyle_content_position_<?php echo esc_attr ($ajzaa_counter) . ' ' . esc_attr ($animation_classes); ?>_info">
				<<?php echo esc_attr ($ajzaa_blog_title_tag); ?>
				style="<?php echo esc_attr ($ajzaa_custom_blog_name_inline_style); ?>">
				<a href="<?php the_permalink () ?>" alt="<?php the_title () ?>" style="color:<?php echo $ajzaa_blog_title_color ?>;"><?php the_title () ?></a>
			</<?php echo esc_attr ($ajzaa_blog_title_tag); ?>>
			<div>
				<span> <?php echo get_the_date () ?></span>
				<span> by :</span><?php the_author () ?>
				<span> in :</span><?php the_category () ?>
			</div>
			<div class="wd-redmore"><a href="<?php the_permalink () ?>">Continue</a><i class="ion-ios-arrow-thin-right"></i>
			</div>
		</div>

		</div>
		<?php
	}
	else {
		?>
		<div class="large-6 columns ajzaa_freestyle_content_position_<?php echo esc_attr ($ajzaa_counter) . ' ' . esc_attr ($animation_classes); ?>" <?php echo esc_attr ($data_animated); ?>>
			<ul class="ajzaa_blog_post_gallery">
				<?php $portfolio_image_gallery_val = get_post_meta (get_the_ID (), 'ajzaa_portfolio-image-gallery', true);
				if ($portfolio_image_gallery_val != '')
					$portfolio_image_gallery_array = explode (',', $portfolio_image_gallery_val);
				if (isset($portfolio_image_gallery_array) && count ($portfolio_image_gallery_array) != 0) :
					foreach ($portfolio_image_gallery_array as $gimg_id) :
						$thumb = wp_get_attachment_image_src ($gimg_id, 'full');
						if ($ajzaa_image_size_h != '') {
							$image = ajzaa_resize ($thumb[0], $ajzaa_image_size_w, $ajzaa_image_size_h, true);
						}
						else {
							$image = ajzaa_resize ($thumb[0], $ajzaa_image_size_w, true);
						}
						echo '<li><img src="' . $image . '" alt="' . get_the_title () . '"/></li>';
					endforeach;
				endif;
				?>
			</ul>
		</div>
		<?php
	}
}
