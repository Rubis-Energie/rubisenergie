<?php
/**
 * Admin settings Plugin Init
 *
 * @package WordPress
 * @subpackage Polylang String Translation
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 */

if (!defined('PST_VERSION')) exit;

/**
 * @since 1.0
 */
class PolylangStringTranslationAdmin {

	/**
	 * PHP5 constructor method.
	 *
	 * @since 1.0
	 */
	function __construct() {
		/* Admin menu */
		add_action( 'admin_menu', array( $this, 'adminMenu' ) );
	}

	/**
	 * Display option menu
	 *
	 * @since 1.0
	 */
	function adminMenu () {
		add_options_page( __('Translation', 'pls'),__('Translation', 'pls'),'manage_options','polylang_translate_string', array( $this, 'translatePage' ) );
	}

	/**
	 * Page display and POST
	 *
	 * @since 1.0
	 */
	function  translatePage () {
		/* POST DETECTION */
		if (isset( $_POST['polylang_trans_form_post'] ) && wp_verify_nonce( $_POST['polylang_trans_form_post'], 'polylang_trans_k' )) {
			
			// Plugins detection
			$pluginsList = false;
			if(isset($_POST['polylang_plugins']) && count($_POST['polylang_plugins']) > 0) {
				$pluginsList = array_keys($_POST['polylang_plugins']);
			}
			// Automatic installation
			if(isset($_POST['polylang_trans_form']['method']) && $_POST['polylang_trans_form']['method'] == 'install') {
				if($this->_generateTranslation($pluginsList) == true) {
					$uri = 'success=1';
	  			}
	  			else {
	  				$uri = 'success=-1';
	  			}
	  			wp_redirect(admin_url('options-general.php?page=polylang_translate_string&'.$uri));
	  			exit;
	  		}
	  		// File download
	  		else {
	  			if($this->_generateTranslation($pluginsList) != true) {
					wp_redirect(admin_url('options-general.php?page=polylang_translate_string&'.$uri));
	  				exit;
	  			}
	  			
	  			$fileName = PST_STRINGS_DIR . '/register-string.php';
	  			header('Pragma: public'); 	// required
				header('Expires: 0');		// no cache
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Cache-Control: private',false);
				header('Content-Type: application/force-download');
				header('Content-Disposition: attachment; filename="'.basename($fileName).'"');
				header('Content-Transfer-Encoding: binary');
				header('Content-Length: '.filesize($fileName));	// provide file size
				header('Connection: close');
				readfile($fileName);
				$nF = PST_STRINGS_DIR . '/register-string.php';
				unlink($nF);
				exit;
	  		}
		}
		/* INCLUDE GENERATION PAGE */
		else {
			include PST_ADMIN_DIR . '/settings-translate.php';
		}
	}

	/**
	 * Config File Generation
	 *
	 * @since 1.0
	 */
	protected function _generateTranslation($plugins = false) {
		$stateSuccess = false;
		require_once( PST_CLASSES_DIR . '/class.translation.php' );
		// Parse Theme
		$parser_theme = new PolylangFileParser(get_template_directory());
		$strings_theme = $parser_theme->parse();
		if($strings_theme) {
			if(copy(PST_INCLUDES_DIR . '/template/register-string-template.php', PST_STRINGS_DIR . '/register-string.php')) {
				$fh = fopen(PST_STRINGS_DIR . '/register-string.php', 'a');
				$stringData = "\n\n";
				foreach ($strings_theme as $_stringList) {
					foreach ((array)$_stringList['strings'] as $_string) {
						$_string = preg_replace('/"/i', '\"', $_string);
						$th = wp_get_theme();
						$stringData .= 'pll_register_string("polylang", "'.$_string.'", "'.$th.'");'."\n";
					}
				}
				// Plugins Parsing
				if($plugins) {
					$plugin_list = get_plugins();
					$pluginsIds = array();
					foreach ($plugin_list as $kplugin => $_plugin) {
						if (preg_match('/\//', $kplugin)) {
							$kplugin = substr($kplugin, 0, strrpos($kplugin, "/"));
							$pluginName = $_plugin['Name'];
							$pluginsIds[$kplugin] = $pluginName;
						}
					}
					
					$parser_plugins = new PolylangFileParser($plugins, true);
					$strings_plugins = $parser_plugins->parse(true);
					
					if($strings_plugins) {
						foreach ($strings_plugins as $_stringList) {
							$cFile = $_stringList['plugin_name'];
							if(array_key_exists($cFile, $pluginsIds)) {
								foreach ((array)$_stringList['strings'] as $_string) {
									$_string = preg_replace('/"/i', '\"', $_string);
									$stringData .= 'pll_register_string("polylang", "'.$_string.'", "'.$pluginsIds[$cFile].'");'."\n";
								}
							}
						}
					}
				}

				fwrite($fh, $stringData);
				fclose($fh);
				$stateSuccess = true;
			}
		}
		return $stateSuccess;
	}
}

new PolylangStringTranslationAdmin();