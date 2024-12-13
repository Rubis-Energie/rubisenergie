<?php
/**
 * Admin settings Plugin Init
 *
 * @package WordPress
 * @subpackage Rubis
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

if (!defined('DNA_RUBIS_VERSION')) exit;

/**
 * @since 1.0
 */
class Dna_Rubis_Admin {
	function __construct() {
		/* Admin menu */
		$this->_add_acf_menu_option();

		add_action('do_meta_boxes', array(&$this,'do_meta_boxes'));
	}

	protected function _add_acf_menu_option() {
		acf_add_options_page(array(
			'page_title' 	=> __('En-tête'),
			'menu_title'	=> __('En-tête'),
			'menu_slug' 	=> 'header-settings_option_lang',
			'capability'	=> 'manage_categories',
			'parent_slug'	=> 'theme-general-settings',
			'update_button'		=> __('Mise à jour', 'dna'),
			'updated_message'	=> __("Options mises à jour", 'dna'),
		));
		acf_add_options_page(array(
			'page_title' 	=> __('Pied de page'),
			'menu_title'	=> __('Pied de page'),
			'menu_slug' 	=> 'footer-settings_option_lang',
			'capability'	=> 'manage_categories',
			'parent_slug'	=> 'theme-general-settings',
			'update_button'		=> __('Mise à jour', 'dna'),
			'updated_message'	=> __("Options mises à jour", 'dna'),
		));
		acf_add_options_page(array(
			'page_title' 	=> __('Google configuration'),
			'menu_title'	=> __('Google configuration'),
			'menu_slug' 	=> 'google_config-settings',
			'capability'	=> 'manage_categories',
			'parent_slug'	=> 'theme-general-settings',
			'update_button'		=> __('Mise à jour', 'dna'),
			'updated_message'	=> __("Options mises à jour", 'dna'),
		));
		acf_add_options_page(array(
			'page_title' 	=> __('Réseaux sociaux configuration'),
			'menu_title'	=> __('Réseaux sociaux configuration'),
			'menu_slug' 	=> 'social_config-settings',
			'capability'	=> 'manage_categories',
			'parent_slug'	=> 'theme-general-settings',
			'update_button'		=> __('Mise à jour', 'dna'),
			'updated_message'	=> __("Options mises à jour", 'dna'),
		));
		acf_add_options_page(array(
			'page_title' 	=> __('Bloc carte'),
			'menu_title'	=> __('Bloc carte'),
			'menu_slug' 	=> 'block-map_option_lang',
			'capability'	=> 'manage_categories',
			'parent_slug'	=> 'theme-general-settings',
			'update_button'		=> __('Mise à jour', 'dna'),
			'updated_message'	=> __("Options mises à jour", 'dna'),
		));
		acf_add_options_page(array(
			'page_title' 	=> __('Bloc produit'),
			'menu_title'	=> __('Bloc produit'),
			'menu_slug' 	=> 'block-product_option_lang',
			'capability'	=> 'manage_categories',
			'parent_slug'	=> 'theme-general-settings',
			'update_button'		=> __('Mise à jour', 'dna'),
			'updated_message'	=> __("Options mises à jour", 'dna'),
		));

	}

	public function do_meta_boxes() {
		// remove_meta_box( 'postimagediv','page','side' );

		//remove_meta_box( 'slugdiv','page','normal' );
		remove_meta_box( 'authordiv','page','normal' );
		//remove_meta_box( 'slugdiv','post','normal' );
	}
}

new Dna_Rubis_Admin();
