<?php

namespace DgoraWcas\Integrations\Themes\Flatsome;


class Flatsome
{

    private $themeSlug = 'flatsome';

    private $themeName = 'Flatsome';

    public function __construct()
    {
        $this->markSearchForm();

        add_filter('dgwt/wcas/settings/sections', array($this, 'registerSettingsSection'));

        add_filter('dgwt/wcas/settings', array($this, 'registerSettings'));
    }

    /**
     * Add settings section
     *
     * @param array $sections
     *
     * @return array
     */
    public function registerSettingsSection($sections)
    {

        $sections[7] = array(
            'id'    => 'dgwt_wcas_theme_' . $this->themeSlug,
            'title' => sprintf(_x('%s theme', 'name of a theme', 'ajax-search-for-woocommerce'), $this->themeName)
        );

        return $sections;
    }

    /**
     * Add settings
     *
     * @param array $settings
     *
     * @return array
     */
    public function registerSettings($settings)
    {
        $key = 'dgwt_wcas_theme_' . $this->themeSlug;

        $settings[$key][] = array(
            'name'  => $this->themeSlug . '_settings_head',
            'label' => __('Flatsome theme', 'ajax-search-for-woocommerce'),
            'type'  => 'head',
            'class' => 'dgwt-wcas-sgs-header'
        );

        $settings[$key][] = array(
            'name'    => $this->themeSlug . '_replace_search',
            'label'   => __('Replace search form', 'ajax-search-for-woocommerce'),
            'desc'    => __('Replace the Flatsome theme\'s default product search with the Ajax Search for WooCommerce form.',
                'ajax-search-for-woocommerce'),
            'type'    => 'checkbox',
            'default' => 'off',
        );

        return $settings;
    }

    /**
     * Check if can replace the native Storefront search form
     * by the Ajax Search for WooCommerce form.
     *
     * @return bool
     */
    private function canReplaceSearch()
    {
        $canIntegrate = false;

        if (DGWT_WCAS()->settings->get_opt($this->themeSlug . '_replace_search', 'off') === 'on') {
            $canIntegrate = true;
        }

        return $canIntegrate;
    }

    /**
     * Mark the native search form to replace
     *
     * @return void
     */
    private function markSearchForm()
    {
        if ($this->canReplaceSearch()) {

            $this->applyCSS();
            $this->applyJS();

            add_filter('body_class', function($classes){
                $classes[] = 'dgwt-wcas-theme-flatsome';
                return $classes;
            });

            add_action('wp_footer', function () {
                echo '<div class="js-dgwt-wcas-flatsome-search-replace" style="display: none">';
                echo do_shortcode('[wcas-search-form]');
                echo '</div>';
            }, 1);

            // Change mobile breakpoint from 992 to 850
            add_filter('dgwt/wcas/scripts/mobile_breakpoint', function () {
                return 850;
            });

            // Change overlay wrapper from body do .mfp-wrap .sidebar-menu
            add_filter('dgwt/wcas/scripts/mobile_overlay_wrapper', function () {
                return '.mfp-wrap .sidebar-menu';
            });


        }
    }


