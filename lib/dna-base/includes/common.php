<?php
/**
 * Common Functions
 *
 * @package WordPress
 * @subpackage BASE - @Plugin Principal
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

if (!defined('DNA_BASE_VERSION')) exit;

if (!function_exists('pll__')) {
    
    function pll__( $string ) {
        return is_scalar( $string ) ? __( $string, 'dna' ) : $string;
    }

    
    function pll_esc_html__( $string ) {
        return esc_html( pll__( $string ) );
    }

    
    function pll_esc_attr__( $string ) {
        return esc_attr( pll__( $string ) );
    }

    function pll_e( $string ) {
        echo pll__( $string );
    }

    function pll_esc_html_e( $string ) {
        echo pll_esc_html__( $string );
    }

    function pll_esc_attr_e( $string ) {
        echo pll_esc_attr__( $string );
    }

    function pll_current_language( $field = 'slug' ) {
        return false;
    }

    function pll_get_post($id) {
        return get_post($id);
    }
}

/**
 * Detect Ajax
 */
if(!function_exists('is_ajax')) {
    function is_ajax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
}

/**
 * Get current language
 */
if(!function_exists('get_current_lang')) {
    function get_current_lang() {
        $lang = pll_current_language() ? pll_current_language() : pll_default_language();
        return $lang;
    }
}

/**
 * function to get the page relation
 *
 */
if(!function_exists('get_page_relation_id')) {
    function get_page_relation_id($name_relation) {
        include_once(DNA_BASE_FRONTEND_DIR . '/class-dna-frontend.php');
        $dna_front = Dna_Frontend::get_instance();

        $relation_page_id = $dna_front->get_page_relation($name_relation);
        if ($relation_page_id) {
            return $relation_page_id;
        }

        return null;
    }
}

if (!function_exists('get_current_page')) {
    function get_current_page() {
        $post_type = get_current_post_type();
        if ($post_type == 'page') {
            global $post;
            if ($post->post_parent) {
                $ancestors = get_post_ancestors( $post );
                $ancestors[] = $post->ID;
                return $ancestors;
            }
            return $post->ID;
        }
    }
}


/**
 * Recursive search in array
 *
 * @return array
 */
if(!function_exists('search_key_arr')) {
    function search_key_arr($needle, $haystack, $parent = false) {
        if(array_key_exists($needle, $haystack)) {
            return $haystack[$needle];
        }
        foreach($haystack as $kelement => $element) {
            if(is_array($element) && search_key_arr($needle, $element, $parent)) {
                if($parent) {
                    return array($kelement => $element[$needle]);
                }
                else {
                    return $element;
                }
            }
        }
        return false;
    }
}

/**
 * Retrieve User Role
 */
if(!function_exists('get_user_role')) {
    function get_user_role() {
        global $current_user;
        $user_roles = $current_user->roles;
        $user_role = array_shift($user_roles);
        return $user_role;
    }
}

/**
 * Define Excerpt Length
 */
if(!function_exists('set_excerpt_length')) {
    function set_excerpt_length( $length = 11 ) {
        add_filter( 'excerpt_length', create_function( '$l', 'return ' . intval( $length ) . ';' ), 999 );
        add_filter( 'the_excerpt', create_function( '$e', 'remove_all_filters( "excerpt_length", 999 ); return $e;' ), 999 );
    }
}

/**
 * Get exerpt from Post Object
 */
if(!function_exists('get_post_obj_excerpt')) {
    function get_post_obj_excerpt($content, $excerpt_length = 20) {
        if ( '' != $content ) {
            $text = strip_shortcodes( $content );
            $text = apply_filters('the_content', $text);
            $text = str_replace(']]>', ']]>', $text);
            $excerpt_more = apply_filters('excerpt_more', ' ' . '(...)');
            $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
        }
        return apply_filters('the_excerpt', $text);
    }
}

/**
 * Get page level
 */
if(!function_exists('get_page_level')) {
    function get_page_level($post_id) {
        if(!$post_id) {
            return '0';
        }
        $ancestors = get_post_ancestors($post_id);
        $depth = count($ancestors);
        return $depth;
    }
}

/**
 * Deep Search In Array
 *
 * @param mixed array
 * @return array
 */
