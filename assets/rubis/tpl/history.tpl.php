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

<?php render('header_page', 'Rubis'); ?>

<?php render('history', 'Rubis'); ?>

<?php if (get_field("is_block_map")): ?>

    <?php render('block_map', 'Rubis'); ?>

<?php endif; ?>

<?php get_footer(); ?>