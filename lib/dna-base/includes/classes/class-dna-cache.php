<?php
/**
 * Caching Class
 *
 * @package WordPress
  * @subpackage BASE - @Plugin Principal
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

class Dna_Cache {

	protected $_cache_path;


	public function __construct() {
		// Detect & create temp folder
		$this->_cache_path = DNA_BASE_CACHING_DIR;
		if (!file_exists($this->_cache_path)) {
			mkdir($this->_cache_path, 0755, true);
		}
	}

	public function get_cache($type = null) {
		if(!$type) {
			return false;
		}
		$cache_content = '';
		$file = DNA_BASE_CACHING_DIR . '/'.$type.'.txt';
		if (file_exists($file)) {
			$cache_content = file_get_contents($file);
		}
		return $cache_content;
	}

	public function update_cache($type = null, $cache_content = null) {
		if(!$type || !$cache_content) {
			return false;
		}
		$file = DNA_BASE_CACHING_DIR . '/'.$type.'.txt';

		// UPDATE
		if (file_exists($file)) {
			file_put_contents($file, $cache_content);
		}
		// CREATE
		else {
			$fp = fopen($file,"wb");
			fwrite($fp,'');
			fclose($fp);
			file_put_contents($file, $cache_content);
		}
	}

}