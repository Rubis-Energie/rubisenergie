<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5d31c1d1b958c',
	'title' => 'Flexible content',
	'fields' => array(
		array(
			'key' => 'field_5d31c1ded5632',
			'label' => 'Blocs',
			'name' => 'block',
			'type' => 'flexible_content',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layouts' => array(
				'layout_5d31c3afd563c' => array(
					'key' => 'layout_5d31c3afd563c',
					'name' => 'block.slider',
					'label' => 'Bloc Diaporama',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_5d31c3ddd563d',
							'label' => 'Champs',
							'name' => 'fields',
							'type' => 'clone',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'clone' => array(
								0 => 'group_5d31bdad50cab',
							),
							'display' => 'group',
							'layout' => 'block',
							'prefix_label' => 0,
							'prefix_name' => 1,
						),
					),
					'min' => '',
					'max' => '',
				),
				'layout_5d31c468d5642' => array(
					'key' => 'layout_5d31c468d5642',
					'name' => 'block.text',
					'label' => 'Bloc Texte',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_5d31c477d5643',
							'label' => 'Champs',
							'name' => 'fields',
							'type' => 'clone',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'clone' => array(
								0 => 'group_5d31834002ac5',
							),
							'display' => 'group',
							'layout' => 'block',
							'prefix_label' => 0,
							'prefix_name' => 1,
						),
					),
					'min' => '',
					'max' => '',
				),
				'layout_5d31c5e6d5648' => array(
					'key' => 'layout_5d31c5e6d5648',
					'name' => 'block.two.columns',
					'label' => 'Bloc 2 Colonnes',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_5d31c609d5649',
							'label' => 'Champs',
							'name' => 'fields',
							'type' => 'clone',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'clone' => array(
								0 => 'group_5d318c2768540',
							),
							'display' => 'group',
							'layout' => 'block',
							'prefix_label' => 0,
							'prefix_name' => 1,
						),
					),
					'min' => '',
					'max' => '',
				),
				'layout_604f6e15582fd' => array(
					'key' => 'layout_604f6e15582fd',
					'name' => 'block.three.columns',
					'label' => 'Bloc 3 Colonnes',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_604f6e39582fe',
							'label' => 'Champs',
							'name' => 'fields',
							'type' => 'clone',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'clone' => array(
								0 => 'group_604f667c184ee',
							),
							'display' => 'group',
							'layout' => 'block',
							'prefix_label' => 0,
							'prefix_name' => 1,
						),
					),
					'min' => '',
					'max' => '',
				),
				'layout_604f70476ed1c' => array(
					'key' => 'layout_604f70476ed1c',
					'name' => 'block.form',
					'label' => 'Bloc Formulaire',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_604f70506ed1d',
							'label' => 'Champs',
							'name' => 'fields',
							'type' => 'clone',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'clone' => array(
								0 => 'group_604f6f9d27f07',
							),
							'display' => 'group',
							'layout' => 'block',
							'prefix_label' => 0,
							'prefix_name' => 1,
						),
					),
					'min' => '',
					'max' => '1',
				),
				'layout_60dac3f4cfe44' => array(
					'key' => 'layout_60dac3f4cfe44',
					'name' => 'block.actus',
					'label' => 'Bloc actualités',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_60dac406cfe45',
							'label' => 'Champs',
							'name' => 'fields',
							'type' => 'clone',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'clone' => array(
								0 => 'group_60dac2cebf512',
							),
							'display' => 'group',
							'layout' => 'block',
							'prefix_label' => 0,
							'prefix_name' => 1,
						),
					),
					'min' => '',
					'max' => '',
				),
			),
			'button_label' => 'Ajouter un élément',
			'min' => '',
			'max' => '',
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
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'default',
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
	'hide_on_screen' => array(
		0 => 'the_content',
	),
	'active' => true,
	'description' => '',
));

endif;
