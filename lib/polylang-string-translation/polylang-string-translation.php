<?php
/*
Plugin Name: Polylang String Translation
Description: This plugin automatically generate theme translation for Polylang plugin 
Author: Agence AND DIGITAL <dev@and-digital.fr>
Version: 1.0
Author URI: http://www.parkeretparker.fr/
*/

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @since 1.0
 */
class PolylangStringTranslation {

	protected $_init = true;

	/**
	 * PHP5 constructor method.
	 *
	 * @since 1.0
	 */
	function __construct() {

		/* Defines constants */
		self::defineConstants();
		add_action('plugins_loaded', array($this, 'initPlugin'));
		/* Compatibility check */
		add_action( 'admin_init', array( $this, 'checkCompatibility' ) );
		/* Check Folder Structure */
		add_action( 'plugins_loaded', array( &$this, 'pstFolders' ), 1 );
		/* Set the constants needed by the plugin. */
		add_action( 'plugins_loaded', array( &$this, 'pstInit' ), 2 );
		/* Load the admin files. */
		add_action( 'plugins_loaded', array( &$this, 'pstAdmin' ), 3 );
		/* Load generated string translation file. */
		add_action( 'plugins_loaded', array( &$this, 'pstStringFile' ), 4 );
	}

	/*
	 * Defines constants
	 *
	 * @since 1.0
	 */
	static public function defineConstants() {

		defined('PST_MIN_VERSION')
			|| define('PST_MIN_VERSION', '0.6');	

		defined('PST_VERSION')
			|| define('PST_VERSION', '1.0');

		defined('PST_PLUGIN_NAME')
			|| define('PST_PLUGIN_NAME', basename(dirname(__FILE__)));

		defined('PST_PLUGIN_BASENAME')
			|| define('PST_PLUGIN_BASENAME', PST_PLUGIN_NAME . '/' . basename(__FILE__));

		defined('PST_PLUGIN_DIR')
			|| define('PST_PLUGIN_DIR', untrailingslashit(plugin_dir_path(__FILE__)));

		defined('PST_STRINGS_DIR')
			|| define('PST_STRINGS_DIR', PST_PLUGIN_DIR . '/strings');

		defined('PST_LANGUAGE_DIR')
			|| define('PST_LANGUAGE_DIR', PST_PLUGIN_DIR . '/languages');

		defined('PST_INCLUDES_DIR')
			|| define('PST_INCLUDES_DIR', PST_PLUGIN_DIR . '/includes');

		defined('PST_CLASSES_DIR')
			|| define('PST_CLASSES_DIR', PST_INCLUDES_DIR . '/classes');

		defined('PST_ADMIN_DIR')
			|| define('PST_ADMIN_DIR', PST_PLUGIN_DIR . '/admin');
	}


	/**
	 * Check if Polylang is installed and version is compatible
	 *
	 * @since 1.0
	 */
	public function checkCompatibility() {
		/* Require Polylang Plugin & Check Version */
		if ( ! defined( 'POLYLANG_VERSION' ) ) {
			if (is_plugin_active(plugin_basename( __FILE__ ))) {
				deactivate_plugins(plugin_basename( __FILE__ ));
				add_action('admin_notices', array( $this, 'missingNotices' ));
				delete_option( 'polylang_string_translation_version' );
				if (isset($_GET['activate'])) {
					unset( $_GET['activate'] );
				}
			}
		}
		/* Check Polylang Version */
		else {
			if(POLYLANG_VERSION < PST_MIN_VERSION) {
				add_action('admin_notices', array( $this, 'versionNotices' ));
			}
		}
	}

	/*
	 * Create the required folders if missing
	 *
	 * @since 1.0
	 */
	public function pstFolders() {
		if (!file_exists(PST_STRINGS_DIR)) {
    		mkdir(PST_STRINGS_DIR, 0777, true);
		}
	}

	/*
	 * Displays a notice if Polylang is missing
	 *
	 * @since 1.0
	 */
	public function missingNotices() {
		load_plugin_textdomain('pls', false, PST_LANGUAGE_DIR);
		printf(
			'<div class="error"><p>%s</p><p>%s</p></div>',
			__('Polylang String Translation cannot be installed. Main plugin Polylang is missing', 'pls'),
			sprintf(
				__('Please install %s.', 'pls'),
				'<a href="https://wordpress.org/plugins/polylang/" target="_blank">Polylang</a>'
			)
		);
	}

	/*
	 * Displays a notice if Polylang has not the required version
	 *
	 * @since 1.0
	 */
	public function versionNotices() {
		load_plugin_textdomain('pls', false, PST_LANGUAGE_DIR);
		printf(
			'<div class="error"><p>%s</p><p>%s</p></div>',
			__('Polylang String Translation cannot be installed. Main plugin Polylang has not the required version', 'pls'),
			sprintf(
				__('Please update %s to %s minimum (actually %s).', 'pls'),
				'<a href="https://wordpress.org/plugins/polylang/" target="_blank">Polylang</a>',
				PST_MIN_VERSION,
				POLYLANG_VERSION
			)
		);
	}

	/*
	 * Polylang String Translation initialization
	 *
	 * @since 1.0
	 */
	public function pstInit() {

		$version = get_option('polylang_string_translation_version');

		// plugin upgrade
		if (version_compare($version, PST_VERSION, '<')) {
			update_option( 'polylang_string_translation_version', PST_VERSION );
		}
	}

	
	/**
	 * Loads the plugin textdomain.
	 *
	 * @since 1.0
	 */
	public function initPlugin() {
		load_plugin_textdomain('pls', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');

		add_filter('plugin_action_links_'.plugin_basename(__FILE__), array( $this, 'polylangStringsPluginActions' ), 10, 4 );
	}

	public function polylangStringsPluginActions( $actions, $plugin_file, $plugin_data, $context ) {
		array_unshift($actions, '<a href="'.admin_url('options-general.php?page=polylang_translate_string').'">'.__('Settings', 'pls').'</a>');
		return $actions;
	}


	/**
	 * Loads the admin functions and files.
	 *
	 * @since 1.0
	 */
	public function pstAdmin() {

		/* Only load files if in the WordPress admin. */
		if ( is_admin() ) {
			/* Load the main settings file. */
			require_once( PST_ADMIN_DIR . '/admin.php' );

		}
	}

	/**
	 * Loads the Polylang Generated String Translation File
	 *
	 * @since 1.0
	 */
	public function pstStringFile() {
		$stringFile = PST_STRINGS_DIR . '/register-string.php';
		if(!file_exists($stringFile)) {
			$this->_createStringFile();
		}
		require_once( $stringFile );
	}

	/**
	 * Create the string file if is missing
	 *
	 * @since 1.0
	 */
	protected function _createStringFile() {
		copy(PST_INCLUDES_DIR . '/template/register-string-template.php', PST_STRINGS_DIR . '/register-string.php');
	}

	

}

new PolylangStringTranslation();