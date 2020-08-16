<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function my_theme_enqueue_styles() {

    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
// Register Custom Post Type
function add_cpt_company() {

    $args =        array(
        'labels' => array(
            'name' => __('Empresas'),
            'singular_name' => __('Empresa'),
            'add_new_item' => 'Añadir nueva Empresa',
            'edit_item' => 'Editar Empresa',
            'new_item' => 'Nueva Empresa',
            'search_items' => 'Buscar Empresas',
            'not_found' => 'No econtrado',
            'not_found_in_trash' => 'No encontrado en la basura',
            'all_items' => __('Todas las Empresas'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'cpt-company'),
    );
    register_post_type( 'cpt_company', $args );

}
add_action( 'init', 'add_cpt_company' );