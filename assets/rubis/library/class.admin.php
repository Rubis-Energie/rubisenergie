<?php
/**
 * Theme Class Login
 *
 * @package WordPress
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

class themeLogin {

	public function init() {
		// Change CSS
		add_action('login_enqueue_scripts', array(&$this,'customCss'), 10);
		// Change logo link title
		add_action('login_headertext', array(&$this,'changeUrlTitle'));
		// Change login link URL
		add_filter( 'login_headerurl', array(&$this, 'changeLoginUrl'));
		// Custom Backend Footer
		add_filter( 'admin_footer_text', array(&$this, 'changeAdminFooter'));
		// Add TinyMce Buttons
		if(is_admin() && current_user_can('edit_posts') &&  current_user_can('edit_pages')) {
			add_action('admin_head', array(&$this, 'initCustomButtons'));
			add_shortcode("br", array(&$this, 'brDisplay'));
		}
		/* Admin Styles */
		add_action('admin_enqueue_scripts', array( &$this, 'themeAdminEnqueueSyles' ) );
	}
	/************* CUSTOM LOGIN PAGE *****************/

	// calling your own login css so you can style it

	//Updated to proper 'enqueue' method
	function customCss() {
		wp_enqueue_style( 'theme_login_css', get_template_directory_uri() . '/library/admin/css/login.css', false );
	}
	// changing the logo link from wordpress.org to your site
	function changeUrlTitle() { return get_option( 'blogname' ); }
	// changing login link URL
	function changeLoginUrl() {  return home_url(); }

	/************* CUSTOMIZE ADMIN *******************/
	// Custom Backend Footer
	function changeAdminFooter() {
		echo 'Créé par <a href="https://www.and-digital.fr/" target="_blank">And Digital</a>';
	}

	/************* TinyMce Buttons *******************/
	// Init call
	function initCustomButtons() {
		add_filter('mce_external_plugins', array(&$this, 'addCustomButtons'));
		add_filter('mce_buttons', array(&$this, 'registerCustomButtons'));
	}
	// Add buttons JS
	function addCustomButtons($plugin_array) {
		$plugin_array['br'] = get_bloginfo('template_url') . '/library/helpers/mcebutton/br/button.js';
		return $plugin_array;
	}
	// Register buttons
	function registerCustomButtons($buttons) {
		array_push($buttons, "br");
		return $buttons;
	}
	// Display code
	function brDisplay($atts, $content = null) {
		return '<br />';
	}

	/**
	 * Loads the admin CSS files
	 */
	/* Admin Styles */
	function themeAdminEnqueueSyles() {
		wp_enqueue_style('admin-theme-extra', get_template_directory_uri() . '/library/admin/css/extra.css', false);
	}

}