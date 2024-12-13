<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_60d9cc36bf2db',
	'title' => 'Affichage blocs produit et map',
	'fields' => array(
		array(
			'key' => 'field_60d9cc3911a1c',
			'label' => 'Afficher le bloc produit ?',
			'name' => 'is_block_prd',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_60d9cc5011a1d',
			'label' => 'Afficher le bloc map ?',
			'name' => 'is_block_map',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
			array(
				'param' => 'page_template',
				'operator' => '!=',
				'value' => 'front-page.php',
			),
		),
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'products',
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
