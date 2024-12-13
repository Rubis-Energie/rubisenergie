<?php
/**
 * Admin settings Plugin Init
 *
 * @package WordPress
 * @subpackage BASE - @Plugin Principal
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

if (!defined('DNA_BASE_VERSION')) exit;

/**
 * @since 1.0
 */
class Dna_Admin {

	/**
	 * PHP5 constructor method.
	 *
	 * @since 1.0
	 */
	function __construct() {
		/**
		 * Adding ACF Location Rule Operator combined with POLYLANG PLUGIN
		 */
		add_filter( 'acf/location/rule_types', array(&$this,'theme_lang_rules') );
		add_filter( 'acf/location/rule_operators', array(&$this,'theme_lang_operators') );
		add_filter( 'acf/location/rule_values/lang', array(&$this,'theme_lang_values') );
		add_filter( 'acf/location/rule_match/lang', array(&$this,'theme_lang_match'), 10, 3 );
		//add_filter( 'acf/get_options_pages', array( &$this,'position_acf') );
		add_filter('acf/settings/remove_wp_meta_box', '__return_true');
		/**
		 * Create main Menu Option & Relation
		 */
		$this->_create_option_menu();
	}

	/**
	 * Adding ACF Location Rule (used by ACF Plugin)
	 */
	function theme_lang_rules($choices) {
		$choices['Langue']['lang'] = __('Langue courrante');
		return $choices;
	}

	/**
	 * Adding ACF Location Rule Operator (used by ACF Plugin)
	 */
	function theme_lang_operators( $choices ) {
		$choices['=='] = __('est égal à');
		$choices['!='] = __('n‘est pas égal à');
		return $choices;
	}

	/**
	 * Adding ACF Location Rule Values (used by ACF Plugin)
	 */
	function theme_lang_values($choices) {
		global $polylang;
		if ($polylang) {
			$languages = $polylang->model->get_languages_list();
			$choices['all'] = __('Toutes');
			if(count($languages) > 0) {
				foreach($languages as $lang) {
					$choices[$lang->slug] = $lang->name;
				}
			}
		}
		return $choices;
	}

	/**
	 * Add Position To Acf Options Menu
	 */
	function position_acf($pages) {
        $pos = array();
        foreach ($pages as $key => $row) {
            $pos[$row['position']] = $key;
        }

        ksort($pos);
        
        $first = reset($pos);
        $second = ap(array_slice($pos, 1, 1));
        
        foreach ($pos as $key) {
            $finalPages[$key] = $pages[$key];
            if ($key == $first) {
                $finalPages[$key]['menu_slug'] = $pages[$second]['menu_slug'];
            }
            else {
            	if (search_in_array('cpt_', $pages[$key], false, true)) {
            		$realSlug = str_replace('cpt_', '', $pages[$key]['parent_slug']);
            		$finalPages[$key]['parent_slug'] = $realSlug;
            	}
            	else {
                	$finalPages[$key]['parent_slug'] = $pages[$second]['menu_slug'];
            	}
            }
        }
        return $finalPages;
    }

	/**
	 * Matching ACF Location Rule (used by ACF Plugin)
	 */
	function theme_lang_match($match, $rule, $options) {
		global $polylang;
		$selected_lang = $rule['value'];
		$match = false;
		if ($polylang) {
			if($rule['operator'] == "==") {
				if($polylang->curlang) {
					$match = ( $polylang->curlang->slug == $selected_lang );
				}
				else {
					$match = ( $selected_lang == 'all' );
				}
			}
			elseif($rule['operator'] == "!=") {
				$match = ( $polylang->curlang && $polylang->curlang->slug != $selected_lang );
			}
		}
		return $match;
	}

	/**
	 * Create Relation Menu & Relation Option Group
	 */
	protected function _create_option_menu() {
		// Create Main Menu
		acf_add_options_page(array(
	        'page_title'    => __('Configuration du thème'),
	        'menu_title'    => __('Configuration'),
	        'menu_slug'     => 'theme-general-settings',
	        'capability'    => 'manage_categories',
	        'position'		=> 45.2,
	        'redirect'      => true
	    ));
	    // Create Relation Menu
	    acf_add_options_page(array(
			'page_title' 	=> __('Relations'),
			'menu_title'	=> __('Relations'),
			'menu_slug' 	=> 'page-relation-settings',
			'capability'	=> 'activate_plugins',
			'position'		=> 50,
			'parent_slug'	=> 'theme-general-settings'
		));
	}
}

new Dna_Admin();