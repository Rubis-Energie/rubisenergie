<?php
/**
 * Admin settings Plugin Init
 *
 * @package WordPress
 * @subpackage Products
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

if (!defined('DNA_PRODUCTS_VERSION')) exit;

/**
 * @since 1.0
 */
class Dna_Products_Admin
{

    function __construct()
    {
        //add_action('admin_init', array(&$this, 'Dna_Admin_Redirect'));
    }
}

new Dna_Products_Admin();
