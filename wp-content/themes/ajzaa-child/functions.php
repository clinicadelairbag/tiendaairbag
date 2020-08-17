<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $parenthandle = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css',
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version') // this only works if you have Version in the style header
    );
}

// Register Custom Post Type
function add_cpt_company()
{

    $args = array(
        'labels'      => array(
            'name'               => __('Empresas'),
            'singular_name'      => __('Empresa'),
            'add_new_item'       => 'Añadir nueva Empresa',
            'edit_item'          => 'Editar Empresa',
            'new_item'           => 'Nueva Empresa',
            'search_items'       => 'Buscar Empresas',
            'not_found'          => 'No econtrado',
            'not_found_in_trash' => 'No encontrado en la basura',
            'all_items'          => __('Todas las Empresas'),
        ),
        'public'      => true,
        'has_archive' => true,
        'rewrite'     => array('slug' => 'cpt-company'),
    );
    register_post_type('cpt_company', $args);

}

add_action('init', 'add_cpt_company');
//Fix Translate
if (function_exists('ajzaa_models_code') && shortcode_exists('ajzaa_models')) {
    remove_shortcode('ajzaa_models');

    function ajzaa_models_code_airbag($atts)
    {
        global $ajzaa_fonts_to_enqueue_array;
        $ajzaa_fonts_to_enqueue_array = array();
        extract(shortcode_atts(array(
            'headings_title'               => '',
            'headings_alignment'           => 'center',
            'ajzaa_heading_font_family'    => '',
            'ajzaa_heading_font_style'     => 'normal',
            'ajzaa_heading_font_weight'    => '400',
            'ajzaa_heading_font_size'      => '',
            'ajzaa_heading_color'          => '#fff',
            'ajzaa_heading_text_transform' => '',
            'ajzaa_heading_line_height'    => '',
            'ajzaa_heading_letter_spacing' => '',
            'ajzaa_button_text'            => 'Search',
        ), $atts));
        $headings_alignment = "text-" . $headings_alignment;
        $custom_header_inline_style = "margin:0;";
        $ajzaa_font_family_heading_to_enqueue = "";
        if ($ajzaa_heading_font_family != '' && $ajzaa_heading_font_family != 'Default') {
            $custom_header_inline_style .= 'font-family:' . esc_attr($ajzaa_heading_font_family) . ';';
            $ajzaa_font_family_heading_to_enqueue .= esc_attr($ajzaa_heading_font_family) . ":";
        }
        if ($ajzaa_heading_font_weight != '') {
            $custom_header_inline_style .= 'font-weight:' . esc_attr($ajzaa_heading_font_weight) . ';';
            $ajzaa_font_family_heading_to_enqueue .= esc_attr($ajzaa_heading_font_weight) . "%7C";
        }
        if ($ajzaa_heading_font_size != '') {
            $custom_header_inline_style .= 'font-size:' . esc_attr($ajzaa_heading_font_size) . 'px;';
        }
        if ($ajzaa_heading_color != '') {
            $custom_header_inline_style .= 'color:' . esc_attr($ajzaa_heading_color) . ';';
        }
        if ($ajzaa_heading_text_transform != '') {
            $custom_header_inline_style .= 'text-transform:' . esc_attr($ajzaa_heading_text_transform) . ';';
        }
        if ($ajzaa_heading_line_height != '') {
            $custom_header_inline_style .= 'line-height:' . esc_attr($ajzaa_heading_line_height) . 'px;';
        }
        if ($ajzaa_heading_letter_spacing != '') {
            $custom_header_inline_style .= 'letter-spacing:' . esc_attr($ajzaa_heading_letter_spacing) . 'px;';
        }
        ob_start();
        $product_tax_parents = get_terms(array(
            'taxonomy'   => 'product_tax',
            'hide_empty' => false,
            'parent'     => 0
        ));
        ?>
        <script>
            jQuery(document).ready(function ($) {

                var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
                $('.brands_form #marques').on('select2:select', function (e) {
                    $('.brands_form .keyword').append("<span style='color: black' class='fa fa-spinner fa-spin'></span>");
                    $('.brands_form .brands .select2-selection__arrow').hide();
                    var brands = $('.brands_form #marques').find(':selected').data('id');
                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: {
                            action: "ajzaa_products_model",
                            brands: brands
                        },
                        success: function (data) {
                            $('.brands_form #models').html(data);
                            $(".keyword .fa-spinner").remove();
                            $('.brands_form .brands .select2-selection__arrow').show();
                            $('#models').select2('open');
                        },
                        error: function (errorThrown) {
                            alert(errorThrown);
                        }
                    });
                });
                $('.brands_form #models').on('select2:select', function (e) {
                    $('.brands_form .year').append("<span style='color: black' class='fa fa-spinner fa-spin'></span>");
                    $('.brands_form .keyword .select2-selection__arrow').hide();
                    var years = $('.brands_form #models').find(':selected').data('id');
                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: {
                            action: "ajzaa_products_years",
                            years: years
                        },
                        success: function (data) {
                            $('.brands_form #year').html(data);
                            $(".year .fa-spinner").remove();
                            $('.brands_form .keyword .select2-selection__arrow').show();
                            $('#year').select2('open');
                        },
                        error: function (errorThrown) {
                            alert(errorThrown);
                        }
                    });
                });

            });
        </script>
        <div class="brands_header <?php echo $headings_alignment ?>">
            <h2 style="<?php echo esc_attr($custom_header_inline_style) ?>"><?php echo $headings_title ?></h2>
        </div>
        <div class="brands_form">
            <form method="post">
                <ul class="inline-list">
                    <li class="brands">
                        <select name="marques" id="marques">
                            <option value='-1' disabled selected><span>1</span>
                                |<?php echo esc_html__('Seleccionar Marca...', 'ajzaa') ?></option>
                            <?php
                            foreach ($product_tax_parents as $parent) {
                                ?>
                                <option value="<?php echo $parent->slug ?>" data-id="<?php echo $parent->term_id ?>">
                                    <?php
                                    echo $parent->name;
                                    /*if ($parent->count > 0){
                                                      echo "(" . $parent->count .")";
                                                  }*/ ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>

                    </li>
                    <li class="keyword">
                        <select id="models">
                            <option value='-1' disabled selected>2
                                <span>|</span><?php echo esc_html__('Seleccionar Modelo...', 'ajzaa') ?></option>
                        </select>
                    </li>
                    <li class="year">
                        <select id="year">
                            <option value='-1' disabled selected>3
                                <span>|</span><?php echo esc_html__('Seleccionar Año...', 'ajzaa') ?></option>
                        </select>
                    </li>
                    <li class="search">
                        <input type="button" class="button models-btn-submit"
                               value="<?php echo esc_attr__("Buscar", 'ajzaa') ?>">
                    </li>
                </ul>
            </form>
        </div>
        <a style="text-align: center; color: #fff; padding-top: 18px; display: flow-root; font-size: 15px;"
           href="#search-by-brand"></a>
        <?php
        return ob_get_clean();
    }

    add_shortcode('ajzaa_models', 'ajzaa_models_code_airbag');
}


