<?php
/**
 * Logs Class
 *
 * @package WordPress
 * @subpackage BASE - @Plugin Principal
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

class Dna_Logs {

	protected $_log_path;


	public function __construct() {
		// Detect & create temp folder
		$this->_log_path = DNA_BASE_LOG_DIR;
		if (!file_exists($this->_log_path)) {
			mkdir($this->_log_path, 0755, true);
		}
	}

	public function get_log($type = null) {
		if(!$type) {
			return false;
		}
		$file = DNA_BASE_LOG_DIR . '/log.'.$type.'.txt';
		if (file_exists($file)) {
			$log_content = file_get_contents($file);
		}
		return $log_content;
	}

	public function add_log($type = null, $log) {
		if(!$type || !$log) {
			return false;
		}
		$file = DNA_BASE_LOG_DIR . '/log.'.$type.'.txt';
		if (!file_exists($file)) {
			$fp = fopen($file,"wb");
			fwrite($fp,'');
			fclose($fp);
		}
		$log_content = file_get_contents($file);

		$timeFormat = 'Y-m-d H:i:s';
		$currentDate = date_i18n( $timeFormat );

		if(is_array($log)) {
			foreach ($log as $_log) {
				$log_content .= $currentDate.' : '.$_log."\n";
			}
		}
		else {
			$log_content .= $currentDate.' : '.$log."\n";
		}
		file_put_contents($file, $log_content);
	}

	public function clear_log($type = null) {
		if(!$type) {
			return false;
		}
		$file = DNA_BASE_LOG_DIR . '/log.'.$type.'.txt';
		if (file_exists($file)) {
			$log_content = '';
			file_put_contents($file, $log_content);
		}
	}

}