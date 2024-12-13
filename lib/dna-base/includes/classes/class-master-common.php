<?php
/**
 * Master class
 *
 * @package WordPress
 * @subpackage BASE - @Plugin Principal
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

class Master_Common {

    private static $_instance = array();

    /**
     * Magic function :
     *     Exemple : Display my.template.php if method displayMyTemplate() is call
     */
    public function __call($name, $arguments = array())
    {
        $function = explode(' ',trim(preg_replace('#([A-Z])#',' $1',$name)));
        if ($function[0] == 'display') {
            unset($function[0]);
            $templateName = strtolower(implode('.', $function));
            $this->display_template($templateName, $arguments);
        }
    }

    /**
    * Method singleton
    * @param void
    * @return Singleton
    */
    public static function get_instance() {
        $class = get_called_class();

        if(!isset(self::$_instance[$class])) {
            self::$_instance[$class] = new static();
        }

        return self::$_instance[$class];
    }

    /**
     * Get plugin directory of child class
     * @return [string] Full path or directory
     */
    protected function get_child_plugin($plugin_name = false) {
        $reflector = new ReflectionClass($this);
        $fn = $reflector->getFileName();

        if ($plugin_name) {
            return dirname(plugin_basename( $fn ));
        }

        return plugin_dir_path( $fn );
    }

    /**
     * Display template $name.php from current_theme/plugins/plugin/views/
     * if not exist, search this template on current plugin
     * @param  [string] $name [Template name]
     */
    public function display_template($name, $vars = array()) {
        $plugin_path = $this->get_child_plugin();
        $plugin_name = $this->get_child_plugin(true);

        extract($vars);
        $themePlugin = str_replace('frontend', '', $plugin_name);
        $theme_file = locate_template('plugins/'.$themePlugin.$name.'.php');

        $template_file = $theme_file ? $theme_file : $plugin_path.'views/'.$name.'.php';
        if (file_exists($template_file)) {
            require($template_file);
        }
        else {
            if (WP_DEBUG) {
                echo "-- $name : INTROUVABLE --<br />";
            }
        }
    }

    /**
     * Include template $name.php from current_theme/plugins/plugin/views/
     * if not exist, search this template on current plugin
     * @param  [string] $name [Template name]
     */
    public function include_template($name) {
        $plugin_path = $this->get_child_plugin();
        $plugin_name = $this->get_child_plugin(true);


        $themePlugin = str_replace('frontend', '', $plugin_name);
        $theme_file = locate_template('plugins/'.$themePlugin.$name.'.php');

        $template_file = $theme_file ? $theme_file : $plugin_path.'views/'.$name.'.php';

        if (file_exists($template_file)) {
            return $template_file;
        }
        else {
            if (WP_DEBUG) {
                echo "-- $name : INTROUVABLE --<br />";
            }
        }
    }
}
