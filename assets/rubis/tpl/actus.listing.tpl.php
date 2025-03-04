<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
*  Template Name: Listing actualités
 * @package WordPress
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */
?>
<?php get_header(); ?>

<?php 

    global $wp_query;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 9,
        'paged' => $paged,
    );

    if (isset($_GET["cat"]) && $_GET["cat"] != "false") {
        $args["category_name"] = $_GET["cat"];
    }

    get_template_part('components/templates/template', 'listing-actus', array(
        'list' => new WP_Query($args),
        'themes' => get_terms('category'),
    )); 

?>

<?php if (get_field("is_block_map")): ?>

    <?php get_template_part('components/blocks/block', 'map', array(
        'map' => fol('block_map'),
    )); ?>

<?php endif; ?>

<?php get_footer(); ?>
