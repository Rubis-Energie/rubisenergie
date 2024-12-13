<?php
/**
 * Security class
 *
 * @package WordPress
 * @subpackage BASE - @Plugin Principal
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

class Dna_Security {

	/*================================================================================== */
	/* Secutity HACKS ================================================================== */

	public function init() {

		// Remove version number
		remove_action('wp_head', 'wp_generator');
		// remove windows live writer support
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action ('wp_head', 'rsd_link');
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );

		/**
		 * Remove RSS
		*/
		add_action('do_feed', array(&$this,'disable_feed'));
		add_action('do_feed_rdf', array(&$this,'disable_feed'));
		add_action('do_feed_rss', array(&$this,'disable_feed'));
		add_action('do_feed_rss2', array(&$this,'disable_feed'));
		add_action('do_feed_atom', array(&$this,'disable_feed'));

		/**
		 * Remove Headers links
		*/
		add_action('init', array(&$this,'remove_head_links'));

		/**
		 * Remove Headers JSON
		*/
		add_filter('wpseo_json_ld_output', array(&$this,'remove_yoast_json'), 10, 1);

		/**
		 * Remove direct Access & give 404
		*/
		add_action( 'template_redirect', array(&$this,'remove_direct_access'));

		/**
		 * Disable Author page
		*/
		add_action( 'author_link', array(&$this,'remove_author_pages_link'));
		/**
		 * Remove some body classes
		*/
		add_filter('body_class', array(&$this,'remove_body_class'), 20, 2);
		/**
		 * Remove Pingback
		*/
		add_filter( 'xmlrpc_methods', array(&$this,'remove_pingback_method'));
	}

	/*================================================================================== */
	/* Admin view & HACKS ============================================================== */

	public function admin_update() {

		/**
		 * Remove admin metaboxs
		*/
		add_filter('add_meta_boxes', array(&$this,'remove_meta_boxes'));
		add_filter( 'wpseo_metabox_prio', function() { return 'low';});

		/**
		 * Adding custom admin JS
		*/
		if (is_admin()){
			add_action('in_admin_footer', array(&$this,'addAdminJsHack')); // Global Admin JS Hack
		}

		/**
		 * Admin Tweaks
		*/
		// No self ping
		add_action( 'pre_ping', array(&$this, 'noSelfPing' ));
		// Enable more buttons in tinyMCE
		add_filter('mce_buttons',  array(&$this, 'enableMoreButtons'));
		// Remove various items from dashboard.
		add_action('admin_menu', array(&$this,'customDashboardWidgets'));
	}

	/**
	 * Remove RSS
	*/
	function disable_feed() {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		get_template_part( 404 ); exit();
	}

	/**
	 * Remove Headers links
	*/
	function remove_head_links() {
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'rest_output_link_wp_head' );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'index_rel_link' ); // index link
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
		remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
		remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
		remove_action('wp_head', 'wp_resource_hints', 2);

		remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
	}

	/**
	 * Remove Headers Json
	*/
	function remove_yoast_json($data){
		$data = array();
		return $data;
	}

	/**
	 * Remove direct Access & give 404
	*/
	function remove_direct_access() {
		//if ( is_author() || get_current_post_type() == 'faq' ) { // ADD Custom Type
		if ( is_author() || get_current_post_type() == 'videos' ) {
			global $wp_query;
			$wp_query->set_404();
			status_header( 404 );
			get_template_part( 404 ); exit();
		}
	}

	/**
	 * Disable Author page
	*/
	function remove_author_pages_link( $content ) {
		return get_option( 'home' );
	}

	/**
	 * Remove admin metaboxs
	*/
	function remove_meta_boxes() {
		// Add all unwanted boxs
		//remove_meta_box('wpseo_meta', 'videos', 'normal');
		//remove_meta_box('tagsdiv-post_tag', 'post', 'side');
		//remove_meta_box('postimagediv', 'post', 'side');
	}

	/**
	 * Adding custom admin JS
	*/
	function addAdminJsHack() {
	/*	$role = get_user_role();
		$adminUpdate = locate_template('library/admin/js/admin.update.js.php');
		include($adminUpdate);*/
	}

	/**
	 * Admin Tweaks
	*/
	function noSelfPing( &$links ) {
		$home = get_option( 'home' );
		foreach ( $links as $l => $link )
			if ( 0 === strpos( $link, $home ) )
				unset($links[$l]);
	}
	function enableMoreButtons($buttons) {
		$buttons[] = 'hr';
		/*
		Repeat with any other buttons you want to add, e.g.
		  $buttons[] = 'fontselect';
		  $buttons[] = 'sup';
		*/
	  return $buttons;
	}

	function customDashboardWidgets() {
		// remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' ); // Right Now Widget
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' ); // Comments Widget
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' ); // Incoming Links Widget
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' ); // Plugins Widget
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'core' ); // Quick Press Widget
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' ); // Recent Drafts Widget
		remove_meta_box( 'dashboard_primary', 'dashboard', 'core' ); //
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );//
		remove_meta_box( 'postimagediv', 'page', 'normal' );//
		
		// removing plugin dashboard boxes
		//remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal' ); // Yoast's SEO Plugin Widget
		remove_meta_box( 'icl_dashboard_widget', 'dashboard', 'normal' ); // WPML
	}

	// Remove some classes from body
	function remove_body_class($wp_classes) {
		if($unClass = search_in_array('term-([0-9]+)', $wp_classes, false, true)) {
			foreach ($unClass as $un_Key => $un_value) {
				unset($wp_classes[$un_Key]);
			}
		}
		if($unClass = search_in_array('tax-', $wp_classes, false, true)) {
			foreach ($unClass as $un_Key => $un_value) {
				unset($wp_classes[$un_Key]);
			}
		}
		if($unClass = search_in_array('page-id', $wp_classes, false, true)) {
			foreach ($unClass as $un_Key => $un_value) {
				unset($wp_classes[$un_Key]);
			}
		}
		if($unClass = search_in_array('postid-', $wp_classes, false, true)) {
			foreach ($unClass as $un_Key => $un_value) {
				unset($wp_classes[$un_Key]);
			}
		}
		if($unClass = search_in_array('category-([0-9]+)', $wp_classes, false, true)) {
			foreach ($unClass as $un_Key => $un_value) {
				unset($wp_classes[$un_Key]);
			}
		}
		if($unClass = search_in_array('page-template-templates', $wp_classes, false, true)) {
			foreach ($unClass as $un_Key => $un_value) {
				$wp_classes[$un_Key] = str_replace('page-template-templatestpl-', '', $wp_classes[$un_Key]);
				$wp_classes[$un_Key] = str_replace('-php', '', $wp_classes[$un_Key]);
			}
		}
		if($unClass = search_in_array('page-template', $wp_classes, false, true)) {
			$k = array_keys($unClass);
			$k = array_pop($k);
			unset($wp_classes[$k]);
		}
		return $wp_classes;
	}

	function remove_pingback_method( $methods ) {
		unset( $methods['pingback.ping'] );
		unset( $methods['pingback.extensions.getPingbacks'] );
		return $methods;
	}
}

$dna_security = new Dna_Security();
$dna_security->init();
$dna_security->admin_update();