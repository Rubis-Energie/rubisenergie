<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_60dac2cebf512',
	'title' => 'Bloc actualités',
	'fields' => array(
		array(
			'key' => 'field_60dac2d72dc34',
			'label' => 'Titre',
			'name' => 'title',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_60dac2df2dc35',
			'label' => 'Lien',
			'name' => 'link',
			'type' => 'link',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
		),
		array(
			'key' => 'field_60dac2e52dc36',
			'label' => 'Actualités',
			'name' => 'actus',
			'type' => 'post_object',
			'instructions' => '3 max',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'post',
			),
			'taxonomy' => '',
			'allow_null' => 1,
			'multiple' => 1,
			'return_format' => 'object',
			'ui' => 1,
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
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => false,
	'description' => '',
));

endif;
