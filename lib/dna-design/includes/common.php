<?php
/**
 * Common Functions
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

if (!defined('DNA_THEME_VERSION')) exit;

if (!function_exists('render')) {
    function render($template, $plugin, $args = array()) {
        if (class_exists('Dna_'.$plugin.'_Frontend')) {
            $class = 'Dna_'.$plugin.'_Frontend';
            $front = $class::get_instance();
            $htmlTpl = isset($args['template']) ? $args['template'] : $template;
            $front->$template($htmlTpl, $args);
        }
    }
}

/**
 * Set Global messages
 *
 */
if(!function_exists('set_global_message')) {
    function set_global_message($title, $message, $type = 'error') {
        $dna_message = Dna_Theme_Frontend::get_instance();
        $dna_message->set_global_message($title, $message, $type);
    }
}

/**
 * Get Global messages
 *
 */
if(!function_exists('get_global_message')) {
    function get_global_message() {
        $dna_message = Dna_Theme_Frontend::get_instance();
        $dna_message->get_global_message();
    }
}

/**
 * Retrieve Recaptcha Keys
 */
if (!function_exists('get_recaptcha')) {
    function get_recaptcha($full = false) {
        $gKeys = fo('google_recaptcha');
        if ($full) {
            return $gKeys;
        }
        else {
            return $gKeys['key'];
        }
    }
}

/**
 * Display Recaptcha Form
 */
if (!function_exists('display_recaptcha')) {
    function display_recaptcha($callback = false) {
        $dna_recaptcha = Dna_Theme_Frontend::get_instance();
        $dna_recaptcha->display_recaptcha($callback);
    }
}

/**
 * Retrieve Uploaded Image Logo Menu
 *
 */
if (!function_exists('get_logo_menu')) {
    function get_logo_menu() {
        $locations = get_nav_menu_locations();
        $menu_id = $locations[ 'header-menu' ];
        $menu = wp_get_nav_menu_object($menu_id);
        $logo = f('main_logo', $menu);
        return $logo;
    }
}

/**
 * Retrieve Menu Title
 *
 */
if (!function_exists('get_menu_title')) {
    function get_menu_title($name) {
        $locations = get_nav_menu_locations();
        $menu_id = $locations[ $name ];
        $menu = wp_get_nav_menu_object($menu_id);
        return $menu ? $menu->name : '';
    }
}

/**
 * Retrieve Uploaded Image Relative
 */
if(!function_exists('wpImage')) {
    function wpImage($file, $src = false, $full = false) {
        if ($src) {
            $filePath = explode('uploads', $file);
        }
        else {
            $filePath = explode('uploads', $file['url']);   
        }
        if (count($filePath) > 1) {
            if ($full) {
                $uploads = wp_upload_dir();
                $path = $uploads['path'];
                return $path.$filePath[1];
            }
            return '/uploads'.$filePath[1];
        }
        return $file['url'];
    }
}

if (!function_exists('fgc')) {
    function fgc($file, $path = '/img/') {
        if ($path == '')
            echo @file_get_contents($path.$file);
        else
            echo @file_get_contents(themeImage($path.$file));
    }
}

/**
 * Retrieve Theme Image Relative
 */
if(!function_exists('themeImage')) {
    function themeImage($file, $full = true) {
        $file = substr($file, 0, 1) == '/' ? $file : '/'.$file;
        $path = get_template_directory().$file;
        if (!$full) {
            $path = str_replace(WP_CONTENT_DIR, '', $path);
        } 
        return $path;
    }
}

if (!function_exists('break_word_first')) {
    function break_word_first($string, $cnt = 1) {
        if ($cnt <= 1) {
            $string = preg_replace('/ /', '<br />', $string, $cnt);
        }
        else {
            $str = explode(' ', $string);
            if (isset($str[$cnt-1])) {
                $str[$cnt-1] = $str[$cnt-1].' <br />';
                $string = implode(' ', $str);
            }
            else {
                $string = preg_replace('/ /', '<br />', $string, $cnt);
            }
        }
        return $string;
    }
}

