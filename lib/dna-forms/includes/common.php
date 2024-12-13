<?php
/**
 * Common Functions
 *
 * @package WordPress
 * @subpackage Forms
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

if (!defined('DNA_FORMS_VERSION')) exit;

function form_mail($type, $subject, $to, $headline, $fields, $file = false) {
	$websiteEmail = get_bloginfo('admin_email');
	$headers = array('From: Site Internet <'.$websiteEmail.'>', "Content-type: text/html; charset=UTF-8'");

	if (file_exists(DNA_FORMS_INCLUDES_DIR. '/mail/'.$type.'.php')) {

		ob_start();
		include(DNA_FORMS_INCLUDES_DIR. '/mail/'.$type.'.php');
		$mail_template = ob_get_clean();
		// send email
	    add_filter('wp_mail_content_type', function( $content_type ) {
	        return 'text/html';
	    });

        if ($file) {
            return wp_mail($to, $subject, $mail_template, $headers, $file);
        } else {
            return wp_mail($to, $subject, $mail_template, $headers);
        }
	}
	return false;
}

if (!function_exists('recaptcha_init')) {
    function recaptcha_init($key)
    {
        $recaptcha = new ReCaptcha($key);
        return $recaptcha;
    }
}
