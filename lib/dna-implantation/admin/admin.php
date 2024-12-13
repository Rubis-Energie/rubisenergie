<?php
/**
 * Admin settings Plugin Init
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
class Dna_Implantation_Admin
{

    function __construct()
    {
        //add_action('admin_init', array(&$this, 'Dna_Admin_Redirect'));
    }
}

new Dna_Implantation_Admin();
