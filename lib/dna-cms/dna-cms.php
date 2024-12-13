<?php
/*
Plugin Name:  @AND - Cms
Description: Plugin cms
Author: Agence AND Digital
Version: 1.0
Author URI: https://www.and-digital.fr/
* /

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @since 1.0
 */
class Dna_Cms {

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
        // add_action('init', array(&$this, 'dna_post_types'), 11);

        /* Include common files. */
        add_action('plugins_loaded', array(&$this, 'dna_cms_include'), 10);
        /* Load the frontend files. */
        add_action('plugins_loaded', array(&$this, 'dna_cms_frontend'), 20);
        /* Load the admin files. */
        add_action('plugins_loaded', array(&$this, 'dna_cms_admin'), 30);
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

        defined('DNA_CMS_VERSION')
        || define('DNA_CMS_VERSION', '1.0');

        defined('DNA_CMS_PLUGIN_NAME')
        || define('DNA_CMS_PLUGIN_NAME', basename(dirname(__FILE__)));

        defined('DNA_CMS_PLUGIN_BASENAME')
        || define('DNA_CMS_PLUGIN_BASENAME', DNA_CMS_PLUGIN_NAME . '/' . basename(__FILE__));

        defined('DNA_CMS_PLUGIN_DIR')
        || define('DNA_CMS_PLUGIN_DIR', untrailingslashit(plugin_dir_path(__FILE__)));

        defined('DNA_CMS_PLUGIN_URL')
        || define('DNA_CMS_PLUGIN_URL', untrailingslashit(plugins_url(DNA_CMS_PLUGIN_NAME)));

        defined('DNA_CMS_INCLUDES_DIR')
        || define('DNA_CMS_INCLUDES_DIR', DNA_CMS_PLUGIN_DIR . '/includes');

        defined('DNA_CMS_FRONTEND_DIR')
        || define('DNA_CMS_FRONTEND_DIR', DNA_CMS_PLUGIN_DIR . '/frontend');

        defined('DNA_CMS_ADMIN_DIR')
        || define('DNA_CMS_ADMIN_DIR', DNA_CMS_PLUGIN_DIR . '/admin');
    }


    /**
     * Include Frontend Class
     *
     * @since 1.0
     */
    public function dna_cms_frontend()
    {

        /* Only load files if in the WordPress frontend. */
        if (!is_admin() || defined('DOING_AJAX')) {
            require_once(DNA_CMS_FRONTEND_DIR . '/frontend.php');
            $class_cms_display = new Dna_Cms_Frontend();
        }
    }

    /**
     * Loads the admin functions and files.
     *
     * @since 1.0
     */
    function dna_cms_admin()
    {
        /* Load the main admin file. */
        require_once(DNA_CMS_ADMIN_DIR . '/admin.php');
    }

    /**
     * Loads the initial files needed by the plugin.
     *
     * @since 1.0
     */
    public function dna_cms_include()
    {
        /* Load the plugin functions file. */
        require_once(DNA_CMS_INCLUDES_DIR . '/common.php');
    }

    /**
     * Loads the initial files ACF Fields.
     *
     * @since 1.0
     */
    function dna_include_acf_fields()
    {
        require_once(DNA_CMS_INCLUDES_DIR . '/acf-fields/flexible-contents.php');
        foreach (scandir(DNA_CMS_INCLUDES_DIR . '/acf-fields/blocks/') as $file) {
        $path = DNA_CMS_INCLUDES_DIR . '/acf-fields/blocks/' . $file;
            if (is_file($path)) {
                require $path;
            }
        }
    }
}

new Dna_Cms();
