<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
*  Template Name: Map implantation
 * @package WordPress
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */
?>
<?php get_header(); ?>

<?php get_template_part('components/modules/module', 'header-page', array(
    'header_page' => get_field('header_page'),
)); ?>


<?php get_template_part('components/modules/module', 'map-implantation', array(
    'cont' => get_continent(),
    'implantations' => get_posts(array(
        'post_type' => 'implantation',
        'posts_per_page' => -1,
    )),
    'countries' => get_all_coutries(),
    'countries_sort_cont' => get_countries_by_continent(),
)); ?>


<?php get_footer(); ?>