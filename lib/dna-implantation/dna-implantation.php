<?php
/*
Plugin Name:  @AND - Implantation
Description: Plugin implantation
Author: Agence AND Digital
Version: 1.0
Author URI: https://www.and-digital.fr/
* /

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @since 1.0
 */
class Dna_Implantation {

        /**
         * PHP5 constructor method.
         *
         * @since 1.0
         */
        function __construct()
        {

            /* Defines constants */
            self::define_constants();

            /* Create Post Type */
            add_action('init', array(&$this, 'dna_post_types'), 11);

            /* Include common files. */
            add_action('plugins_loaded', array(&$this, 'dna_implantation_include'), 10);
            /* Load the frontend files. */
            add_action('plugins_loaded', array(&$this, 'dna_implantation_frontend'), 20);
            /* Load the admin files. */
            add_action('plugins_loaded', array(&$this, 'dna_implantation_admin'), 30);
            /* Include acf fields. */
            add_action('plugins_loaded', array(&$this, 'dna_include_acf_fields'), 40);
        }


        /*
         * Defines constants
         *
         * @since 1.0
         */
        static public function define_constants()
        {

            defined('DNA_IMPLANTATION_VERSION')
            || define('DNA_IMPLANTATION_VERSION', '1.0');

            defined('DNA_IMPLANTATION_PLUGIN_NAME')
            || define('DNA_IMPLANTATION_PLUGIN_NAME', basename(dirname(__FILE__)));

            defined('DNA_IMPLANTATION_PLUGIN_BASENAME')
            || define('DNA_IMPLANTATION_PLUGIN_BASENAME', DNA_IMPLANTATION_PLUGIN_NAME . '/' . basename(__FILE__));

            defined('DNA_IMPLANTATION_PLUGIN_DIR')
            || define('DNA_IMPLANTATION_PLUGIN_DIR', untrailingslashit(plugin_dir_path(__FILE__)));

            defined('DNA_IMPLANTATION_PLUGIN_URL')
            || define('DNA_IMPLANTATION_PLUGIN_URL', untrailingslashit(plugins_url(DNA_IMPLANTATION_PLUGIN_NAME)));

            defined('DNA_IMPLANTATION_INCLUDES_DIR')
            || define('DNA_IMPLANTATION_INCLUDES_DIR', DNA_IMPLANTATION_PLUGIN_DIR . '/includes');

            defined('DNA_IMPLANTATION_FRONTEND_DIR')
            || define('DNA_IMPLANTATION_FRONTEND_DIR', DNA_IMPLANTATION_PLUGIN_DIR . '/frontend');

            defined('DNA_IMPLANTATION_ADMIN_DIR')
            || define('DNA_IMPLANTATION_ADMIN_DIR', DNA_IMPLANTATION_PLUGIN_DIR . '/admin');
        }


        /**
         * Include Frontend Class
         *
         * @since 1.0
         */
        public function dna_implantation_frontend()
        {

            /* Only load files if in the WordPress frontend. */
            if (!is_admin() || defined('DOING_AJAX')) {
                require_once(DNA_IMPLANTATION_FRONTEND_DIR . '/frontend.php');
                $class_implantation_display = new Dna_Implantation_Frontend();
            }
        }

        /**
         * Loads the admin functions and files.
         *
         * @since 1.0
         */
        function dna_implantation_admin()
        {
            /* Load the main admin file. */
            require_once(DNA_IMPLANTATION_ADMIN_DIR . '/admin.php');
        }

        /**
         * Loads the initial files needed by the plugin.
         *
         * @since 1.0
         */
        public function dna_implantation_include()
        {
            /* Load the plugin functions file. */
            require_once(DNA_IMPLANTATION_INCLUDES_DIR . '/common.php');
        }

        /**
         * Loads the initial files ACF Fields.
         *
         * @since 1.0
         */
        function dna_include_acf_fields()
        {
            require_once(DNA_IMPLANTATION_INCLUDES_DIR . '/acf-fields/fields.php');
        }


        /**
         * Create Post Types
         *
         * @since 1.0
         */
        public function dna_post_types()
        {
            register_post_type( "implantation", array (
              'labels' =>
              array (
                'name' => pll__('Implantation'),
                'singular_name' => 'implantation',
                'add_new' => 'Ajouter une implantation',
                'add_new_item' => 'Ajouter',
                'edit_item' => 'Editer la implantation',
                'new_item' => 'Nouvelle implantation',
                'view_item' => 'Voir la implantation',
                'search_items' => 'Recherche',
                'not_found' => 'Aucune implantation trouvée',
                'not_found_in_trash' => 'Aucune implantation trouvée dans la corbeille',
                'parent_item_colon' => '',
              ),
              'description' => '',
              'publicly_queryable' => true,
              'exclude_from_search' => false,
              'map_meta_cap' => true,
              'capability_type' => 'post',
              'public' => true,
              'hierarchical' => false,
              'rewrite' =>
              array (
                'slug' => 'implantation',
                'with_front' => true,
                'pages' => true,
                'feeds' => false,
              ),
              'has_archive' => 'implantation-page',
              'query_var' => true,
              'supports' =>
              array (
                0 => 'title',
                1 => 'editor',
                2 => 'thumbnail',
                3 => 'revisions'
              ),
              'taxonomies' =>
              array (
                0 => 'type',
              ),
              'show_ui' => true,
              'menu_position' => 30,
              'menu_icon' => 'dashicons-block-default',
              'can_export' => true,
              'show_in_nav_menus' => true,
              'show_in_menu' => true,
            ) );
        }
}

new Dna_Implantation();
