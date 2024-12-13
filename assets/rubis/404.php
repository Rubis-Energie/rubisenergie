<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * @package WordPress
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */
?>
<?php get_header(); ?>

<div class="container container404">
    <div class="row">
        <div class="col-12">
            <h1>404</h1>
            <p><?php pll_e("Oups, page non trouvée ..."); ?></p>
            <a class="cta green" href="<?php esc_html_e(pll_home_url()); ?>"><?php pll_e("Retourner à la page d'accueil"); ?></a>
        </div>
    </div>
</div>
<?php get_footer(); ?>
