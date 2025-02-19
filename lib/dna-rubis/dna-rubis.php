<?php
/*
Plugin Name: @AND - Rubis
Description: Plugin Rubis
Author: Agence AND Digital
Version: 1.0
Author URI: https://www.and-digital.fr/
*


/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @since 1.0
 */
class Dna_Rubis_Load {

	/**
	 * PHP5 constructor method.
	 *
	 * @since 1.0
	 */
	function __construct() {

		/* Defines constants */
		self::define_constants();

		add_filter('acf/load_field/name=relationship_base_field', array( &$this, 'acf_load_relationship_base_field_choices' ));

		/* Include common function file. */
		add_action( 'plugins_loaded', array( &$this, 'dna_includes' ), 1 );

		/* Include acf fields. */
		add_action( 'plugins_loaded', array( &$this, 'dna_include_acf_fields' ), 3 );

		/* Load the admin files. */
		add_action( 'plugins_loaded', array( &$this, 'dna_admin' ), 20 );

		/* Load the admin files. */
        add_action( 'plugins_loaded', array( &$this, 'dna_frontend' ), 30 );

        /* Add Menu To Rubis */
        add_theme_support( 'menus' );

	}

	/**
	 * Defines constants used by the plugin.
	 *
	* @since 1.0
	 */
	static public function define_constants() {

		defined('DNA_RUBIS_VERSION')
			|| define('DNA_RUBIS_VERSION', '1.0');

		defined('DNA_RUBIS_PLUGIN_NAME')
			|| define('DNA_RUBIS_PLUGIN_NAME', basename(dirname(__FILE__)));

		defined('DNA_RUBIS_PLUGIN_BASENAME')
			|| define('DNA_RUBIS_PLUGIN_BASENAME', DNA_RUBIS_PLUGIN_NAME . '/' . basename(__FILE__));

		defined('DNA_RUBIS_PLUGIN_DIR')
			|| define('DNA_RUBIS_PLUGIN_DIR', untrailingslashit(plugin_dir_path(__FILE__)));

		defined('DNA_RUBIS_PLUGIN_URL')
			|| define('DNA_RUBIS_PLUGIN_URL', untrailingslashit(plugins_url(DNA_RUBIS_PLUGIN_NAME)));

		defined('DNA_RUBIS_INCLUDES_DIR')
			|| define('DNA_RUBIS_INCLUDES_DIR', DNA_RUBIS_PLUGIN_DIR . '/includes');

		defined('DNA_RUBIS_ADMIN_DIR')
			|| define('DNA_RUBIS_ADMIN_DIR', DNA_RUBIS_PLUGIN_DIR . '/admin');

		defined('DNA_RUBIS_ADMIN_URL')
			|| define('DNA_RUBIS_ADMIN_URL', DNA_RUBIS_PLUGIN_URL . '/admin');

		defined('DNA_RUBIS_ADMIN_INCLUDES_DIR')
			|| define('DNA_RUBIS_ADMIN_INCLUDES_DIR', DNA_RUBIS_ADMIN_DIR . '/includes');

		defined('DNA_RUBIS_FRONTEND_DIR')
            || define('DNA_RUBIS_FRONTEND_DIR', DNA_RUBIS_PLUGIN_DIR . '/frontend');
	}


	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since 1.0
	 */
	function dna_includes() {

		/* Load the plugin functions file. */
		require_once( DNA_RUBIS_INCLUDES_DIR . '/common.php' );
		require_once( DNA_RUBIS_INCLUDES_DIR . '/classes/class.sync.news.php' );
	}

	/**
	 * Loads the admin functions and files.
	 *
	 * @since 1.0
	 */
	function dna_admin() {
		/* Load the main admin file. */
		require_once( DNA_RUBIS_ADMIN_DIR . '/class-admin.php' );
	}

	/**
	 * Loads the initial files ACF Fields.
	 *
	 * @since 1.0
	 */
	function dna_include_acf_fields() {
		require_once( DNA_RUBIS_INCLUDES_DIR . '/acf-fields/home.fields.php' );
		require_once( DNA_RUBIS_INCLUDES_DIR . '/acf-fields/header.fields.php' );
		require_once( DNA_RUBIS_INCLUDES_DIR . '/acf-fields/footer.fields.php' );
		require_once( DNA_RUBIS_INCLUDES_DIR . '/acf-fields/google.fields.php' );
		require_once( DNA_RUBIS_INCLUDES_DIR . '/acf-fields/social.fields.php' );
		require_once( DNA_RUBIS_INCLUDES_DIR . '/acf-fields/block.map.fields.php' );
		require_once( DNA_RUBIS_INCLUDES_DIR . '/acf-fields/display.blocks.fields.php' );
		require_once( DNA_RUBIS_INCLUDES_DIR . '/acf-fields/header.page.fields.php' );
		require_once( DNA_RUBIS_INCLUDES_DIR . '/acf-fields/contact.fields.php' );
		require_once( DNA_RUBIS_INCLUDES_DIR . '/acf-fields/history.fields.php' );
		require_once( DNA_RUBIS_INCLUDES_DIR . '/acf-fields/post.fields.php' );
	}

	public function acf_load_relationship_base_field_choices( $field ) {
		$field['choices']['listing_actus'] = pll__('Page listing actus');
		return $field;
    }

	/**
     * Include Frontend Class
     *
     * @since 1.0
     */
    public function dna_frontend() {

        /* Only load files if in the WordPress frontend. */
        if ( !is_admin() ) {
            /* Load the main settings file. */
			require_once( DNA_RUBIS_FRONTEND_DIR . '/class-frontend.php' );
            /* Load Walker If Needed */
            require_once( DNA_RUBIS_FRONTEND_DIR . '/walker.php' );
        }
    }

}

$dna_theme_load = new Dna_Rubis_Load();
