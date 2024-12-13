<?php
/**
 * Admin settings Plugin Init
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

if (!defined('DNA_THEME_VERSION')) exit;

/**
 * @since 1.0
 */
class Dna_Theme_Admin {
	function __construct() {
		/* Admin menu */
		$this->_add_acf_menu_option();
		add_filter( 'upload_mimes', array(&$this,'cc_mime_types'));
		add_action( 'do_meta_boxes', array( &$this, 'change_meta_boxes' ) );

		add_filter( 'mce_buttons', array( &$this, 'wptexlnk_add_tinymce_button'));
		add_filter( 'mce_external_plugins', array( &$this, 'wptexlnk_register_tinymce_js'));
	}

	protected function _add_acf_menu_option() {
	}

	public function cc_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
  		return $mimes;
	}

	function change_meta_boxes() {
    	// remove_meta_box( 'postimagediv', 'page', 'side' );
    	remove_meta_box( 'postexcerpt', 'page', 'normal' );
    	//remove_meta_box( 'slugdiv', 'page', 'normal' );
    	remove_meta_box( 'authordiv', 'page', 'normal' );
	}

	public function  wptexlnk_add_tinymce_button($buttons) {
		array_push($buttons, 'wptp_extend_link_tinymce');
		return $buttons;
	}
	public function  wptexlnk_register_tinymce_js($plugin_array) {
		$plugin_array['wptp_extend_link_tinymce'] = DNA_THEME_ADMIN_URL.'/js/extend-link-tinymce.js';
		return $plugin_array;
	}
}

new Dna_Theme_Admin();
