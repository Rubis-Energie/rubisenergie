<?php

// Create Group
acf_add_local_field_group(array(
	'key' => 'group_56265e5239221',
	'title' => __('Liaisons Pages - Fonctions'),
	'fields' => array(
		array(
			'key' => 'field_56265e814edeb',
			'label' => __('Liaisons'),
			'name' => 'pages_relationship',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'min' => '',
			'max' => '',
			'layout' => 'row',
			'button_label' => __('Ajouter une liaison'),
			'sub_fields' => array(
				array(
					'key' => 'field_56265ea64edec',
					'label' => __('Page'),
					'name' => 'page',
					'type' => 'post_object',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => array(
						'page'
					),
					'taxonomy' => array(
					),
					'allow_null' => 0,
					'multiple' => 0,
					'return_format' => 'id',
					'ui' => 1,
				),
				array(
					'key' => 'field_56265ecd4eded',
					'label' => __('Relation'),
					'name' => 'relationship_base_field',
					'type' => 'select',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(),
					'default_value' => array(
					),
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'placeholder' => '',
					'disabled' => 0,
					'readonly' => 0,
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'page-relation-settings',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));