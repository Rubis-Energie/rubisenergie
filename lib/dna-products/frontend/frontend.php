<?php
/**
 * Frontend Class
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
class Dna_Products_Frontend extends Master_Common
{

    function __construct() {
        //add_action('template_redirect', array( &$this, 'products_init_front' ) );
    }

    function block_product() {
        $block = fol('block_prd');

        $this->display_template('parts/block.product', array(
            'block_prd' => $block,
        ));
    }
}
