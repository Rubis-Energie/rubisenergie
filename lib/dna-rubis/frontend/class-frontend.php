<?php
/**
 * Frontend Class
 *
 * @package WordPress
 * @subpackage Rubis
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */


if (!defined('DNA_RUBIS_VERSION')) exit;

/**
 * @since 1.0
 */
class Dna_Rubis_Frontend extends Master_Common {


    /**
     * PHP5 constructor method.
     *
     * @since 1.0
     */
    function __construct() {
        add_filter('nav_menu_css_class', array( &$this, 'css_class_filter' ), 10, 4 );
        add_filter('nav_menu_item_id', array( &$this, 'css_attribute_filter' ), 100, 1 );
        add_filter('page_css_class', array( &$this, 'css_attribute_filter' ), 100, 1 );
        add_filter('nav_menu_link_attributes', array( &$this, 'nav_menu_link_attributes' ), 10, 3 );
        add_filter('wp_nav_menu', array( &$this, 'wp_nav_menu' ));
        add_action('template_redirect', array( &$this, 'rubis_init_front' ) );
    }

    public function css_attribute_filter($var) {
        return array();
    }

    public function css_class_filter($classes, $item, $args, $depth) {

        if (is_array($classes)) {

            if ($depth > 0) {
                return array("dropdown-item");
            }

            $currentPage = array_search('current-page', $classes);
            $current = array_search('current-menu-item', $classes);
            $currentParent = array_search('current-menu-parent', $classes);
            $currentAncestor = array_search('current-post-ancestor', $classes);

            $hasChild = array_search('menu-item-has-children', $classes);

            $classes = array();
            if ($current !== false || $currentPage !== false || $currentParent !== false || $currentAncestor !== false) {
                $classes[] = 'current-page';
            }
            if ($hasChild !== false) {
                $classes[] = 'dropdown';
            }
            $classes[] = 'nav-item';

            return $classes;
        }
        return '';
    }

    public function wp_nav_menu($menu) {
        $menu = preg_replace('/ class="sub-menu"/','/ class="submenu" /',$menu);
        return $menu;
    }

    public function nav_menu_link_attributes( $atts, $item, $arg ) {
        $atts["class"]= "nav-link";
        if (in_array('menu-item-has-children', $item->classes)) {
            $atts["class"] .= " dropdown-toggle";
            $atts['data-toggle'] = "dropdown";
            $atts['aria-expanded'] = "false";
        }
        return $atts;
    }

    public function rubis_init_front() {
    }

    public function homepage() {
        $fields_hp = get_fields();

        $this->display_template('homepage', array(
            'fields_hp' => $fields_hp,
        ));
    }

    public function block_map() {
        $block = fol('block_map');

        $this->display_template('parts/block.map', array(
            'block_map' => $block,
        ));
    }

    public function header_page() {
        $header_page = get_field('header_page');

        $this->display_template('parts/header.page', array(
            'header_page' => $header_page,
        ));
    }

    public function listing_actus() {
        global $wp_query;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 9,
            'paged' => $paged,
        );

        if (isset($_GET["cat"]) && $_GET["cat"] != "false") {
            $args["category_name"] = $_GET["cat"];
        }

        $list = new WP_Query($args);
        $themes = get_terms('category');

        $this->display_template('listing.actus', array(
            'list' => $list,
            'themes' => $themes,
        ));
    }

    public function contact() {
        $fields = get_fields();

        $this->display_template('contact', array(
            'fields' => $fields,
        ));
    }

    public function history() {
        $fields = get_fields();

        $this->display_template('history', array(
            'fields' => $fields,
        ));
    }
}
new Dna_Rubis_Frontend();
