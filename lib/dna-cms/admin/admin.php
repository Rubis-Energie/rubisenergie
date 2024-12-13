<?php
/**
 * Admin settings Plugin Init
 *
 * @package WordPress
 * @subpackage Cms
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

if (!defined('DNA_CMS_VERSION')) exit;

/**
 * @since 1.0
 */
class Dna_Cms_Admin
{

    function __construct()
    {
        //add_action('admin_init', array(&$this, 'Dna_Admin_Redirect'));
    }
}

new Dna_Cms_Admin();
