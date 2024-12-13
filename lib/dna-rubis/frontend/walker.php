<?php
/**
 * Frontend Class
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

if (!defined('DNA_THEME_VERSION')) exit;

/**
 * @since 1.0
 */
class Dna_Theme_Walker extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<i class=\"fa fa-angle-down m-l-5\"></i><ul class=\"dropdown-menu animated fadeInUp\">\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
}





