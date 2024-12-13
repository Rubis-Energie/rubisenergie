<?php
/**
 * Theme Class Base
 *
 * @package WordPress
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

require_once (FUNCTIONS_PATH . 'class.admin.php'); // Edit login screen
require_once (FUNCTIONS_PATH . 'theme.functions.php'); // Include theme functions

/*================================================================================== */
/* Global Theme Base =============================================================== */
class themeBase {

	public function init() {
		/**
		 *  LANGUAGE & LOCALIZATION / SECURE KEY
		*/
		//load the text domain for localization
		add_action('after_setup_theme', array(&$this,'setupTheme'));

		/*
		 * SCRIPTS
		*/
		add_action( 'wp_enqueue_scripts', array(&$this,'enqueueScripts'));

		/**
		 *  IMAGES
		*/
		// post thumbnail support
		add_theme_support( 'post-thumbnails' );
		// Remove p tags on images
		add_filter('the_content', array(&$this,'filterPtagsOnImages'));

		/**
		 *  WIDGETS
		*/
		// Unregister default widgets
		add_action('widgets_init', array(&$this,'unregisterDefaultWidgets'));

		/**
		 * EXCERPT LENGTH
		 */
		add_filter('excerpt_length', array(&$this,'onioExcerptLength'));
		add_filter('excerpt_more', array(&$this,'onioExcerptMore'));
	}

	/**
	 *  Setup Theme
	*/
	function setupTheme() {
		/* Langs */
		$lang_dir = get_template_directory() . '/languages';
		load_theme_textdomain('onio', $lang_dir);
		add_theme_support( 'html5', array(
			'gallery', 'caption'
		) );
	}

	/*
     * SCRIPTS
    */
	function enqueueScripts() {
        wp_deregister_script('jquery');
        wp_deregister_script( 'wp-embed' );

        if (!is_admin()) {

        	// wp_enqueue_script('jstheme', get_home_url().'/assets' . '/js/libraries/modernizr.js', false, null, true);
         	// wp_localize_script( 'jstheme', 'onioVars', array());
        }
	}

	/**
	 *  IMAGES
	*/
	function filterPtagsOnImages($content){
		return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	}

	/**
	 *  WIDGETS
	*/
	// Unregister default widgets
	function unregisterDefaultWidgets() {
		unregister_widget('WP_Widget_Pages');
		unregister_widget('WP_Widget_Calendar');
		unregister_widget('WP_Widget_Archives');
		unregister_widget('WP_Widget_Links');
		unregister_widget('WP_Widget_Meta');
		unregister_widget('WP_Widget_Categories');
		unregister_widget('WP_Widget_Recent_Posts');
		unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Tag_Cloud');
	}

	/**
	 * Adding class to nav menu
	 */
	function addMarkupMenu($output) {
		$output= preg_replace('/menu-item /', 'first-menu-item menu-item', $output, 1);
		$output= substr_replace($output, "last-menu-item menu-item", strripos($output, "menu-item"), strlen("menu-item"));
		return $output;
	}

	/**
	 * This removes the annoying […] to a Read More link
	 */
	function onioExcerptMore($more) {
		return '...';
	}

	/**
	 * Set new length for excerpt
	 */
	function onioExcerptLength($length) {
		return 20;
	}

}