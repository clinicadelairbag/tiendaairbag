<?php

namespace DgoraWcas\Integrations\Themes\Storefront;


class Storefront
{

    private $themeSlug = 'storefront';

    private $themeName = 'Storefront';

    public function __construct()
    {
        $this->overwriteFunctions();

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
            'name'  => 'storefront_settings_head',
            'label' => __('Storefront theme', 'ajax-search-for-woocommerce'),
            'type'  => 'head',
            'class' => 'dgwt-wcas-sgs-header'
        );

        $settings[$key][] = array(
            'name'    => 'storefront_replace_search',
            'label'   => __('Replace search form', 'ajax-search-for-woocommerce'),
            'desc'    => __('Replace the Storefront theme\'s default product search with the Ajax Search for WooCommerce form.',
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

        if (DGWT_WCAS()->settings->get_opt('storefront_replace_search', 'off') === 'on') {
            $canIntegrate = true;
        }

        return $canIntegrate;
    }

    /**
     * Overwrite funtions
     *
     * @return void
     */
    private function overwriteFunctions()
    {
        if ($this->canReplaceSearch()) {
            require_once DGWT_WCAS_DIR . 'partials/themes/storefront.php';
        }
    }


}