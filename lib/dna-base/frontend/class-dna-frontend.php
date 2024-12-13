<?php
/**
 * Frontend Class
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
class Dna_Frontend extends Master_Common {

    public $relations_tab = null;

    /**
     * PHP5 constructor method.
     *
     * @since 1.0
     */
    function __construct() {

        /* Enqueue Script */
        add_action('wp_enqueue_scripts', array( &$this, 'dna_enqueue_scripts' ) );
    }

    public function get_page_relation($name_relation) {
        
        if (!$this->relations_tab) {
            $this->relations_tab = fo('pages_relationship');
        }
        if ($this->relations_tab) {
            foreach ($this->relations_tab as $relation) {
                if ($relation['relationship_base_field'] == $name_relation) {
                    return pll_get_post($relation['page']);
                }
            }
        }

        return null;
    }

    /**
     * Enqueue the frontend scripts
     */
    function dna_enqueue_scripts() {
        wp_enqueue_script('dnacookie', DNA_BASE_PLUGIN_URL . '/js/dna-cookie.js', array('jquery'), NULL, true);
        wp_localize_script('dnacookie', 'dnaL10n', $this->dna_admin_l10n() );
    }

    function dna_admin_l10n($key = false) {
        $data = array(
            'adminAjaxUri'          => admin_url("admin-ajax.php"),
            'mainUrl'               => home_url( '/' ),
            'anonce'                => wp_create_nonce("Ajax_adProtectW3b"),
            'msgCookie'             => pll__('En poursuivant votre navigation sur ce site, vous acceptez l\'utilisation de cookies afin de réaliser des statistiques de visites', 'dna'),
            'okCookie'              => pll__('Ok', 'dna'),
        );

        if($key && array_key_exists($key, $data))
            return $data[$key];
        $params = array( 'l10n_print_after' => 'dnaL10n = ' . json_encode($data) . ';' );
        return $params;
    }
}
