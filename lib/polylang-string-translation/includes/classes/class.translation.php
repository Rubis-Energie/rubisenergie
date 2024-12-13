<?php
/**
 * Theme File Parser Class
 *
 * @package WordPress
 * @subpackage Polylang String Translation
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 */

class PolylangFileParser {

	protected $_reqDir;

	protected $_pattern = '/(__|_e)\((\'|\")(.+?)(\'|\")\)/';

	protected $_skipFiles = array('.', '..', '.DS_Store');

	protected $_fileExtensions = array('php');

	protected $_filesList = false;

	protected $_getTextStrings = array();

	protected $_initialTranslateIds = array(
		'translate' => 1,
        '_'    => 1,
        '__'    => 1,
        '_e' => 1,
        '_x' => 1,
        '_ex' => 1,
        '_nx' => 1,
        'esc_attr__' => 1,
        'esc_attr_e' => 1,
        'esc_attr_x' => 1,
        'esc_html__' => 1,
        'esc_html_e' => 1,
        'esc_html_x' => 1
	);

	protected $_translateIds = array(
        'pll__'    => 1,
        'pll_e'    => 1
	);
	
	/**
	 * PHP5 constructor method.
	 *
	 * @since 1.0
	 */
	public function __construct($reqDir, $isPlugin = false) {
		$this->_reqDir = $reqDir;
		if($isPlugin && is_array($this->_reqDir)) {
			$pluginsFolders = substr(PST_PLUGIN_DIR, 0, strrpos(PST_PLUGIN_DIR, "/"));
			$fileLists = array();
			foreach ($this->_reqDir as $kDir => $_dir) {
				$cList = $this->_getDirContents($pluginsFolders.'/'.$_dir);
				$fileLists = array_merge($fileLists, $cList);
			}
			if($fileLists) {
				$this->_filesList = array_values($fileLists);
			}
		}
		else {
			$this->_filesList = $this->_getDirContents($this->_reqDir);	
		}
	}


	/**
     * Parse the entire directory
     * 
     * @since 1.0
     */
	protected function _getDirContents($dir, &$results = array()){
	    $files = scandir($dir);
	    foreach($files as $key => $value){
	        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
	        if(!is_dir($path) && !in_array($value, $this->_skipFiles)) {
	        	if(!in_array($this->_getFileExtension($path), $this->_fileExtensions)) {
	        		continue;
	        	}
	            $results[] = $path;
	        }
	        else if(is_dir($path) && !in_array($value, $this->_skipFiles)) {
	            $this->_getDirContents($path, $results);
	        }
	    }
	    return $results;
	}

	/**
     * Retrieve file extension
     * 
     * @since 1.0
     */
	protected function _getFileExtension($file) {
		return substr(strrchr($file,'.'),1);
	}

	/**
     * Parse File by file to find translation WP
     * 
     * @since 1.0
     */
	protected function _parseFile($file, $lines = array()) {
		if (!is_file($file))
			return false;

		
		$pInfo = pathinfo($file);
        $tokens = token_get_all(file_get_contents($file));
        $next = false;
        foreach ($tokens as $c) {
            if(is_array($c)) {
                if ($c[0] != T_STRING && $c[0] != T_CONSTANT_ENCAPSED_STRING) continue;
                if ($c[0] == T_STRING && isset($this->_translateIds[$c[1]])) {
                    $next = $this->_translateIds[$c[1]];
                    continue;
                }
                if ($c[0] == T_CONSTANT_ENCAPSED_STRING && $next == 1) {
                    $lines['strings'][] = substr($this->fixEscaping($c[1]), 1, -1);
                    $next = false; 
                }
            } else {
                if ($c == ')') $next = false;
                if ($c == ',' && $next != false) $next -= 1;
            }
        }
        return $lines;
	}

	/**
     * Removes backslashes from before primes and double primes in primed or double primed strings respectively
     * 
     * @since 1.0
     */
    protected function fixEscaping($string) {
        $prime = substr($string, 0, 1);
        $string = str_replace('\\' . $prime, $prime, $string);
        return $string;
    }

    /**
     * Parse All Files
     * 
     * @since 1.0
     */
	public function parse($plugin = false) {
		if($this->_filesList && is_array($this->_filesList) && count($this->_filesList > 0)) {
			foreach ($this->_filesList as $kf => $_file) {
				$this->_getTextStrings[$kf] = null;
				$lines = $this->_parseFile($_file, $this->_getTextStrings[$kf]);
				if($lines) {
					$this->_getTextStrings[$kf] = $lines;
					if($plugin) {
						$pluginsFolders = substr(PST_PLUGIN_DIR, 0, strrpos(PST_PLUGIN_DIR, "/"));
						$pName = str_replace($pluginsFolders, '', $_file);
						if(substr($pName, 0, 1) == '/') {
							$pName = substr($pName, 1);
							$pName = explode('/', $pName);
							$pName = $pName[0];
						}
						$this->_getTextStrings[$kf]['plugin_name'] = $pName;
					}
				}
			}
		}
		return $this->_getTextStrings;
	}
}