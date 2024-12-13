<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
*  Template Name: Sitemap
 * @package WordPress
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */
?>
<?php get_header(); ?>

<div class="container containerSitemap">
    <div class="row">
        <div class="col-12">
            <h1><?php the_title(); ?></h1>

            <?php the_content(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>