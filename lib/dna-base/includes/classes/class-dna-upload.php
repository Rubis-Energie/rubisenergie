<?php
/**
 * Upload Class
 *
 * @package WordPress
 * @subpackage BASE - @Plugin Principal
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

class Dna_Upload {

	protected $_upload_path;


	public function __construct($basePath = false) {
		if (!$basePath) {
			$basePath = DNA_BASE_TMP_DIR;
		}
		// Detect & create temp folder
		$this->_upload_path = $basePath;
		if (!file_exists($this->_upload_path)) {
			mkdir($this->_upload_path, 0755, true);
		}
	}

	public function upload($file, $file_types = false, $ext = false, $max_size  = false, $upath = false) {
		// A list of permitted file extensions
		$allowed = $file_types ? array_map('trim', explode(',', $file_types)) : array('png', 'jpg', 'gif','csv','pdf','doc','docx','xls','xlsx');
		if($ext) {
			$allowed = is_array($ext) ? $ext : array($ext);
		}
		// Init result
		$result['errors'] = false;
		$result['success'] = false;

		$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
		
		// Check if allowed extension
		if(!in_array(strtolower($extension), $allowed)) {
			$result['errors'] = array('type' => 'file_type', 'name' => $file['name']);
			return $result;
		}
		// Check filesize
		$default_size = 2048;
		$max_size = $max_size ? (int)$max_size : $default_size;
		$max_size = $max_size > 1000 ? ($max_size/1000) : $max_size;
		$max_size = ($max_size*1024)*1024; // MO TO KO
		if((int)$file['size'] > (int)$max_size) {
			$result['errors'] = array('type' => 'max_size', 'name' => $file['name']);
			return $result;
		}

		// Move to upload dir
		$uid = uniqid();
		if($upath)
			$this->_upload_path = $upath;

		$finalName = str_replace('.', '____', $file['name']);
		$finalName = sanitize_title($finalName);
		$finalName = str_replace('____', '.', $finalName);

		if(move_uploaded_file($file['tmp_name'], $this->_upload_path.'/'.$uid.'_'.$finalName)) {
			// Return filename
			$result['success'] = array('id' => $uid, 'name' => $finalName, 'file' => $this->_upload_path.'/'.$uid.'_'.$finalName);
			return $result;
		}
		$result['errors'] = 'general';
		return $result;
	}

	public function delete($files) {

		if($files && $files != "") {
			foreach ((array)$files as $_file) {
				if (file_exists($_file)) {
					unlink($_file);
				}
			}
		}
	}

}