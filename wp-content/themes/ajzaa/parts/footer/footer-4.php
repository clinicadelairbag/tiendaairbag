
<footer class="wd-footer-4">
		<div class="large-6 columns">
			<?php
			 $ajzaa_copyright = ajzaa_get_option('ajzaa_copyright','');

			 echo esc_html($ajzaa_copyright); ?>
		</div>
		<div class="social-icon large-6 columns">
			<span><?php esc_html__('Follow us on', 'ajzaa') ?></span>
			<?php
			$socialmediaicon_arry = explode(' ', ajzaa_get_option('social_icon'));
			$socialmedia_arry = explode(' ', ajzaa_get_option('socialmedia_name'));
			if (!empty($socialmedia_arry[0])) {
				$i = 0;
				foreach ($socialmedia_arry as $social_data) {
					?>
					<a href="<?php echo esc_url($social_data) ?>"><i
							class="fa <?php echo esc_attr($socialmediaicon_arry[$i]) ?>"></i></a>
					<?php
					$i++;
				}
			}
			?>
		</div>
</footer>
