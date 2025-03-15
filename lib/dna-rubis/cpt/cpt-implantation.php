<?php 

function implantation_register_post_types() {
	
    $labels = array (
        'name' => pll__('Implantation'),
        'singular_name' => 'implantation',
        'add_new' => 'Ajouter une implantation',
        'add_new_item' => 'Ajouter',
        'edit_item' => 'Editer la implantation',
        'new_item' => 'Nouvelle implantation',
        'view_item' => 'Voir la implantation',
        'search_items' => 'Recherche',
        'not_found' => 'Aucune implantation trouvée',
        'not_found_in_trash' => 'Aucune implantation trouvée dans la corbeille',
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
            'slug' => 'implantation',
            'with_front' => true,
            'pages' => true,
            'feeds' => false,
        ),
        'has_archive' => 'implantation-page',
        'query_var' => true,
        'supports' =>
        array (
            0 => 'title',
            1 => 'editor',
            2 => 'thumbnail',
            3 => 'revisions'
        ),
        'taxonomies' =>
        array (
            0 => 'type',
        ),
        'show_ui' => true,
        'menu_position' => 30,
        'menu_icon' => 'dashicons-block-default',
        'can_export' => true,
        'show_in_nav_menus' => true,
        'show_in_menu' => true,
	);

	register_post_type( 'implantation', $args );
}
add_action( 'init', 'implantation_register_post_types' ); 