/**
 * Check if file is SVG
 */
if (!function_exists('is_svg')) {
    function is_svg($file) {
        return preg_match('/svg/i', $file['mime_type']);
    }
}

/**
 * Cleared Body Class
 */
function get_dna_body_class( $class = '' ) {

    $classes = array();

    if (is_front_page()) {
        $classes[] = 'home';
    }

    if (is_user_logged_in()) {
        $classes[] = 'admin-body';
    }

    if ( ! empty( $class ) ) {
        if ( !is_array( $class ) )
            $class = preg_split( '#\s+#', $class );
        $classes = array_merge( $classes, $class );
    } else {
        // Ensure that we always coerce class to being an array.
        $class = array();
    }

    $classes = array_map( 'esc_attr', $classes );

    $classes = apply_filters( 'dna_body_class', $classes, $class );

    return array_unique( $classes );
}


/**
 * Video Type Detect
 */
if (!function_exists('video_url_detect')) {
    function video_url_detect($aUrl){
        if(strpos($aUrl, 'youtube') !== false) {
            // youtube
            return 'youtube';

        } elseif(strpos($aUrl, 'youtu.be') !== false) {
            // youtu.be
            return 'youtube';

        } elseif(strpos($aUrl, 'vimeo') !== false) {
            // vimeo
            return 'vimeo';

        } elseif(strpos($aUrl, 'dailymotion') !== false) {
            // dailymotion
            return 'dailymotion';

        } elseif(strpos($aUrl, 'dai.ly') !== false) {
            // dailymotion
            return 'dailymotion';
        }
    }
    return false;
}


/**
 * Video Player By Url
 */
if (!function_exists('video_url_player')) {
    function video_url_player($aUrl, $aWidth=640, $aHeight=360){
        $h = '';
        if(strpos($aUrl, 'youtube') !== false) {
            // youtube
            $d = strpos($aUrl, 'v=');
            if($d === false) return;
            $vid = substr($aUrl, $d+2);
            $h = '<iframe width="'.$aWidth.'" height="'.$aHeight.'" src="https://www.youtube.com/embed/'.$vid.'" frameborder="0" allowfullscreen></iframe>';

        } elseif(strpos($aUrl, 'youtu.be') !== false) {
            // youtu.be
            $d = strpos($aUrl, 'youtu.be/');
            if($d === false) return;
            $vid = substr($aUrl, $d+9);
            $h = '<iframe width="'.$aWidth.'" height="'.$aHeight.'" src="https://www.youtube.com/embed/'.$vid.'" frameborder="0" allowfullscreen></iframe>';

        } elseif(strpos($aUrl, 'vimeo') !== false) {
            // vimeo
            $d = strpos($aUrl, 'vimeo.com/');
            if($d === false) return;
            $vid = substr($aUrl, $d+10);
            $h = '<iframe src="https://player.vimeo.com/video/'.$vid.'" width="'.$aWidth.'" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';

        } elseif(strpos($aUrl, 'dailymotion') !== false) {
            // dailymotion
            $d = strpos($aUrl, 'video/');
            if($d === false) return;
            $f = strpos($aUrl, '_', $d);
            $vid = substr($aUrl, $d+6, $f-$d-6);
            $h = '<iframe frameborder="0" width="'.$aWidth.'" height="'.$aHeight.'" src="//www.dailymotion.com/embed/video/'.$vid.'" allowfullscreen></iframe>';

        } elseif(strpos($aUrl, 'dai.ly') !== false) {
            // dailymotion
            $d = strpos($aUrl, 'dai.ly/');
            if($d === false) return;
            $vid = substr($aUrl, $d+7);
            $h = '<iframe frameborder="0" width="'.$aWidth.'" height="'.$aHeight.'" src="//www.dailymotion.com/embed/video/'.$vid.'" allowfullscreen></iframe>';
        }
        return (empty($h) ? $aUrl:$h);
    }
}