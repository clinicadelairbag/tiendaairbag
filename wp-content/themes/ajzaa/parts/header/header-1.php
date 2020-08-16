<header
	class="wd-header wd-header-1 contain-to-grid <?php if(get_post_meta(get_queried_object_id(), "header_bg", true) == "colored") {
		echo "with-bg";
	} ?>">
	<div class="wd-menu-nav sticky">
		<?php if(ajzaa_get_option('ajzaa_show_adress_bar', '') == "on") { ?>
			<div class="wd-top-bar clearfix">
				<div class="row">
					<div class="left top-bar-links">
						<?php
						wp_nav_menu(array('theme_location' => 'top-bar', 'walker' => new ajzaa_top_bar_walker,
							'fallback_cb' => 'ajzaa_main_menu_fallback'));
						?>
					</div>
					<div class="right">
						<?php
						$socialmediaicon_arry = explode(' ', ajzaa_get_option('social_icon'));
						$socialmedia_arry = explode(' ', ajzaa_get_option('socialmedia_name'));
						if(!empty($socialmedia_arry[0])) {
							?>
							<ul class="social-icons inline-list">
								<?php
								$i = 0;
								foreach($socialmedia_arry as $social_data) {
									?>
									<li class="">
										<a href="<?php echo esc_url($social_data) ?>"><i
												class="fa <?php echo esc_attr($socialmediaicon_arry[$i]) ?>"></i></a>
									</li>
									<?php
									$i++;
								}
								?>
							</ul>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		<?php } ?>
		<nav class="top-bar" data-topbar>
			<div class="row">
				<ul class="title-area large-3 medium-3 columns">
					<li class="name">
						<div class="wd-logo left">
							<?php
							$ajzaa_logo_path = ajzaa_get_option('ajzaa_logo_path', '');
							if($ajzaa_logo_path != "") { ?>
								<h1><a title="<?php esc_html_e('Home', 'ajzaa'); ?>" rel="home"
								       href="<?php echo esc_url(home_url('/')); ?>">
										<img alt="<?php echo get_bloginfo(); ?>" src="<?php echo esc_attr($ajzaa_logo_path); ?>"></a>
								</h1>
								<?php
							}
							else {
								?>
								<h2><a class="site-title"
								       href="<?php echo esc_url(home_url('/')); ?>"><?php echo bloginfo('name') ?></a>
								</h2>
								<?php
							}
							?>
						</div>

					</li>
					<li class="toggle-topbar menu-icon"><a
							href="#"><span><?php echo esc_html__("Menu", 'ajzaa') ?></span></a>
					</li>

				</ul>
				<div class="large-9 medium-9 columns menu_bar">
					<div class="header-list">
						<ul>
							<?php
							if(class_exists('DGWT_WC_Ajax_Search')) {
								?>
								<li class="product_search"><?php
								if(function_exists("dgwt_wcas_get_search_form")) {
                                    echo dgwt_wcas_get_search_form();
                                } else {
                                    echo do_shortcode( '[wcas-search-form]' );
                                }
								?></li><?php
							}
							else {
								?>
								<li class="product_search"><?php
								get_search_form();
								?></li><?php
							}
							?>
							<li class="my_account">
								<a href="#" data-dropdown="account" data-options="is_hover:true; hover_timeout:500"><?php echo esc_html__('My Account', 'ajzaa') ?></a>
								<ul id="account" class="f-dropdown" data-dropdown-content>
								  <div class="header-account-dd header-dd-h js-account-dd-holder"><div class="header-account-top js-my-acc-name-info">
										<span class="left-menu-hide">
												My Account
										</span>
									</div>
										<div class="header-account-text-wrap">
											<?php if(is_user_logged_in()) {
												$current_user = wp_get_current_user();
												echo get_avatar($current_user->user_email, 70);
												?>
												<a class="sign-in" href="<?php echo esc_url( wp_logout_url()) ?>"><?php echo esc_html__('Log Out', 'ajzaa'); ?></a>
												<?php
											}
											else {
												?>
												<a class="sign-in" href="<?php echo esc_url( wp_login_url()) ?>"><?php echo esc_html__('Sign In', 'ajzaa'); ?></a>
												<div class="header-sign-up">
													<span><?php echo esc_html__('New Customer?', 'ajzaa'); ?>&nbsp;</span>
													<a class="link" href="<?php echo esc_url(wp_registration_url()) ?>"><?php echo esc_html__('Sign Up', 'ajzaa'); ?></a>
												</div>
												<?php
											} ?>
										</div>
									<div class="header-left-menu-spacing-wrap">
										<ul class="marked-list-h -top-space">
											<li class="marked-list-h-item ">
												<i class="fa fa-user-o" aria-hidden="true"></i>
												<a class="marked-list-h-link -my-account" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php echo esc_html__('Account', 'ajzaa'); ?></a>
											</li>
											<li class="marked-list-h-item ">
												<i class="fa fa-check" aria-hidden="true"></i>
												<a class="marked-list-h-link -my-orders js-my-acc-link" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php echo esc_html__('Orders', 'ajzaa'); ?></a>
											</li>
											<li class="marked-list-h-item ">
												<i class="fa fa-heart-o" aria-hidden="true"></i>
												<a class="marked-list-h-link -my-wishlist" href="<?php echo get_template_directory_uri()?>/wishlist/"><?php echo esc_html__('Wish Lists', 'ajzaa'); ?></a>
											</li>
										</ul>
									</div>
									</div>
								</ul>
							</li>
							<li class="garage">
								<a href="#" data-dropdown="garage-icon" data-options="is_hover:true; hover_timeout:500">
									<span class="garage-icon">
										<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAO/SURBVGhD7Zk7yBVHGIZ/jSgJmiKJkDSaQhDSqKCNRBAxhaIoIYUoXsALWogKoo0XtFKMUQsLUbFQyyRNYqGoRQQFRUVU8E6QhARFxEviNfo8e3bCctjj2f/s7OHIf154cHZ25v3m23/P7MzY01VX76+GpbyX+hyWwyn4L8Wydd7raH0Ci+A4vIK78D2MS7FsnfdsY1v7dIQ+hrnwC7yAv2A3fA39oV7Wec82trWPffXQq636EL6DH+EfeAD74Rv4AIrKtvaxrx566am3MSrRQJgOh+BximXrvJenL2EFnEyxbF2eWvEvrFae2GjYCBfgDdyGH1IsW+c929g2T7H+4j1joOg7rPFE2Al3wIGeBwc6CuplnfdsY1v72FePvEE2+g06xqY6DD69RrPKRzATDsB9cBY6Ab46w6GobGsf++qhl556G6NeYVZ0bI6xqWxU3/BTWAA/w9OUn2A+eK+s9NBLz+BvLGPW++eNL1ehYfbH6hO7Bz6xGZD3xGJJb2MYy5jGzk4WvUrkXyjyDletvN+gYyuUyDr4FfwKd5oc0xFYn1wV0Gz4vVbsKDkmx1ZYfS6RoeD763fhVovYdwfo1UyVJPIZXIeLsAqWtIh9L8E1aLYariSRrXAFYkzFelwFPd+l6Im4HP8TliZXcaSXnnnL/6DoiYyH1xBzt6eXnno3UvRE3O39VitGlZ56N1KURPxxb4A94CrUH2ls6am3Mfzo1a+zSifi5uYG3IS9YKAqTkb01NsYxnI2y26sSifiTu0JDE6u2qMhYMxpyVVNpRPZDH/A2hQ/XmNTnGUWpv/GqNM7xDGmsYNKJ7IJjoF76TPQD2alDIKD6b8x6vQ2hrGMaeyg0omokeDeYFJyVa2MYSxjZhUlke1wulZM9AV8C18lV+Wkh156BvlX2VYr/q8oibiEcJemPGR7BO7gXsJKCPJ1KEKQffVwz66n3spYxswqSiIezUypFZMDg33g+zwPvBemyS0FUfZxxzcH9PLYx+NUZSz37llFScRtZnha5yDs0iaAS4twXDS5IMo+9g2+ep6tFZM6Y2YVPZHF8Aw89fgbsnto2xUhyL56eGryHPRWbUlETYVd4Kp1gBUtyr7LQC89g9qWSNXqJpJVn0rENZIr1ZjoGdS2RJxtXNrnDagV9MrOfpUm4jcjyKD+Z0ws6ZVNxFiVJHIZjoLLaz9czv2rIZbWgJ4e2RrDWMbMqqVEXP9kD9Iegk8oi2ex2TZl0Kve35jZNo6pV4mMgLzDtE7AsXXVVVd9Uz09bwFIrKpLK9BCLgAAAABJRU5ErkJggg==" style="
  										max-width: 40px;">
									</span>
									<?php echo esc_html__('Garage', 'ajzaa') ?>
								</a>
								<ul class="garage-list f-dropdown" id="garage-icon" data-dropdown-content>
								</ul>
							</li>

							<?php
							if(function_exists('WC')) {
								?>
								<li>
									<?php
									if(ajzaa_get_option('ajzaa_show_min_cart') == 'on'):
										?>
										<div class="show-cart-btn">
											<div class="hidden-cart" style="display: none;">
												<?php the_widget('WC_Widget_Cart'); ?>
											</div>
                      <img style="max-width: 33px; margin-top: -4px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAOLSURBVGhD7ZpbyE1ZHMC/aDDjPq4vJvEgRYk3tySXQRJlhCfhiQcRLy4xk5BLbs28eOIFD5JC7uMWShSKGlOmPKBEyZ3h91vsnI5zvrP3Ofvs79vyq1/f919n73U5a6+911r7NHynGTINH+GHRnyG53AmNlseYKnKl3MHNkv+w6iSt00oQVech6/Q437FZscYtAG3cIQJjbAMbcjhEOWYTvgS3+HPJuSZE2ivTAlRjlmBNmRriHLMcLQh10OUY1rjC3yPnU3IM6fwmxgnq9CGbAlRjhmJNuRaiHJMG/R54jgZiH2awF6YCmfQXmlKl2LNrEYzc2b8b8a+RstegjUzCs0s63Hi1MjJ61vsYUKtOE7M0HHiHCwpPbHVp38TsQD9Ag+FKCXOoplODlF8eqOXx+4QJeMqWubUEKXE72imm0IUn2iacz5E8fEO6XkPsZreLMtoNGO/pSRU25DN6Hn+TZUf0UvE9UlHE2JSTUN+QHvC8+yZ1LEyZj4pRKXxATakwLnoOc6gC9MHoRUuhfM6z0na+7H5Ay1gY4i+ZjD+jx4Tx7+wFAfRz71r1YWxaAFXQvQ13fAY+k1G3kHP8WFamG4ev2Ex3fENeruv2xL7J4zGSQcTYpB0jCxGj98XojpyES1oQogqk7QhNzBJ/lWzFi1ofYgqk6Qh3gQ89j62NKGejEcLuxSiygxFj/87RI2zEz12XYjqTFt0MDqRa2dCBTx+L84IUXncH3iMNqSfCVlgb1igvZMW3sHM0zGYGXZ92pfAETTP+SHKCDe2LdT1ifvJteqT3Fv6c4x7W0+F9ugYsTFpugcz5zJauPd994hr9QD2xczZgDbEfa9cMxFtiDssucZB6QB1z8u1Sq6J1ie53xd208yGXMAWJuSVLhi97j6NC3F6Dfr6PMkyOlV8qVrp3X0S/8QmYyVaCVd1R9G3xlHF/PHB/hI+QT935eib438+x/cwzmQ0dRwbT9FdyGEmgGluyFmxUut7tz+dGTgl6W8CuBFxHD0nlX3epPg0tvC7IfrCODTdNXwxXo5+5u5lIXPQ9Gp2JWvGd4v2hs8T93gjlmO5StkLfuZPSgovI8eH6ZksrEoRXUb+qsLLYju6+PKBGV1uxZxEz3FHZRHuQr8QX75mtrAqxm0bnyVWLNKGWMFy/II3sfAcx8xsbFIc4LNwG67BAVgJl7f+gMdfIXkpuktZgYaGj4wgedtNWs3WAAAAAElFTkSuQmCC">
										</div>
										<?php
									endif;
									?>
								</li>
							<?php } ?>
							<?php if(is_active_sidebar('canvas_sidebar') && is_dynamic_sidebar('canvas_sidebar')) { ?>
								<li class="sidebar-toggle-btn">
								<a href="#" class="sidebar-toggle collapse">
									<span></span>
								</a>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="top-bar-section <?php if(function_exists('WC')) {
				if(ajzaa_get_option('ajzaa_show_min_cart') == 'on') {
					echo "add-m-r";
				}
			} ?>">
				<div class="row">
					<?php if(function_exists('WC')) { ?>
						<div class="product_cat hide-for-small">
							<a href="javascript:;" class="cats-btn collapse" data-dropdown="drop">Categories
								<span></span>
							</a>
							<?php
							wp_nav_menu(array('theme_location' => 'category-menu', 'walker' => new ajzaa_top_bar_walker,
								'fallback_cb' => 'ajzaa_category_menu_fallback', 'menu_class' => 'category-menu', 'menu_id' => 'drop'))
							?>
						</div>
						<?php
					}
					?>
					<?php
					wp_nav_menu(array('theme_location' => 'primary', 'walker' => new ajzaa_top_bar_walker,
						'fallback_cb' => 'ajzaa_main_menu_fallback'))
					?>
					<?php
					wp_nav_menu(array('theme_location' => 'right', 'walker' => new ajzaa_top_bar_walker, 'menu_class' => 'right'))
					?>

					<div class="languages_section right">
						<?php
						if(ajzaa_get_option('ajzaa_show_wpml_widget') == "on") {
							if(do_action('icl_language_selector')) {
								do_action('icl_language_selector');
							}
						}
						?>
					</div>

					<?php
					if(function_exists('WC')) {
						if(ajzaa_get_option('ajzaa_show_min_cart') == 'on'):
							?>
							<div class="show-cart-btn">
								<?php
								$product_cart_count = WC()->cart->cart_contents_count;
								?>
								<span class="min-cart-count"></span>
							</div>
							<?php
						endif;
					} ?>
				</div>
			</div>
		</nav>
	</div>

</header>