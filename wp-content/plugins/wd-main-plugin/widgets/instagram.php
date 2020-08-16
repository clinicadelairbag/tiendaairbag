<?php
// Widget Function Name  ajzaa_instagram
class ajzaa_instagram extends WP_Widget {
	function __construct () {
		parent::__construct ('custom_instagram_widget', __ ('Widget of Instagram', 'ajzaa'), array ('description' => __ ('Instagram Widget', 'ajzaa'),));
	}

	// Creating widget front-end
	public function widget ($args, $instance) {
		$ajzaa_title = apply_filters ('widget_title', $instance['ajzaa_title']);
		$username = $instance['ajzaa_username'];
		$number = $instance['number'];
		$mode_value = $instance['mode'];
		$slider_number = $instance['slider_number'];
		$limit = empty( $instance['slider_number'] ) ? 6 : $instance['slider_number'];
		if ($username !== '') {
			$media_array = $this->ajzaa_instagram_username( $username );
			if (!function_exists('ajzaa_instagram_url')) {
				function ajzaa_instagram_url($url)
				{
					$ch = curl_init();
					curl_setopt_array($ch, array(
						CURLOPT_URL => $url,
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_SSL_VERIFYPEER => false,
						CURLOPT_SSL_VERIFYHOST => 2
					));

					$feed_data = curl_exec($ch);
					curl_close($ch);
					return $feed_data;
				}
			}
			$user_data = ajzaa_instagram_url ("https://api.instagram.com/v1/users/search?q=" . $username . "&access_token=1631861081.3a81a9f.9d7b2e2bc94f42df935055677efb2c4d");
			$user_data = json_decode ($user_data);
			$string = $username;
			$newstring = str_replace ("@", "", $string);
			ob_start ();
			echo $args['before_widget'];
			echo $args['before_title'] . $ajzaa_title . $args['after_title'];
			if ($mode_value == 'grid') {

				echo "<ul class='small-block-grid-3 large-block-grid-3 instagram lightgallery'>";
				foreach ($media_array as $item) {
					?>
					<li>
						<a class="custom_instagram_widget" target="blank" href="<?php echo esc_url( $item['link'] ); ?>">
							<img src="<?php echo  esc_url( $item['large'] ); ?>"
									 alt="<?php echo  esc_url( $item['large'] ); ?> "/>
						</a>
					</li>
				<?php }
				echo "</ul>";
				?>
				<ul class="instagram-bottom">
					<li></li>
					<li>
						<a href="https://www.instagram.com/<?php echo $newstring; ?>" class="visit_me"> View stream on instagram</a>
					</li>
				</ul>
				<?php
			}
			elseif ($mode_value == 'Slider') { ?>
				<ul class="carousel_instagram lightgallery instagram lightgallery" data-item="<?php echo $slider_number; ?>">
					<?php foreach ($media_array as $item) {
						?>
						<li class="item" data-src="<?php echo esc_url( $item['large'] ); ?>" data-sub-html="<h4>About Instagram</h4><p>Instagram is a mobile, desktop, and Internet-based photo-sharing application and service that allows users to share pictures and videos either publicly, or privately to pre-approved followers. It was created by Kevin Systrom and Mike Krieger, and launched in October 2010 as a free mobile app exclusively for the iOS operating system. A version for Android devices was released two years later, in April 2012, followed by a feature-limited website interface in November 2012, and apps for Windows 10 Mobile and Windows 10 in April 2016 and October 2016 respectively.</p>">
							<a href=""><img src="<?php echo  esc_url( $item['large'] ); ?>" alt="<?php echo  esc_url( $item['large'] ); ?>"></a>
						</li>
					<?php } ?>
				</ul>
				<ul class="instagram-bottom">
					<li></li>
					<li>
						<a href="https://www.instagram.com/<?php echo $newstring; ?>" class="visit_me"> View stream on instagram</a>
					</li>
				</ul>
			<?php }
			echo $args['after_widget'];
			$content = ob_get_clean ();
			echo $content;
		}
	}

