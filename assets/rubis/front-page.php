<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
*  Template Name: Homepage
 * @package WordPress
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */
?>
<?php get_header(); ?>

<?php get_template_part('components/templates/template', 'homepage', array(
    'fields_hp' => get_fields(),
)); ?>

<?php get_footer(); ?>
