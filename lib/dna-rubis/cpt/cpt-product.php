<?php 

function product_register_post_types() {
	
    $labels = array (
        'name' => pll__('Produits'),
        'singular_name' => 'Produit',
        'add_new' => 'Ajouter un produit',
        'add_new_item' => 'Ajouter',
        'edit_item' => 'Editer le produit',
        'new_item' => 'Nouveau produit',
        'view_item' => 'Voir le produit',
        'search_items' => 'Recherche',
        'not_found' => 'Aucun produit trouvé',
        'not_found_in_trash' => 'Aucun produit trouvé dans la corbeille',
        'parent_item_colon' => '',
    );

	$args = array(
        'labels' => $labels,
        'description' => '',
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'map_meta_cap' => true,
        'capability_type' => 'post',
        'public' => true,
        'hierarchical' => false,
        'rewrite' =>
        array (
            'slug' => 'produit',
            'with_front' => true,
            'pages' => true,
            'feeds' => false,
        ),
        'has_archive' => 'produit-page',
        'query_var' => true,
        'supports' =>
        array (
            0 => 'title',
            1 => 'editor',
            2 => 'thumbnail',
            3 => 'revisions'
        ),
        'taxonomies' => array(),
        'show_ui' => true,
        'menu_position' => 30,
        'menu_icon' => 'dashicons-block-default',
        'can_export' => true,
        'show_in_nav_menus' => true,
        'show_in_menu' => true,
	);

	register_post_type( 'products', $args );
}
add_action( 'init', 'product_register_post_types' ); 