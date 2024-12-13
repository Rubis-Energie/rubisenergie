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
class Dna_Theme_Frontend extends Master_Common {


    /**
     * PHP5 constructor method.
     *
     * @since 1.0
     */
    function __construct() {
        
    }

    /**
     * Store Global Message In Session
     *
     * @param  array $config , string $message, string $type
     */
    public function set_global_message( $title = '', $message = '', $type) {
        $_SESSION['dna_global_messages']['title']   = $title;
        $_SESSION['dna_global_messages']['message'] = $message;
        $_SESSION['dna_global_messages']['type']    = $type;
    }

    /**
     * Return Stored Global Message In Session
     *
     * @return string|array
     */
    public function get_global_message() {
        if(class_exists('Dna_Messages')) {
            $msgClass = new Dna_Messages();
            $msgs = $msgClass->get_global_message();
            $this->display_template('common/message', array('msgs' => $msgs));
        }
   }

   /**
     * Enqueue reCAPTCHA
    */
   public function enqueue_recaptcha_script() {
        wp_enqueue_script( 'greCAPTCHA', 'https://www.google.com/recaptcha/api.js', false );
    }

    /**
     * Display Recaptcha Form
    */
    public function display_recaptcha($callback = false) {
        $key = get_recaptcha();
        $this->display_template('recaptcha', array(
            'key' => $key,
            'callback' => $callback
        ));
    }

}