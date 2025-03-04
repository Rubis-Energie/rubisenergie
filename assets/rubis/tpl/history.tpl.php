<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
*  Template Name: Histoire
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

<?php get_template_part('components/templates/template', 'history', array(
    'fields' => get_fields(),
)); ?>

<?php if (get_field("is_block_map")): ?>

    <?php get_template_part('components/blocks/block', 'map', array(
        'map' => fol('block_map'),
    )); ?>

<?php endif; ?>

<?php get_footer(); ?>