    /**
     * Apply custom CSS
     *
     * @return void
     */
    private function applyCSS()
    {

        add_action('wp_head', function () {
            ?>
            <style>
                .dgwt-wcas-flatsome-up {
                    margin-top: -40vh;
                }

                #search-lightbox .dgwt-wcas-sf-wrapp input[type=search].dgwt-wcas-search-input {
                    height: 60px;
                    font-size: 20px;
                }

                #search-lightbox .dgwt-wcas-search-wrapp {
                    -webkit-transition: all 100ms ease-in-out;
                    -moz-transition: all 100ms ease-in-out;
                    -ms-transition: all 100ms ease-in-out;
                    -o-transition: all 100ms ease-in-out;
                    transition: all 100ms ease-in-out;
                }

                .dgwt-wcas-overlay-mobile-on .mfp-wrap .mfp-content {
                    width: 100vw;
                }

                .dgwt-wcas-overlay-mobile-on .mfp-close,
                .dgwt-wcas-overlay-mobile-on .nav-sidebar {
                    display: none;
                }

                .dgwt-wcas-overlay-mobile-on .main-menu-overlay {
                    display: none;
                }

                .dgwt-wcas-open .header-search .nav-dropdown {
                    opacity: 1;
                    max-height: inherit;
                    left: -15px;
                }

                .dgwt-wcas-open:not(.dgwt-wcas-theme-flatsome-dd-sc) .nav-right .header-search .nav-dropdown {
                    left: auto;
                    right: -15px;
                }
                .dgwt-wcas-theme-flatsome .nav-dropdown .dgwt-wcas-search-wrapp{
                    min-width: 450px;
                }

            </style>
            <?php
        });

    }

    /**
     * Apply custom JS
     *
     * @return void
     */
    private function applyJS()
    {

        add_action('wp_footer', function () {

            $minChars = DGWT_WCAS()->settings->get_opt('min_chars');
            if (empty($minChars) || ! is_numeric($minChars)) {
                $minChars = 3;
            }

            ?>
            <script>
                (function ($) {

                    $(document).ready(function () {

                        // Dropdown mode
                        if ($('.header-search-dropdown') && jQuery(window).width() > 850) {
                            $('.js-dgwt-wcas-flatsome-search-replace .dgwt-wcas-search-wrapp').appendTo('.header-search-dropdown .searchform-wrapper');
                            $('.js-dgwt-wcas-flatsome-search-replace').remove();
                            $('.header-search-dropdown .searchform').remove();


                            var lastMargin = '';
                            var el;

                            $(document).on('mouseenter', '.header-search-dropdown .dgwt-wcas-search-wrapp', function(){

                                var that = this;
                                setTimeout(function() {
                                    el = jQuery(that).closest('.nav-dropdown');
                                    var ml = el.css('margin-left');

                                    if(ml !== '0px'){
                                        lastMargin = ml;
                                        jQuery('body').addClass('dgwt-wcas-theme-flatsome-dd-sc');
                                    }

                                }, 10);
                            });

                            var time = setInterval(function() {

                                if(
                                    $('body').hasClass('dgwt-wcas-open')
                                    && $('body').hasClass('dgwt-wcas-theme-flatsome-dd-sc')
                                    && typeof el !== 'undefined'
                                    && lastMargin !== '0px'
                                    && lastMargin != ''
                                ){
                                    el.css({'margin-left': lastMargin});
                                }
                            }, 15);

                        }

                        // Lightbox mode
                        if ($('#search-lightbox .searchform-wrapper') && jQuery(window).width() > 850) {
                            $('.js-dgwt-wcas-flatsome-search-replace .dgwt-wcas-search-wrapp').appendTo('#search-lightbox .searchform-wrapper');
                            $('.js-dgwt-wcas-flatsome-search-replace').remove();

                            $('#search-lightbox .searchform-wrapper .searchform').remove();
                            $('#search-lightbox').removeClass('dark');

                            if ($('#search-lightbox .search-form-categories')) {
                                $('#search-lightbox .search-form-categories').remove();
                            }

                        }

                        if ($('.mobile-sidebar .searchform-wrapper') && jQuery(window).width() <= 850) {
                            $('.mobile-sidebar .searchform').remove();
                            $('.js-dgwt-wcas-flatsome-search-replace .dgwt-wcas-search-wrapp').appendTo('.mobile-sidebar .searchform-wrapper');
                            $('.js-dgwt-wcas-flatsome-search-replace').remove();

                        }

                        $(document).on('keyup', '#search-lightbox .dgwt-wcas-search-wrapp .dgwt-wcas-search-input', function () {
                            if (this.value.length >= <?php echo $minChars; ?>) {
                                $(this).closest('.dgwt-wcas-search-wrapp').addClass('dgwt-wcas-flatsome-up')
                            }
                        });

                        $(document).on('click', '.header-search-lightbox .header-button a', function () {

                            var formWrapper = $('#search-lightbox').find('.dgwt-wcas-search-wrapp');
                            setTimeout(function () {
                                if (formWrapper.find('.dgwt-wcas-close')[0]) {
                                    formWrapper.find('.dgwt-wcas-close')[0].click();
                                }

                                formWrapper.removeClass('dgwt-wcas-flatsome-up');
                                formWrapper.find('.dgwt-wcas-search-input').focus();
                            }, 1);

                        });
                    });

                })(jQuery);

            </script>
            <?php
        }, 1000);

    }

}