if(!function_exists('search_in_array')) {
    function search_in_array($needle, $haystack, $key = false, $preg = false, $kreturn = false) {
        if ($preg && !$key) {
            if (is_multi_array($haystack)) {
                foreach($haystack as $element) {
                    if (search_in_array($needle, $element, $key, $preg)) {
                        return true;
                    }
                }
            }
            else {
                $matches = preg_grep ('/'.$needle.'/i', $haystack);
                if($matches) {
                    return $matches;
                }    
            }
        }
        elseif ($preg && $key) {
            $cKeys = array_keys($haystack);
            foreach ($cKeys as $_cKey) {
                if(preg_match ('/'.$needle.'/i', $_cKey)) {
                    return $haystack[$_cKey];
                }
            }
            if($matches = preg_grep ('/'.$needle.'/i', $haystack)) {
                return $matches;
            }
        }
        else {
            if(is_array($haystack) && in_array($needle, $haystack)) {
                if($key) {
                    if(isset($haystack[$key]) && $haystack[$key] == $needle)
                        return $haystack;
                }
                else {
                    if ($kreturn) {
                        return array_search($needle, $haystack);
                    }
                    return $haystack;
                }
            }
        }
        if(is_array($haystack)) {
            foreach($haystack as $element) {
                if(is_array($element) && search_in_array($needle, $element, $key, $preg))
                    return $element;
            }
        }
        return false;
    }
}

function is_multi_array( $arr ) {
    rsort( $arr );
    return isset( $arr[0] ) && is_array( $arr[0] );
}

/**
 * Convert string to clean URL
 *
 * @return array
 */

if(!function_exists('to_clean_url')) {
    function to_clean_url($str, $simple = true) {
        if(!$simple) {
            $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
            $clean = strtolower(trim($clean, '-'));
            $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
        }
        else {
            $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
            $clean = strtolower(trim($clean, '-'));
        }
        return $clean;
    }
}

/**
 * Retrieve post by slug
 */
if(!function_exists('get_post_by_slug')) {
    function get_post_by_slug($slug) {
        $posts = get_posts(array(
            'name' => $slug,
            'posts_per_page' => 1,
            'post_status' => 'publish'
            ));
        if(!$posts ) {
            return false;
        }
        else {
            return isset($posts[0]) ? get_permalink($posts[0]->ID) : false;
        }
    }
}

/**
 * Retrieve post type
 */
if(!function_exists('get_current_post_type')) {
    function get_current_post_type() {
        global $post, $typenow, $current_screen;
        //we have a post so we can just get the post type from that
        if ( $post && $post->post_type )
            return $post->post_type;
        //check the global $typenow - set in admin.php
        elseif( $typenow )
            return $typenow;
        //check the global $current_screen object - set in sceen.php
        elseif( $current_screen && $current_screen->post_type )
            return $current_screen->post_type;
        //lastly check the post_type querystring
        elseif( isset( $_REQUEST['post_type'] ) )
            return sanitize_key( $_REQUEST['post_type'] );
        //we do not know the post type!
        return false;
    }
}

/**
 * Function ACF Options
 */
if(!function_exists('fo')) {
    function fo($name, $pop = false) {
        $op = get_field($name, 'options');
        $op = $pop ? ap($op) : $op;
        return $op;
    }
}

/**
 * Function ACF Options translate
 */
if(!function_exists('fol')) {
    function fol($name, $pop = false) {
        add_filter('acf/settings/current_language', 'dna_acf_settings_current_language', 100);
        $op = get_field($name, 'options');
        remove_filter('acf/settings/current_language', 'dna_acf_settings_current_language', 100);
        $op = $pop ? ap($op) : $op;
        return $op;
    }
}

/**
 * Function ACF Fields
 */
if(!function_exists('f')) {
    function f($name, $id = false, $pop = false) {
        $field = get_field($name, $id);
        if($field && $pop) {
            $op = ap($field);
            return $op;
        }
        return $field;
    }
}

/**
 * Function ACF Fields autoPop
 */
if(!function_exists('fp')) {
    
    function fp($name, $id = false) {
        $field = get_field($name, $id);
        if($field) {
            $op = ap($field);
            return $op;
        }
        return;
    }
}

/**
 * Remove Ptags
 */
function filterPtag($content){
    return preg_replace('#<p(.*?)>(.*?)</p>#is', '$2<br/>', $content);
}

/**
 * Array POP
 */
if(!function_exists('ap')) {
    function ap($op) {
        if(is_array($op)) {
            $op = array_pop($op);
        }
        return $op;
    }
}

/**
 * Retrive Page Translation According to Polylang
 */
function get_t_trans($id, $perm = true) {
    $tId = pll_get_post($id);
    if($perm)
        return get_permalink($tId);

    return $tId;
}

