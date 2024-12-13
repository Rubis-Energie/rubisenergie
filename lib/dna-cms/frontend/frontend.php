<?php
/**
 * Frontend Class
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
class Dna_Cms_Frontend extends Master_Common
{

    function __construct() {
        //add_action('template_redirect', array( &$this, 'cms_init_front' ) );
    }

    function list_blocks($tpl,$param) {
        if (!$param) {
            $blocks = get_field('block');
        } else {
            $blocks = $param["blocks"];
        }

        $this->display_template('list.blocks', array(
                'blocks' => $blocks
            )
        );
    }

    function block($tpl, $params) {
        $this->display_template('blocks/' . $params["layout"], array(
                'block' => $params["fields"],
            )
        );
    }
}