	// Widget Backend
	public function form ($instance) {
		// show default values
		$instance = wp_parse_args ((array)$instance, array (
			'ajzaa_title' => __ ('Instagram Widget', 'ajzaa'),
			'ajzaa_username' => ''
		));
		if (isset($instance['ajzaa_username'])) {
			$ajzaa_username = $instance['ajzaa_username'];
		};
		if (isset($instance['ajzaa_title'])) {
			$ajzaa_title = $instance['ajzaa_title'];
		}
		if (isset($instance['number'])) {
			$number = $instance['number'];
		}
		if (isset($instance['mode'])) {
			$mode_value = $instance['mode'];
		}
		if (isset($instance['slider_number'])) {
			$slider_number = $instance['slider_number'];
		}


		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id ('ajzaa_title'); ?>"><?php _e ('Title:', 'ajzaa'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id ('ajzaa_title'); ?>" name="<?php echo $this->get_field_name ('ajzaa_title'); ?>" type="text" value="<?php echo esc_attr ($ajzaa_title); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id ('ajzaa_username'); ?>"><?php _e ('User Name:', 'ajzaa'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id ('ajzaa_username'); ?>" name="<?php echo $this->get_field_name ('ajzaa_username'); ?>" type="text" value="<?php echo esc_attr ($ajzaa_username); ?>"/>
			<span class="description">
				<?php echo sprintf (__ ('Ex:@username.', 'ajzaa'), '<a href="//idgettr.com" target="_blank" rel="nofollow">idgettr</a>'); ?>
			</span>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id ('number'); ?>"><?php _e ('number of items:', 'ajzaa'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id ('number'); ?>" name="<?php echo $this->get_field_name ('number'); ?>" type="number" value="<?php echo esc_attr ($number); ?>"/>
			<span class="description">
				<?php echo sprintf (__ ('shoose how many items you want to show', 'ajzaa'), '<a href="//idgettr.com" target="_blank" rel="nofollow">idgettr</a>'); ?>
			</span>
		</p>
		<p class="layout">
			<label for="<?php echo $this->get_field_id ('mode'); ?>">
				<?php _e ('choose a type of layout', 'ajzaa'); ?>
			</label>
			<select class='widefat' id="<?php echo $this->get_field_id ('mode'); ?>"
							name="<?php echo $this->get_field_name ('mode'); ?>" type="text">
				<option value='grid'<?php echo ($mode_value == 'grid') ? 'selected' : ''; ?>>
					Grid
				</option>
				<option value='Slider'<?php echo ($mode_value == 'Slider') ? 'selected' : ''; ?>>
					Slider
				</option>
			</select>
			<span class="description">
				<?php echo __ ('choose type of layout to display items:', 'ajzaa'); ?>
			</span>
		</p>
		<p class="slider_number <?php echo ($mode_value == "Slider") ? 'open' : ''; ?>">
			<label for="<?php echo $this->get_field_id ('slider_number'); ?>">
				<?php _e ('set how many items showen', 'ajzaa'); ?>
			</label>
			<input type="number" class="widefat" id="<?php echo $this->get_field_id ('slider_number'); ?>" name="<?php echo $this->get_field_name ('slider_number'); ?>" value="<?php echo $slider_number; ?>">
			<span class="description">
				<?php echo __ ('number of pictures showen on slider:', 'ajzaa'); ?>
			</span>
		</p>
		<?php
	}

	// Updating widget replacing old instances with new
	public function update ($new_instance, $old_instance) {
		$instance = array ();
		$instance['ajzaa_username'] = (!empty($new_instance['ajzaa_username'])) ? strip_tags ($new_instance['ajzaa_username']) : '';
		$instance['ajzaa_title'] = (!empty($new_instance['ajzaa_title'])) ? strip_tags ($new_instance['ajzaa_title']) : '';
		$instance['number'] = (!empty($new_instance['number'])) ? strip_tags ($new_instance['number']) : '';
		$instance['mode'] = sanitize_text_field ($new_instance['mode']);
		$instance['slider_number'] = sanitize_text_field ($new_instance['slider_number']);
		return $instance;
	}

	function ajzaa_instagram_username( $username ) {

		$username = trim( strtolower( $username ) );

		switch ( substr( $username, 0, 1 ) ) {
			case '#':
				$url              = 'https://instagram.com/explore/tags/' . str_replace( '#', '', $username );
				$transient_prefix = 'h';
				break;

			default:
				$url              = 'https://instagram.com/' . str_replace( '@', '', $username );
				$transient_prefix = 'u';
				break;
		}

		if ( false === ( $instagram = get_transient( 'insta-a10-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ) ) ) ) {

			$remote = wp_remote_get( $url );

			if ( is_wp_error( $remote ) ) {
				return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'ajzaa' ) );
			}

			if ( 200 !== wp_remote_retrieve_response_code( $remote ) ) {
				return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'ajzaa' ) );
			}

			$shards      = explode( 'window._sharedData = ', $remote['body'] );
			$insta_json  = explode( ';</script>', $shards[1] );
			$insta_array = json_decode( $insta_json[0], true );

			if ( ! $insta_array ) {
				return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'ajzaa' ) );
			}

			if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
				$images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
			} elseif ( isset( $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
				$images = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
			} else {
				return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'ajzaa' ) );
			}

			if ( ! is_array( $images ) ) {
				return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'ajzaa' ) );
			}

			$instagram = array();

			foreach ( $images as $image ) {
				if ( true === $image['node']['is_video'] ) {
					$type = 'video';
				} else {
					$type = 'image';
				}

				$caption = __( 'Instagram Image', 'ajzaa' );
				if ( ! empty( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
					$caption = wp_kses( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'], array() );
				}

				$instagram[] = array(
					'description' => $caption,
					'link'        => trailingslashit( '//instagram.com/p/' . $image['node']['shortcode'] ),
					'time'        => $image['node']['taken_at_timestamp'],
					'comments'    => $image['node']['edge_media_to_comment']['count'],
					'likes'       => $image['node']['edge_liked_by']['count'],
					'thumbnail'   => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][0]['src'] ),
					'small'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][2]['src'] ),
					'large'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][4]['src'] ),
					'original'    => preg_replace( '/^https?\:/i', '', $image['node']['display_url'] ),
					'type'        => $type,
				);
			} // End foreach().

			if ( ! empty( $instagram ) ) {
				$instagram = base64_encode( serialize( $instagram ) );
				set_transient( 'insta-a10-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * 2 ) );
			}
		}
		if ( ! empty( $instagram ) ) {

			return unserialize( base64_decode( $instagram ) );

		} else {

			return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'ajzaa' ) );

		}
	}
}

add_action ('widgets_init', function () {
	register_widget ("ajzaa_instagram");
});