/**
 * All Translation Codes
 */
function get_langs_pll($keys = false) {
    $translations = pll_the_languages(array('raw'=>1));
    $langs = array();
    foreach ($translations as $_lang) {
        $langs[$_lang['slug']] = $_lang['name'];
    }
    if($keys)
        return array_keys($langs);

    return $langs;
}

/**
 * @param $text
 *
 * @return mixed
 */
function clean_string($text) {
    $text = trim($text);
    $utf8 = array(
        '/[áàâãªä]/u'   =>   'a',
        '/[ÁÀÂÃÄ]/u'    =>   'A',
        '/[ÍÌÎÏ]/u'     =>   'I',
        '/[íìîï]/u'     =>   'i',
        '/[éèêë]/u'     =>   'e',
        '/[ÉÈÊË]/u'     =>   'E',
        '/[óòôõºö]/u'   =>   'o',
        '/[ÓÒÔÕÖ]/u'    =>   'O',
        '/[úùûü]/u'     =>   'u',
        '/[ÚÙÛÜ]/u'     =>   'U',
        '/ç/'           =>   'c',
        '/Ç/'           =>   'C',
        '/ñ/'           =>   'n',
        '/Ñ/'           =>   'N',
        '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
        '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
        '/[\'\']/u'     =>   ' ', // Simple quote
        '/[“”«»„]/u'    =>   ' ', // Double quote
        '/ /'           =>   ' ', // Nonbreaking space (equiv. to 0x160)
        '/\\\/u'        =>   ''   // Backslashes
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $text);
}

function make_slug($str) { 
    if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
        $str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
    $str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
    $str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
    $str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
    $str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
    $str = strtolower( trim($str, '-') );
    $str = substr($str, 0, 100);
    return $str;
}

/**
 * @param $text
 *
 * @return string
 */
function clean_string_tolower($text) {
    $text = strtolower(clean_string($text));
    return preg_replace('/ /', '-', $text);
}

/* --------------------------------------------------------------*/
/* ------------------------- ACF Hooks ------------------------- */
/* --------------------------------------------------------------*/

function dna_option_acf_load_value( $value, $post_id, $field )
{
    if (strstr($field['_name'], 'option_lang')) {
        $lang = get_current_lang();

        if ($value) {

            // if string, decode value and keep the current language
            // else if array, decode only sub array and keep array structure.
            if(!is_array($value)) {
                $values = json_decode($value, true);
                $value = isset($values[$lang]) ? $values[$lang] : null;
            } else {
                $value = isset($value[$lang]) ? json_decode($value[$lang]) : null;
            }

        }
    }

    return $value;
}
add_filter('acf/load_value', 'dna_option_acf_load_value', 10, 3);


function dna_option_acf_update_value( $value, $post_id, $field  )
{
    if (strstr($field['_name'], 'option_lang') && !isset($field['sub_fields'])) {
        $lang = get_current_lang();

        // If repeater
        if ($field['parent'] && !is_numeric($field['parent'])) {
            global $wpdb;

            $rawValue = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT option_name FROM {$wpdb->options} WHERE option_value = %s",
                    $field['key']
                )
            );

            //$rawValue = $wpdb->get_row("SELECT option_name FROM $wpdb->options WHERE option_value = '" . $field['key'] . "'");
            if ($rawValue) {
                $tabValue = get_option(ltrim($rawValue->option_name, '_'));
            } else {
                $tabValue = null;
            }
        } else {
            $tabValue = get_option('options_' . $field['name'] );
        }

        // if array, decode only sub array, to keep array structure
        // else if string, decode the return value
        if(!is_array($tabValue)) {
            $values = json_decode($tabValue, true);
        } else {
            foreach ($tabValue as $key => $tabs) {
                $values[$key] = json_decode($tabs);
            }
        }

        // check if array to encode only values and keep returning array at the end
        // if string, return json encoded string
        if (!is_array($value)) {
            $values[$lang] = $value;
            $value = json_encode($values, JSON_UNESCAPED_UNICODE);
         } else {
            $values[$lang] = $value;
            $value = array();
            foreach ($values as $key => $val) {
                $value[$key] = json_encode($val, JSON_UNESCAPED_UNICODE);
            }
         }
    }

    return $value;
}
add_filter('acf/update_value', 'dna_option_acf_update_value', 10, 3);


function dna_acf_load_field( $field )
{
    if (strstr($field['_name'], 'option_lang')) {
        if (strpos($_SERVER['PHP_SELF'], "post.php") === false) {
            $field['label'] = $field['label'] . ' (<span class="infoField">Multilangue</span>)';
        }
    }
    return $field;
}

