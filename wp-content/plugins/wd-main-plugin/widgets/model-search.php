<?php

class ajzaa_model_search extends WP_Widget {

	function __construct () {

		parent::__construct ('ajzaa_model_search',  // Base ID
			'Model Search'   // Name
		);

		add_action ('widgets_init', function () {
			register_widget ('ajzaa_model_search');
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
		// content
		$product_tax_parents = get_terms (array (
			'taxonomy' => 'product_tax',
			'hide_empty' => false,
			'parent' => 0
		));
		?>
		<script>
			jQuery(document).ready(function ($) {

				var ajaxurl = '<?php echo admin_url ('admin-ajax.php'); ?>';
				$('.textwidget .brands_form #marques').on('select2:select', function (e) {
					$('.textwidget .brands_form .brands').append("<span class='fa fa-spinner fa-spin'></span>");
					$('.textwidget .brands_form .brands .select2-selection__arrow').hide();
					var brands = $('.textwidget .brands_form #marques').find(':selected').data('id');
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: {
							action: "ajzaa_products_model",
							brands: brands
						},
						success: function (data) {
							$('.textwidget .brands_form #models').html(data);
							$(".textwidget .brands .fa-spinner").remove();
							$('.textwidget .brands_form .brands .select2-selection__arrow').show();
						},
						error: function (errorThrown) {
							alert(errorThrown);
						}
					});
				});
				$('.textwidget .brands_form #models').on('select2:select', function (e) {
					$('.textwidget .brands_form .keyword').append("<span class='fa fa-spinner fa-spin'></span>");
					$('.textwidget .brands_form .keyword .select2-selection__arrow').hide();
					var years = $('.textwidget .brands_form #models').find(':selected').data('id');
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: {
							action: "ajzaa_products_years",
							years: years
						},
						success: function (data) {
							$('.textwidget .brands_form #year').html(data);
							$(".textwidget .keyword .fa-spinner").remove();
							$('.textwidget .brands_form .keyword .select2-selection__arrow').show();
						},
						error: function (errorThrown) {
							alert(errorThrown);
						}
					});
				});

			});
		</script>
		<div class="brands_header">
			<?php
			if (!empty($instance['title'])) {
				echo $args['before_title'] . apply_filters ('widget_title', $instance['title']) . $args['after_title'];
			}
			?>
		</div>
		<div class="brands_form">
			<form method="post">
				<ul class="inline-list">
					<li class="brands">
						<select name="marques" id="marques">
							<option value='-1' disabled selected><span>1</span> |<?php  echo esc_html__('Select Brand...','ajzaa') ?></option>
							<?php
							foreach ($product_tax_parents as $parent) {
								?>
								<option value="<?php echo $parent->slug ?>"
									data-id="<?php echo $parent->term_id ?>"><?php echo $parent->name;
									if ($parent->count > 0):
										?>
										(<?php echo $parent->count ?>)
										<?php
									endif;
									?>
								</option>
								<?php
							}
							?>
						</select>

					</li>
					<li class="keyword">
						<select id="models">
							<option value='-1' disabled selected>2 <span>|</span><?php  echo esc_html__('Select Model...','ajzaa') ?></option>
						</select>
					</li>
					<li class="year">
						<select id="year">
							<option value='-1' disabled selected>3 <span>|</span><?php  echo esc_html__('Select Year...','ajzaa') ?></option>
						</select>
					</li>
					<li class="search">
						<input type="button" class="button" value="<?php echo esc_attr__("Search", 'ajzaa') ?>">
					</li>
				</ul>
			</form>
		</div>
		<?php
		echo '</div>';

		echo $args['after_widget'];

	}

	public function form ($instance) {

		$title = !empty($instance['title']) ? $instance['title'] : '';
		?>
		<p>
			<label
				for="<?php echo esc_attr ($this->get_field_id ('title')); ?>"><?php esc_attr_e ('Title:', 'ajzaa'); ?></label>
			<input class="widefat" id="<?php echo esc_attr ($this->get_field_id ('title')); ?>"
				name="<?php echo esc_attr ($this->get_field_name ('title')); ?>" type="text"
				value="<?php echo esc_attr ($title); ?>">
		</p>
		<?php

	}

	public function update ($new_instance, $old_instance) {

		$instance = array ();

		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags ($new_instance['title']) : '';

		return $instance;
	}

}

$ajzaa_model_search = new ajzaa_model_search();