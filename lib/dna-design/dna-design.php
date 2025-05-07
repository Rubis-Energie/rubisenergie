<?php
/*
Plugin Name: @RubisEnergie - Design
Description: Content Parts - Captcha - Messages /// Cleaned
Author: Agence AND Digital
Version: 2.0
Author URI: https://www.and-digital.fr/
*


/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @since 1.0
 */
class Dna_Theme_Load {

	/**
	 * PHP5 constructor method.
	 *
	 * @since 1.0
	 */
	function __construct() {

		/* Defines constants */
		self::define_constants();

		/* Include common function file. */
		add_action( 'plugins_loaded', array( &$this, 'dna_includes' ), 1 );
		
		/* Include acf fields. */
		add_action( 'plugins_loaded', array( &$this, 'dna_include_acf_fields' ), 3 );

		/* Load the admin files. */
		add_action( 'plugins_loaded', array( &$this, 'dna_admin' ), 20 );

		/* Load the admin files. */
        add_action( 'plugins_loaded', array( &$this, 'dna_frontend' ), 30 );
	}

	/**
	 * Defines constants used by the plugin.
	 *
	* @since 1.0
	 */
	static public function define_constants() {

		defined('DNA_THEME_VERSION')
			|| define('DNA_THEME_VERSION', '1.0');

		defined('DNA_THEME_PLUGIN_NAME')
			|| define('DNA_THEME_PLUGIN_NAME', basename(dirname(__FILE__)));

		defined('DNA_THEME_PLUGIN_BASENAME')
			|| define('DNA_THEME_PLUGIN_BASENAME', DNA_THEME_PLUGIN_NAME . '/' . basename(__FILE__));

		defined('DNA_THEME_PLUGIN_DIR')
			|| define('DNA_THEME_PLUGIN_DIR', untrailingslashit(plugin_dir_path(__FILE__)));

		defined('DNA_THEME_PLUGIN_URL')
			|| define('DNA_THEME_PLUGIN_URL', untrailingslashit(plugins_url(DNA_THEME_PLUGIN_NAME)));

		defined('DNA_THEME_INCLUDES_DIR')
			|| define('DNA_THEME_INCLUDES_DIR', DNA_THEME_PLUGIN_DIR . '/includes');

		defined('DNA_THEME_CLASSES_DIR')
			|| define('DNA_THEME_CLASSES_DIR', DNA_THEME_INCLUDES_DIR . '/classes');

		defined('DNA_THEME_ADMIN_DIR')
			|| define('DNA_THEME_ADMIN_DIR', DNA_THEME_PLUGIN_DIR . '/admin');

		defined('DNA_THEME_ADMIN_URL')
			|| define('DNA_THEME_ADMIN_URL', DNA_THEME_PLUGIN_URL . '/admin');

		defined('DNA_THEME_ADMIN_INCLUDES_DIR')
			|| define('DNA_THEME_ADMIN_INCLUDES_DIR', DNA_THEME_ADMIN_DIR . '/includes');

		defined('DNA_THEME_FRONTEND_DIR')
            || define('DNA_THEME_FRONTEND_DIR', DNA_THEME_PLUGIN_DIR . '/frontend');
	}


	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since 1.0
	 */
	function dna_includes() {

		/* Load the plugin functions file. */
		require_once( DNA_THEME_INCLUDES_DIR . '/common.php' );
	}

	/**
	 * Loads the admin functions and files.
	 *
	 * @since 1.0
	 */
	function dna_admin() {
		/* Load the main admin file. */
		require_once( DNA_THEME_ADMIN_DIR . '/class-dna-admin.php' );
	}

	/**
	 * Loads the initial files ACF Fields.
	 *
	 * @since 1.0
	 */
	function dna_include_acf_fields() {
		require_once( DNA_THEME_INCLUDES_DIR . '/acf-fields/fields.php' );
	}

	/**
     * Include Frontend Class
     *
     * @since 1.0
     */
    public function dna_frontend() {

        /* Only load files if in the WordPress frontend. */
        if ( !is_admin() ) {
            global $class_theme_display;
            /* Load the main settings file. */
            require_once( DNA_THEME_FRONTEND_DIR . '/class-dna-frontend.php' );
            /* Load Walker If Needed */
            $class_theme_display = new Dna_Theme_Frontend();
        }
    }
}

$dna_theme_load = new Dna_Theme_Load();
