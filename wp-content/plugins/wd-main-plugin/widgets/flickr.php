<?php

//Widget Function Name  ajzaa_flickr
class ajzaa_flickr extends WP_Widget {
	private $widget_id;

	public function __construct () {
		$this->widget_id = 'flickr_widget';
		$widget_name = __ ('Widget Of Flickr', 'ajzaa');

		$widget_options = array (
			'classname' => 'flickr_widget',
			'description' => __ ('Display your latest Flickr photos.', 'ajzaa'),
		);

		parent::__construct ($this->widget_id, $widget_name, $widget_options);

		add_action ('save_post', array (
			$this,
			'ajzaa_flush_widget_cache'
		));
		add_action ('deleted_post', array (
			$this,
			'ajzaa_flush_widget_cache'
		));
		add_action ('switch_theme', array (
			$this,
			'ajzaa_flush_widget_cache'
		));
	}

	public function ajzaa_flush_widget_cache () {
		wp_cache_delete ($this->widget_id);
	}

	function widget ($args, $instance) {

		$cache = wp_cache_get ($this->widget_id);

		if ($cache) {
			echo $cache;
			return;
		}




		$title = isset($instance['title']) ? esc_attr ($instance['title']) : null;
		$flickr_id = isset($instance['flickr_id']) ? esc_attr ($instance['flickr_id']) : null;
		$number = isset($instance['number']) ? absint ($instance['number']) : 6;
		$row_number = isset($instance['row_number']) ? absint ($instance['row_number']) : 3;
		if ($row_number <= 3) {
			$row_number = 3;
		}
		$mode_value = $instance['mode'];
		$slider_number = $instance['slider_number'];
		$rss = fetch_feed ('http://api.flickr.com/services/feeds/photos_public.gne?ids=' . $flickr_id . '&lang=en-us&format=rss_200');

		add_filter ('wp_feed_cache_transient_lifetime', function () {
			return 1800;
		});

		if (is_wp_error ($rss)) {
			return;
		}
		// Figure out how many total items there are
		$max_items = $rss->get_item_quantity ($number);
		// Build an array of all the items, starting with element 0 (first element).
		$items = $rss->get_items (0, $max_items);
      ob_start ();
		echo $args['before_widget'];

		if ($title)
			echo $args['before_title'] . $title . $args['after_title'];
		if ($mode_value == 'grid') {
			?>
			<ul class="small-block-grid-3 large-block-grid-3 flickr lightgallery">
				<?php
				if (isset($items)) {

					foreach ($items as $item) {
						// thumbnail,
						$image_group = $item->get_item_tags ('http://search.yahoo.com/mrss/', 'thumbnail');
						$image_attrs = $image_group[0]['attribs'];
						foreach ($image_attrs as $image) {

							$_img_src = $image['url'];
							$_img_src = str_replace ('http://', 'https://', $_img_src);
							$_img_width = intval ($image['width']);
							$_img_height = intval ($image['height']);

							$string = $image['url'];
							$newstring = str_replace ("_s", "_h", $string);
							$newstring_small = str_replace ("_s", "_q", $string);

							echo sprintf ('<li class="item" data-src="%7$s" data-sub-html="<h4>About Flickr</h4><p>Flickr (pronounced  flicker) is an image- and video-hosting website and web services suite that was created by Ludicorp in 2004 and acquired by Yahoo on 20 March 2005.[4] In addition to being a popular website for users to share and embed personal photographs, and effectively an online community, the service is widely used by photo researchers and by bloggers to host images that they embed in blogs and social media.</p>">
                    <a href="#"><img src="%8$s" alt="%6$s"></a></li>', $row_number, $item->get_permalink (), $_img_src, $_img_width, $_img_height, $item->get_title (), $size = $newstring, $size_s = $newstring_small);
						}
					}
				}
				?>
			</ul>
			<ul class="flickr-bottom">
				<li></li>
				<li>
					<a href="https://www.flickr.com/photos/<?php echo $flickr_id; ?>" class="visit_me"> View stream on flickr</a>
				</li>
			</ul>

			<?php
		}
		elseif ($mode_value == 'Slider') { ?>
			<ul class="carousel_flickr lightgallery flickr" data-item="<?php echo $slider_number; ?>">
				<?php
				if (isset($items)) {

					foreach ($items as $item) {
						// thumbnail,
						$image_group = $item->get_item_tags ('http://search.yahoo.com/mrss/', 'thumbnail');
						$image_attrs = $image_group[0]['attribs'];
						foreach ($image_attrs as $image) {

							$_img_src = $image['url'];
							$_img_src = str_replace ('http://', 'https://', $_img_src);
							$_img_width = intval ($image['width']);
							$_img_height = intval ($image['height']);

							$string = $image['url'];
							$newstring = str_replace ("_s", "_h", $string);

							echo sprintf ('<li class="item" data-src="%7$s" data-sub-html="<h4>About Flickr</h4><p>Flickr (pronounced  flicker) is an image- and video-hosting website and web services suite that was created by Ludicorp in 2004 and acquired by Yahoo on 20 March 2005.[4] In addition to being a popular website for users to share and embed personal photographs, and effectively an online community, the service is widely used by photo researchers and by bloggers to host images that they embed in blogs and social media.</p>">
                    <a href="#"><img src="%3$s" width="%4$s" height="%5$s" alt="%6$s"></a></li>', $row_number, $item->get_permalink (), $_img_src, $_img_width, $_img_height, $item->get_title (), $size = $newstring);
						}
					}
				}
				?>
			</ul>
			<ul class="flickr-bottom">
				<li></li>
				<li>
					<a href="https://www.flickr.com/photos/<?php echo $flickr_id; ?>" class="visit_me"> View stream on flickr</a>
				</li>
			</ul>
		<?php }
		echo $args['after_widget'];
		$content = ob_get_clean ();
		//wp_cache_set ($this->widget_id, $content);
		echo $content;
	}

	function update ($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = sanitize_text_field ($new_instance['title']);
		$instance['flickr_id'] = sanitize_text_field ($new_instance['flickr_id']);
		$instance['number'] = absint ($new_instance['number']);
		$instance['mode'] = sanitize_text_field ($new_instance['mode']);
		$instance['slider_number'] = sanitize_text_field ($new_instance['slider_number']);

		$this->ajzaa_flush_widget_cache ();
		return $instance;
	}

	function form ($instance) {
		$defaults = array (
			'title' => __ ('Flickr Photos', 'ajzaa'),
			'flickr_id' => '',
			'number' => 6,
			'mode' => '',
			'slider_number' => 1,
		);
		$instance = wp_parse_args ((array)$instance, $defaults);
		$mode_value = $instance['mode'];

		?>
		<p>
			<label for="<?php echo $this->get_field_id ('title'); ?>">
				<?php _e ('Title:', 'ajzaa'); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id ('title'); ?>" name="<?php echo $this->get_field_name ('title'); ?>" value="<?php echo $instance['title']; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id ('flickr_id'); ?>">
				<?php _e ('Your Flickr User ID:', 'ajzaa'); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id ('flickr_id'); ?>" name="<?php echo $this->get_field_name ('flickr_id'); ?>" value="<?php echo $instance['flickr_id']; ?>">
			<span class="description">
				<?php echo sprintf (__ ('Ex:123456789@N00.', 'ajzaa'), '<a href="//idgettr.com" target="_blank" rel="nofollow">idgettr</a>'); ?>
			</span>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id ('number'); ?>">
				<?php _e ('Total Number of photos to show:', 'ajzaa'); ?>
			</label>
			<input type="number" class="widefat" id="<?php echo $this->get_field_id ('number'); ?>" name="<?php echo $this->get_field_name ('number'); ?>" value="<?php echo $instance['number']; ?>">
			<span class="description">
				<?php echo __ ('Set how many photos you want to show.Maximum 20 Because Flickr limit its to 20 photos', 'ajzaa'); ?>
			</span>
		</p>
		<p class="layout">
			<label for="<?php echo $this->get_field_id ('mode'); ?>">
				<?php _e ('choose a type of layout', 'ajzaa'); ?>
			</label>
			<select class='widefat' id="<?php echo $this->get_field_id ('mode'); ?>"
				name="<?php echo $this->get_field_name ('mode'); ?>" type="text">
				<option value='grid' <?php echo ($mode_value == 'grid') ? 'selected=selected' : ''; ?>>
					Grid
				</option>
				<option value='Slider' <?php echo ($mode_value == 'Slider') ? 'selected=selected' : ''; ?>>
					Slider
				</option>
			</select>
			<span class="description">
				<?php echo __ ('choose type of layout to display items:', 'ajzaa'); ?>
			</span>
		</p>

		<p class="slider_number <?php echo ($mode_value == "Slider") ? 'open' : ''; ?>">
			<label for="<?php echo $this->get_field_id ('slider_number'); ?>">
				<?php _e ('set how many items shown', 'ajzaa'); ?>
			</label>
			<input type="number" class="widefat" id="<?php echo $this->get_field_id ('slider_number'); ?>" name="<?php echo $this->get_field_name ('slider_number'); ?>" value="<?php echo $instance['slider_number']; ?>">
			<span class="description">
				<?php echo __ ('number of pictures showen on slider:', 'ajzaa'); ?>
			</span>
		</p>
		<?php
	}
}

add_action ('widgets_init', function () {
	register_widget ("ajzaa_flickr");
});
