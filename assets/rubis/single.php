<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * @package WordPress
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */
?>
<?php get_header(); ?>

<?php render('header_page', 'Rubis'); ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <a class="backBtnActu" href="<?php esc_html_e(get_the_permalink(get_page_relation_id('listing_actus'))); ?>"><?php pll_e('Retour'); ?></a>
        </div>
    </div>
</div>

<?php render('list_blocks', 'Cms'); ?>

<?php if (get_field("is_block_map")): ?>

    <?php render('block_map', 'Rubis'); ?>

<?php endif; ?>

<?php get_footer(); ?>