// acf/load_field - filter for every field
add_filter('acf/load_field', 'dna_acf_load_field');

// HOOK global translate option
function dna_acf_settings_default_language( $language ) {
    return 'fr';
}
add_filter('acf/settings/default_language', 'dna_acf_settings_default_language', 10);

function dna_acf_settings_current_language( $language ) {
    return pll_current_language();
}

function dna_acf_settings_language( $language ) {
    if (is_admin() && defined('POLYLANG_VERSION')) {
        if ( function_exists( 'get_current_screen' ) ) {
            $option = get_current_screen();
            if ($option) {
                if(strstr($option->base,'option_lang')) {
                    return pll_current_language();
                }
            }
        }
    }

    return 'fr';
}
add_filter('acf/settings/current_language', 'dna_acf_settings_language', 10);


/**
 * Trim Sentence And Keep HTML Tags
 */
if(!function_exists('custom_trim_words')) {
    function custom_trim_words( $text, $num_words = 55, $more = null ) {
        if ( null === $more )
            $more = __( '&hellip;' );
        $original_text = $text;
        $text = strip_shortcodes( $text );
        // Add tags that you don't want stripped
        $text = strip_tags( $text, '<strong>, <b>, <em>, <i>' );
        if ( 'characters' == _x( 'words', 'word count: words or characters?' ) && preg_match( '/^utf\-?8$/i', get_option( 'blog_charset' ) ) ) {
            $text = trim( preg_replace( "/[\n\r\t ]+/", ' ', $text ), ' ' );
            preg_match_all( '/./u', $text, $words_array );
            $words_array = array_slice( $words_array[0], 0, $num_words + 1 );
            $sep = '';
        } else {
            $words_array = preg_split( "/[\n\r\t ]+/", $text, $num_words + 1, PREG_SPLIT_NO_EMPTY );
            $sep = ' ';
        }
        if ( count( $words_array ) > $num_words ) {
            array_pop( $words_array );
            $text = implode( $sep, $words_array );
            $text = $text . $more;
        } else {
            $text = implode( $sep, $words_array );
        }
        return apply_filters( 'custom_trim_words', $text, $num_words, $more, $original_text );
    }
}

if(!function_exists('custom_trim_text')) {
    function custom_trim_text( $text, $num_words = 55, $more = null) {
        $out = strlen($text) > $num_words ? mb_substr($text,0,$num_words)."..." : $text;
        return $out;
    }
}

/**
 * Function Bootstrap Center Columns
 */
if(!function_exists('get_bootstrap_center_col')) {
    function get_bootstrap_center_col($items, $i) {
        $perLine = 3;
        if ($items%$perLine == 0) {
            return 'col-md-4';
        }
        $rows = ceil($items/$perLine);
        $cl = ceil($i/$perLine);
        $ll = $items%$perLine;
        
        $calc = $items-$i;

        if ($cl == $rows) { // last line

            if ($items == 1) { // One Item Only
                return 'col-md-4 col-md-offset-4';
            }
            else {
                $calRest = $i-1;
                $rest = $items-$calRest;

                if($rest == 1) {
                    if ($calRest%$perLine == 0) {
                        return 'col-md-4 col-md-offset-4';
                    }
                    else {
                        return 'col-md-4';
                    }
                }
                if ($rest == 2 && $i < $items) {
                    return 'col-md-4 col-md-offset-2';
                }
                if ($rest == 2 && $i == $items) {
                    return 'col-md-4';
                }
                return 'col-md-4';
            }
        }
        else {
            return 'col-md-4';
        }
    }
}


