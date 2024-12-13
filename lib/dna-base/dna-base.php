<?php
/*
Plugin Name: @AND - Base / Plugin principal
Description: Plugin BASE, Global plugin.
Author: Agence AND Digital
Version: 1.0
Author URI: https://www.and-digital.fr/
*


/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @since 1.0
 */
class Dna_Base_Load {

	/**
	 * PHP5 constructor method.
	 *
	 * @since 1.0
	 */
	function __construct() {

		/* Defines constants */
		self::define_constants();
		/* Check Folder Structure */
		add_action( 'plugins_loaded', array( &$this, 'dna_folders' ), 1 );

		/* Include common function file. */
		add_action( 'plugins_loaded', array( &$this, 'dna_includes' ), 2 );

		/* Include acf fields. */
		add_action( 'plugins_loaded', array( &$this, 'dna_include_acf_fields' ), 3 );

		/* Initialize all globals Class */
		add_action( 'plugins_loaded', array( &$this, 'dna_class_init' ), 4 );

		/* Load the admin files. */
		add_action( 'plugins_loaded', array( &$this, 'dna_admin' ), 5 );

		/* Load the frontend files. */
		add_action( 'plugins_loaded', array( &$this, 'frontend_init' ), 11 );
	}

	/**
	 * Defines constants used by the plugin.
	 *
	* @since 1.0
	 */
	static public function define_constants() {

		defined('DNA_BASE_VERSION')
			|| define('DNA_BASE_VERSION', '1.0');

		defined('DNA_BASE_PLUGIN_NAME')
			|| define('DNA_BASE_PLUGIN_NAME', basename(dirname(__FILE__)));

		defined('DNA_BASE_PLUGIN_BASENAME')
			|| define('DNA_BASE_PLUGIN_BASENAME', DNA_BASE_PLUGIN_NAME . '/' . basename(__FILE__));

		defined('DNA_BASE_PLUGIN_DIR')
			|| define('DNA_BASE_PLUGIN_DIR', untrailingslashit(plugin_dir_path(__FILE__)));

		defined('DNA_BASE_PLUGIN_URL')
			|| define('DNA_BASE_PLUGIN_URL', untrailingslashit(plugins_url(DNA_BASE_PLUGIN_NAME)));

		defined('DNA_BASE_INCLUDES_DIR')
			|| define('DNA_BASE_INCLUDES_DIR', DNA_BASE_PLUGIN_DIR . '/includes');

		defined('DNA_BASE_CLASSES_DIR')
			|| define('DNA_BASE_CLASSES_DIR', DNA_BASE_INCLUDES_DIR . '/classes');

		defined('DNA_BASE_ADMIN_DIR')
			|| define('DNA_BASE_ADMIN_DIR', DNA_BASE_PLUGIN_DIR . '/admin');

		defined('DNA_BASE_ADMIN_URL')
			|| define('DNA_BASE_ADMIN_URL', DNA_BASE_PLUGIN_URL . '/admin');

		defined('DNA_BASE_LOG_DIR')
			|| define('DNA_BASE_LOG_DIR', DNA_BASE_PLUGIN_DIR . '/logs');

		defined('DNA_BASE_CACHING_DIR')
			|| define('DNA_BASE_CACHING_DIR', DNA_BASE_PLUGIN_DIR . '/cache');

		defined('DNA_BASE_TMP_DIR')
			|| define('DNA_BASE_TMP_DIR', DNA_BASE_PLUGIN_DIR . '/tmp');

		defined('DNA_BASE_ADMIN_INCLUDES_DIR')
			|| define('DNA_BASE_ADMIN_INCLUDES_DIR', DNA_BASE_ADMIN_DIR . '/includes');

		defined('DNA_BASE_FRONTEND_DIR')
			|| define('DNA_BASE_FRONTEND_DIR', DNA_BASE_PLUGIN_DIR . '/frontend');
	}

	/*
	 * Create the required folders if missing
	 *
	 * @since 1.0
	 */
	public function dna_folders() {

		if (!file_exists(DNA_BASE_LOG_DIR)) {
			mkdir(DNA_BASE_LOG_DIR, 0755, true);
		}
		if (!file_exists(DNA_BASE_CACHING_DIR)) {
			mkdir(DNA_BASE_CACHING_DIR, 0755, true);
		}
		if (!file_exists(DNA_BASE_TMP_DIR)) {
			mkdir(DNA_BASE_TMP_DIR, 0755, true);
		}
	}

	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since 1.0
	 */
	function dna_includes() {
		/* Load the plugin functions file. */
		require_once( DNA_BASE_INCLUDES_DIR . '/common.php' );
		require_once( DNA_BASE_CLASSES_DIR . '/class-master-common.php' );
		require_once( DNA_BASE_CLASSES_DIR . '/class-dna-security.php' );
		require_once( DNA_BASE_CLASSES_DIR . '/class-dna-messages.php' );
	}

	/**
	 * Init Globals Classes
	 *
	 * @since 1.0
	 */
	function dna_class_init() {

		global $dna_log, $dna_cache;
		/* LOG Init */
		if (!class_exists('Dna_Logs')) {
			global $dna_log;
			require_once DNA_BASE_CLASSES_DIR . '/class-dna-logs.php';
			$dna_log = new Dna_Logs();
		}

		/* Cache Init */
		if (!class_exists('Dna_Cache')) {
			global $dna_cache;
			require_once DNA_BASE_CLASSES_DIR . '/class-dna-cache.php';
			$dna_cache = new Dna_Cache();
		}

		/* Upload Init */
		if (!class_exists('Dna_Upload')) {
			global $dna_upload;
			require_once DNA_BASE_CLASSES_DIR . '/class-dna-upload.php';
			$dna_upload = new Dna_Upload();
		}
	}

	/**
	 * Loads the initial files ACF Fields.
	 *
	 * @since 1.0
	 */
	function dna_include_acf_fields() {
		require_once( DNA_BASE_INCLUDES_DIR . '/acf-fields/acf-relationships.php' );
	}

	/**
	 * Loads the admin functions and files.
	 *
	 * @since 1.0
	 */
	function dna_admin() {

		/* Only load files if in the WordPress admin. */
		if ( is_admin() ) {
			/* Load the main admin file. */
			require_once( DNA_BASE_ADMIN_DIR . '/class-dna-admin.php' );

		}
	}

	/**
	 * Include Frontend Class
	 *
	 * @since 1.0
	 */
	public function frontend_init() {

		/* Only load files if in the WordPress frontend. */
		if ( !is_admin() ) {
			require_once( DNA_BASE_FRONTEND_DIR . '/class-dna-frontend.php' );
			$class_dna_frontend = new Dna_Frontend();
		}
	}
}

$dna_base_load = new Dna_Base_Load();
