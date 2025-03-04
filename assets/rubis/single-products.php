<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
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


<?php render('list_blocks', 'Cms'); ?>

<?php if (get_field("is_block_prd")): ?>

    <?php get_template_part('components/blocks/block', 'product', array(
        'product' => fol('block_prd'),
    ));?>
    
<?php endif; ?>

<?php if (get_field("is_block_map")): ?>

    <?php get_template_part('components/blocks/block', 'map', array(
        'map' => fol('block_map'),
    )); ?>

<?php endif; ?>

<?php get_footer(); ?>