function printTruncated($html, $maxLength, $suffix, $isUtf8=true)
{
    $printedLength = 0;
    $position = 0;
    $tags = array();

    // For UTF-8, we need to count multibyte sequences as one character.
    $re = $isUtf8
        ? '{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;|[\x80-\xFF][\x80-\xBF]*}'
        : '{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;}';

    while ($printedLength < $maxLength && preg_match($re, $html, $match, PREG_OFFSET_CAPTURE, $position))
    {
        list($tag, $tagPosition) = $match[0];

        // Print text leading up to the tag.
        $str = substr($html, $position, $tagPosition - $position);
        if ($printedLength + strlen($str) > $maxLength)
        {
            echo substr($str, 0, $maxLength - $printedLength);
            $printedLength = $maxLength;
            break;
        }

        echo $str;
        $printedLength += strlen($str);
        if ($printedLength >= $maxLength) break;

        if ($tag[0] == '&' || ord($tag) >= 0x80)
        {
            // Pass the entity or UTF-8 multibyte sequence through unchanged.
            echo $tag;
            $printedLength++;
        }
        else
        {
            // Handle the tag.
            $tagName = $match[1][0];
            if ($tag[1] == '/')
            {
                // This is a closing tag.

                $openingTag = array_pop($tags);
                assert($openingTag == $tagName); // check that tags are properly nested.

                echo $tag;
            }
            else if ($tag[strlen($tag) - 2] == '/')
            {
                // Self-closing tag.
                echo $tag;
            }
            else
            {
                // Opening tag.
                echo $tag;
                $tags[] = $tagName;
            }
        }

        // Continue after the tag.
        $position = $tagPosition + strlen($tag);
    }

    // Print any remaining text.
    if ($printedLength < $maxLength && $position < strlen($html))
        echo substr($html, $position, $maxLength - $printedLength);

    // Close any open tags.
    while (!empty($tags))
        echo sprintf('</%s>', array_pop($tags));
}

/**
 * Clean String To URL Slug
 *
 * @return string
 */
