<?php
/**
 * Common Functions
 *
 * @package WordPress
 * @subpackage Rubis
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */
if (!defined('DNA_RUBIS_VERSION')) exit;


function rubis_mail($type, $subject, $to, $headline, $fields) {
	$websiteEmail = get_bloginfo('admin_email');
	$headers = array('From: Site Internet RUBIS <'.$websiteEmail.'>', "Content-type: text/html; charset=UTF-8'");

	if (file_exists(DNA_RUBIS_INCLUDES_DIR. '/mail/'.$type.'.php')) {

		ob_start();
		include(DNA_RUBIS_INCLUDES_DIR. '/mail/'.$type.'.php');
		$mail_template = ob_get_clean();
		// send email
	    add_filter('wp_mail_content_type', function( $content_type ) {
	        return 'text/html';
	    });

	    return wp_mail($to, $subject, $mail_template, $headers);
	}
	return false;
}

function closetags($html) {
   preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
   $openedtags = $result[1];
   preg_match_all('#</([a-z]+)>#iU', $html, $result);
   $closedtags = $result[1];
   $len_opened = count($openedtags);
   if (count($closedtags) == $len_opened) {
       return $html;
   }
   $openedtags = array_reverse($openedtags);
   for ($i=0; $i < $len_opened; $i++) {
       if (!in_array($openedtags[$i], $closedtags)) {
           $html .= '</'.$openedtags[$i].'>';
       } else {
           unset($closedtags[array_search($openedtags[$i], $closedtags)]);
       }
   }
   return $html;
}

function get_last_actus() {
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 3,
	);

	$actus = get_posts($args);

	return $actus;
}

function get_item_menu_active($curr_id, $page_link) {
	$class = '';
	// var_dump($page_link);
	if (isset($page_link["url"]) && $page_link["url"] != "") {
		if (get_the_ID() == url_to_postid($page_link["url"])
		|| (wp_get_post_parent_id(get_the_ID()) ==  url_to_postid($page_link["url"]))) {
			$class = 'active';
		}
	}
	 return $class;
}

function sync_news($data) {
	$sync_news = new Dna_Sync_News();
	$sync_news->sync_news_process();
	var_dump('finish');
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'syncnews/v1', '/token/(?P<token>\d+)', array(
    'methods' => 'GET',
    'callback' => 'sync_news',
  ) );
} );
