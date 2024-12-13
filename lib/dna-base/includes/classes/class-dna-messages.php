<?php
/**
 * Messages Class
 *
 * @package WordPress
 * @subpackage BASE - @Plugin Principal
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

class Dna_Messages {


	/**
	 * Constructor for our class
	 *
	 * @return Class
	 */
	public function __construct() {

		// FRONTEND INITIALIZATION
		if ( ! is_admin()) {
			@session_start();
		}

	}

	/**
	 * Return Stored Global Message In Session
	 *
	 * @return string|array
	 */
	public function get_global_message() {
		if ( isset( $_SESSION['dna_global_messages'] ) ) {
			$messages = $_SESSION['dna_global_messages'];
			 unset( $_SESSION['dna_global_messages'] );

			return $messages;
		}

		return false;
	}

	/**
	 * Store Global Message In Session
	 *
	 * @param  array $config , string $message, string $type
	 */
	public function set_global_message( $title = '', $message = '', $type ) {
		$_SESSION['dna_global_messages']['title']   = $title;
		$_SESSION['dna_global_messages']['message'] = $message;
		$_SESSION['dna_global_messages']['type']    = $type;
	}

}