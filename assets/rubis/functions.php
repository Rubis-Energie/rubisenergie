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

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}
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
		'header-main-menu' => esc_html__( 'Menu principal Header', 'rubisenergie' ),
		'header-sup-menu' => esc_html__( 'Sur Menu Header', 'rubisenergie' ),
		'footer-main-menu' => esc_html__( 'Menu principal Footer', 'rubisenergie' ),
	)
);


function rubis_styles_scripts() {
	// Enqueue main stylesheet
	wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/style.min.css', array(), _S_VERSION );


	// Enqueue custom script
	wp_enqueue_script( 'lib', get_template_directory_uri() . '/assets/js/lib.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/app.min.js', array('lib'), _S_VERSION, true );
}

add_action('wp_enqueue_scripts', 'rubis_styles_scripts');


add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

    return $content;
});


// Contcat Form 7 
add_filter('wpcf7_autop_or_not', '__return_false');