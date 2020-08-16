<?php

class ajzaa_product_suppliers extends WP_Widget {

	function __construct () {

		parent::__construct ('ajzaa_product_suppliers',  // Base ID
			'Product Suppliers'   // Name
		);

		add_action ('widgets_init', function () {
			register_widget ('ajzaa_product_suppliers');
		});

	}

	public $args = array (
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
		'before_widget' => '<div class="widget-wrap">',
		'after_widget' => '</div></div>'
	);

	public function widget ($args, $instance) {

		echo $args['before_widget'];
		echo '<div class="textwidget">';
		$product_tax_parents = get_terms (array (
			'taxonomy' => 'product_provider',
			'hide_empty' => false,
		));
		if (!empty($instance['title'])) {
			echo $args['before_title'] . apply_filters ('widget_title', $instance['title']) . $args['after_title'];
		}
		if (!empty($instance['number_items'])) {
			$number_items = $instance['number_items'];
		}
		else {
			$number_items = '5';
		}
		if (!empty($instance['img_size'])) {
			$size = $instance['img_size'];
		}
		else {
			$size = '213x51';
		}
		if (!empty($instance['show_title'])) {
			$show_title = $instance['show_title'];
		}
		else {
			$show_title = false;
		}
		?>
		<ul class="suppliers_list_widget small-block-grid-2">
			<?php
			$i = 0;
			foreach ($product_tax_parents as $parent) {
				$i++;
				$image_id = get_term_meta ($parent->term_id, 'showcase-taxonomy-image-id', true);
				$cat_link = get_term_link ($parent);
				?>
				<li>
					<?php if ($i <= $number_items) {
						?>
						<a href="<?php echo esc_url ($cat_link); ?>">
							<?php
							$sap = str_replace (array (
								'X',
								'x'
							), 'X', $size);
							$ajzaa_image_size_ = explode ('X', $sap);
							if (isset($ajzaa_image_size_[0])) {
								$ajzaa_image_size_w = $ajzaa_image_size_[0];
							}
							if (isset($ajzaa_image_size_[1])) {
								$ajzaa_image_size_h = $ajzaa_image_size_[1];
							}
							else {
								$ajzaa_image_size_h = '';
							}
							$ajzaa_image_url = wp_get_attachment_url ($image_id, 'full');
							if ($ajzaa_image_size_h != '') {
								$image = ajzaa_resize ($ajzaa_image_url, $ajzaa_image_size_w, $ajzaa_image_size_h, true);
							}
							else {
								$image = ajzaa_resize ($ajzaa_image_url, $ajzaa_image_size_w, true);
							}
							if ($image == false) {
								?>
								<img src="<?php echo $ajzaa_image_url ?>" alt='<?php echo $parent->slug; ?>'>
								<?php
							}
							else {
								?>
								<img src="<?php echo esc_attr ($image) ?>" alt='<?php echo $parent->slug; ?>'>
								<?php
							}
							if ($show_title) {
								?>
								<span class="supplier_name">
              <?php echo $parent->name;
							if ($parent->count > 0) {
								echo "(" . $parent->count . ")";
							} ?>
            </span>
								<?php
							}
							?>
						</a>
						<?php
					}
					else {
						break;
					} ?>
				</li>
				<?php
			}
			?>
		</ul>
		<?php
		echo '</div>';
		echo $args['after_widget'];
	}

	public function form ($instance) {

		$title = !empty($instance['title']) ? $instance['title'] : '';
		$number_items = !empty($instance['number_items']) ? $instance['number_items'] : '';
		$img_size = !empty($instance['img_size']) ? $instance['img_size'] : '';
		$show_title = !empty($instance['show_title']) ? $instance['show_title'] : '';
		?>
		<p>
			<label
				for="<?php echo esc_attr ($this->get_field_id ('title')); ?>"><?php esc_attr_e ('Title:', 'ajzaa'); ?></label>
			<input class="widefat" id="<?php echo esc_attr ($this->get_field_id ('title')); ?>"
				name="<?php echo esc_attr ($this->get_field_name ('title')); ?>" type="text"
				value="<?php echo esc_attr ($title); ?>">
		</p>
		<p>
			<label
				for="<?php echo esc_attr ($this->get_field_id ('number_items')); ?>"><?php esc_attr_e ('Number of items:', 'ajzaa'); ?></label>
			<input class="widefat" id="<?php echo esc_attr ($this->get_field_id ('number_items')); ?>"
				name="<?php echo esc_attr ($this->get_field_name ('number_items')); ?>" type="text"
				value="<?php echo esc_attr ($number_items); ?>">
		</p>
		<p>
			<label
				for="<?php echo esc_attr ($this->get_field_id ('img_size')); ?>"><?php esc_attr_e ('thumbnail size:', 'ajzaa'); ?></label>
			<input class="widefat" id="<?php echo esc_attr ($this->get_field_id ('img_size')); ?>"
				name="<?php echo esc_attr ($this->get_field_name ('img_size')); ?>" type="text"
				value="<?php echo esc_attr ($img_size); ?>">
		</p>
		<p>
			<input class="checkbox" type="checkbox"<?php checked ($show_title); ?>
				id="<?php echo $this->get_field_id ('show_title'); ?>"
				name="<?php echo $this->get_field_name ('show_title'); ?>"/> <label
				for="<?php echo $this->get_field_id ('show_title'); ?>"><?php _e ('Show The Title'); ?></label>
		</p>
		<?php
	}

	public function update ($new_instance, $old_instance) {
		$instance = array ();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags ($new_instance['title']) : '';
		$instance['number_items'] = (!empty($new_instance['number_items'])) ? strip_tags ($new_instance['number_items']) : '';
		$instance['img_size'] = (!empty($new_instance['img_size'])) ? strip_tags ($new_instance['img_size']) : '';
		$instance['show_title'] = $new_instance['show_title'] ? true : false;

		return $instance;
	}

}

$ajzaa_product_suppliers = new ajzaa_product_suppliers();