function clean_string_url($str, $lowerCase = true) {

    $_convertTable = array(
        '&amp;' => 'and',   '@' => 'at',    '©' => 'c', '®' => 'r', 'À' => 'a',
        'Á' => 'a', 'Â' => 'a', 'Ä' => 'a', 'Å' => 'a', 'Æ' => 'ae','Ç' => 'c',
        'È' => 'e', 'É' => 'e', 'Ë' => 'e', 'Ì' => 'i', 'Í' => 'i', 'Î' => 'i',
        'Ï' => 'i', 'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Õ' => 'o', 'Ö' => 'o',
        'Ø' => 'o', 'Ù' => 'u', 'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u', 'Ý' => 'y',
        'ß' => 'ss','à' => 'a', 'á' => 'a', 'â' => 'a', 'ä' => 'a', 'å' => 'a',
        'æ' => 'ae','ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
        'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ò' => 'o', 'ó' => 'o',
        'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u',
        'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'þ' => 'p', 'ÿ' => 'y', 'Ā' => 'a',
        'ā' => 'a', 'Ă' => 'a', 'ă' => 'a', 'Ą' => 'a', 'ą' => 'a', 'Ć' => 'c',
        'ć' => 'c', 'Ĉ' => 'c', 'ĉ' => 'c', 'Ċ' => 'c', 'ċ' => 'c', 'Č' => 'c',
        'č' => 'c', 'Ď' => 'd', 'ď' => 'd', 'Đ' => 'd', 'đ' => 'd', 'Ē' => 'e',
        'ē' => 'e', 'Ĕ' => 'e', 'ĕ' => 'e', 'Ė' => 'e', 'ė' => 'e', 'Ę' => 'e',
        'ę' => 'e', 'Ě' => 'e', 'ě' => 'e', 'Ĝ' => 'g', 'ĝ' => 'g', 'Ğ' => 'g',
        'ğ' => 'g', 'Ġ' => 'g', 'ġ' => 'g', 'Ģ' => 'g', 'ģ' => 'g', 'Ĥ' => 'h',
        'ĥ' => 'h', 'Ħ' => 'h', 'ħ' => 'h', 'Ĩ' => 'i', 'ĩ' => 'i', 'Ī' => 'i',
        'ī' => 'i', 'Ĭ' => 'i', 'ĭ' => 'i', 'Į' => 'i', 'į' => 'i', 'İ' => 'i',
        'ı' => 'i', 'Ĳ' => 'ij','ĳ' => 'ij','Ĵ' => 'j', 'ĵ' => 'j', 'Ķ' => 'k',
        'ķ' => 'k', 'ĸ' => 'k', 'Ĺ' => 'l', 'ĺ' => 'l', 'Ļ' => 'l', 'ļ' => 'l',
        'Ľ' => 'l', 'ľ' => 'l', 'Ŀ' => 'l', 'ŀ' => 'l', 'Ł' => 'l', 'ł' => 'l',
        'Ń' => 'n', 'ń' => 'n', 'Ņ' => 'n', 'ņ' => 'n', 'Ň' => 'n', 'ň' => 'n',
        'ŉ' => 'n', 'Ŋ' => 'n', 'ŋ' => 'n', 'Ō' => 'o', 'ō' => 'o', 'Ŏ' => 'o',
        'ŏ' => 'o', 'Ő' => 'o', 'ő' => 'o', 'Œ' => 'oe','œ' => 'oe','Ŕ' => 'r',
        'ŕ' => 'r', 'Ŗ' => 'r', 'ŗ' => 'r', 'Ř' => 'r', 'ř' => 'r', 'Ś' => 's',
        'ś' => 's', 'Ŝ' => 's', 'ŝ' => 's', 'Ş' => 's', 'ş' => 's', 'Š' => 's',
        'š' => 's', 'Ţ' => 't', 'ţ' => 't', 'Ť' => 't', 'ť' => 't', 'Ŧ' => 't',
        'ŧ' => 't', 'Ũ' => 'u', 'ũ' => 'u', 'Ū' => 'u', 'ū' => 'u', 'Ŭ' => 'u',
        'ŭ' => 'u', 'Ů' => 'u', 'ů' => 'u', 'Ű' => 'u', 'ű' => 'u', 'Ų' => 'u',
        'ų' => 'u', 'Ŵ' => 'w', 'ŵ' => 'w', 'Ŷ' => 'y', 'ŷ' => 'y', 'Ÿ' => 'y',
        'Ź' => 'z', 'ź' => 'z', 'Ż' => 'z', 'ż' => 'z', 'Ž' => 'z', 'ž' => 'z',
        'ſ' => 'z', 'Ə' => 'e', 'ƒ' => 'f', 'Ơ' => 'o', 'ơ' => 'o', 'Ư' => 'u',
        'ư' => 'u', 'Ǎ' => 'a', 'ǎ' => 'a', 'Ǐ' => 'i', 'ǐ' => 'i', 'Ǒ' => 'o',
        'ǒ' => 'o', 'Ǔ' => 'u', 'ǔ' => 'u', 'Ǖ' => 'u', 'ǖ' => 'u', 'Ǘ' => 'u',
        'ǘ' => 'u', 'Ǚ' => 'u', 'ǚ' => 'u', 'Ǜ' => 'u', 'ǜ' => 'u', 'Ǻ' => 'a',
        'ǻ' => 'a', 'Ǽ' => 'ae','ǽ' => 'ae','Ǿ' => 'o', 'ǿ' => 'o', 'ə' => 'e',
        'Ё' => 'jo','Є' => 'e', 'І' => 'i', 'Ї' => 'i', 'А' => 'a', 'Б' => 'b',
        'В' => 'v', 'Г' => 'g', 'Д' => 'd', 'Е' => 'e', 'Ж' => 'zh','З' => 'z',
        'И' => 'i', 'Й' => 'j', 'К' => 'k', 'Л' => 'l', 'М' => 'm', 'Н' => 'n',
        'О' => 'o', 'П' => 'p', 'Р' => 'r', 'С' => 's', 'Т' => 't', 'У' => 'u',
        'Ф' => 'f', 'Х' => 'h', 'Ц' => 'c', 'Ч' => 'ch','Ш' => 'sh','Щ' => 'sch',
        'Ъ' => '-', 'Ы' => 'y', 'Ь' => '-', 'Э' => 'je','Ю' => 'ju','Я' => 'ja',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e',
        'ж' => 'zh','з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l',
        'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's',
        'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
        'ш' => 'sh','щ' => 'sch','ъ' => '-','ы' => 'y', 'ь' => '-', 'э' => 'je',
        'ю' => 'ju','я' => 'ja','ё' => 'jo','є' => 'e', 'і' => 'i', 'ї' => 'i',
        'Ґ' => 'g', 'ґ' => 'g', 'א' => 'a', 'ב' => 'b', 'ג' => 'g', 'ד' => 'd',
        'ה' => 'h', 'ו' => 'v', 'ז' => 'z', 'ח' => 'h', 'ט' => 't', 'י' => 'i',
        'ך' => 'k', 'כ' => 'k', 'ל' => 'l', 'ם' => 'm', 'מ' => 'm', 'ן' => 'n',
        'נ' => 'n', 'ס' => 's', 'ע' => 'e', 'ף' => 'p', 'פ' => 'p', 'ץ' => 'C',
        'צ' => 'c', 'ק' => 'q', 'ר' => 'r', 'ש' => 'w', 'ת' => 't', '™' => 'tm'," " => "-", "\n" => '-',
    );

    $convert = strtr($str, $_convertTable);
    $text = preg_replace('~[^\pL\d]+~u', '-', $convert);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return $lowerCase ? strtolower($text) : $text;
} 