remove_action('wp_ajax_nopriv_ajzaa_products_model', 'ajzaa_products_model');
remove_action('wp_ajax_ajzaa_products_model', 'ajzaa_products_model');

add_action('wp_ajax_nopriv_ajzaa_products_model', 'ajzaa_products_model_airbag');
add_action('wp_ajax_ajzaa_products_model', 'ajzaa_products_model_airbag');
function ajzaa_products_model_airbag()
{
    // do what you want with the variables passed through here
    if (isset($_REQUEST['brands'])):
        $model_id = $_REQUEST['brands'];
    endif;
    $product_tax_childes = get_terms(array('taxonomy'   => 'product_tax',
                                           'hide_empty' => false,
                                           'parent'     => $model_id));
    foreach ($product_tax_childes as $tax_childe) {
        $option .= '<option value="' . esc_attr($tax_childe->slug) . '" data-id="' . esc_attr($tax_childe->term_id) . '">';
        $option .= $tax_childe->name;
        if ($tax_childe->count > 0):
            $option .= ' (' . esc_attr($tax_childe->count) . ')';
        endif;
        $option .= '</option>';
    }
    echo '<option value="" disabled selected="selected">' . esc_html__("Modelos", 'ajzaa') . '</option>' . $option;
    wp_die();
}


remove_action('wp_ajax_nopriv_ajzaa_products_years', 'ajzaa_products_years');
remove_action('wp_ajax_ajzaa_products_years', 'ajzaa_products_years');

add_action('wp_ajax_nopriv_ajzaa_products_years', 'ajzaa_products_years_airbag');
add_action('wp_ajax_ajzaa_products_years', 'ajzaa_products_years_airbag');
function ajzaa_products_years_airbag()
{
    // do what you want with the variables passed through here
    if (isset($_REQUEST['years'])):
        $keyword_id = $_REQUEST['years'];
    endif;
    $product_model_childes = get_terms(array('taxonomy'   => 'product_tax',
                                             'hide_empty' => false,
                                             'parent'     => $keyword_id));
    $option = '';
    foreach ($product_model_childes as $model_childe) {
        $option .= '<option value="' . esc_attr($model_childe->slug) . '" data-id="' . esc_attr($model_childe->term_id) . '">';
        $option .= $model_childe->name;
        if ($model_childe->count > 0):
            $option .= ' (' . esc_html($model_childe->count) . ')';
        endif;
        $option .= '</option>';
    }
    echo '<option value="" disabled selected="selected">' . esc_html__("Años", 'ajzaa') . '</option>' . $option;
    wp_die();
}

add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {

    $tabs['description']['title'] = __( 'Descripción' );		// Rename the description tab
    $tabs['additional_information']['title'] = __( 'Información Adiccional' );	// Rename the additional information tab

    return $tabs;

}

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5f398e8dbdde9',
        'title' => 'Page Airbag Settings',
        'fields' => array(
            array(
                'key' => 'field_5f398eadaabde',
                'label' => 'Color del Titulo',
                'name' => 'title_color',
                'type' => 'color_picker',
                'instructions' => 'Color para el titulo de la Pagina',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '#ffa500',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

endif;

add_filter('woocommerce_product_single_add_to_cart_text','change_text_add_cart');
function change_text_add_cart($attr){
    if ('Add to cart'==$attr){
        return 'Añadir al carrito';
    }
    return $attr;
}

