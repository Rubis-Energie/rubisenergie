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

<?php render('listing_actus', 'Rubis'); ?>

<?php if (get_field("is_block_map")): ?>

    <?php render('block_map', 'Rubis'); ?>

<?php endif; ?>

<?php get_footer(); ?>
