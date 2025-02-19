<?php
/**
 * Theme functions and definitions
 *
 * @package WordPress
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

/*================================================================================== */
/* Global Theme Init =============================================================== */

/**
 * Constants Definitions
 **/
define('PATH', STYLESHEETPATH);
define('FUNCTIONS_PATH', PATH . '/library/');
define('HELPER_PATH', PATH . '/library/helpers/');
define('HELPER_URI', get_template_directory_uri().'/library/helpers/');

header("X-Frame-Options: SAMEORIGIN");

/**
 * Requires
 */
require_once (FUNCTIONS_PATH . 'class.base.php');

/**
 * Inits
 */
$themeBase = new themeBase();
$themeLogin = new themeLogin();

/**
 * Launch theme
 */
$themeBase->init();
$themeLogin->init();

add_filter( 'use_block_editor_for_post', '__return_false' );

function my_acf_init() {

	acf_update_setting('google_api_key', 'AIzaSyCLUTObxnvi2VJDnOhxjhR7Q1ourz1Mv98');
}

add_action('acf/init', 'my_acf_init');


register_nav_menus(
	array(
		'main-menu' => esc_html__( 'Menu Header', 'rubisenergie' ),
		'sup-menu' => esc_html__( 'Sur Menu Header', 'rubisenergie' ),
	)
);