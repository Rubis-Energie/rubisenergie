<?php
/**
 * Frontend Class
 *
 * @package WordPress
 * @subpackage Implantation
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */


if (!defined('DNA_IMPLANTATION_VERSION')) exit;

/**
 * @since 1.0
 */
class Dna_Implantation_Frontend extends Master_Common
{

    function __construct() {
        //add_action('template_redirect', array( &$this, 'implantation_init_front' ) );
    }

    function map_implantation() {
        $args = array(
            'post_type' => 'implantation',
            'posts_per_page' => -1,
        );
        $imp = get_posts($args);

        $cont = get_continent();
        $countries_sort_cont = get_countries_by_continent();
        $countries = get_all_coutries();

        $this->display_template('map', array(
            'cont' => $cont,
            'implantations' => $imp,
            'countries' => $countries,
            'countries_sort_cont' => $countries_sort_cont,
        ));
    }
}
