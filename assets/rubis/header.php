<?php
/**
 * The Header for our theme
 * @package WordPress
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */
?>
<?php global $main_logo; ?>
<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php wp_title(': ' . get_bloginfo('name'), true, 'right'); ?></title>
    <meta http-equiv="imagetoolbar" content="false"/>
    <link rel="dns-prefetch" href="//ajax.googleapis.com"/>
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <!-- <link rel="shortcut icon" href="<?php //echo get_template_directory_uri(); ?>/images/Favicon.jpg" type="image/x-icon"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gilda+Display&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">

    <?php if (fo('code_ua')): ?>
    <script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script>
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=<?php esc_html_e(fo('code_ua')); ?>"></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', '<?php esc_html_e(fo('code_ua')); ?>', 'auto');
        ga('send', 'pageview');
    </script>

    <?php endif ?>

    <?php wp_head(); ?>


   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>


    <?php if(is_page_template('tpl/map.implantation.tpl.php')) : ?>
		<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
		<script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
		<script src="https://cdn.amcharts.com/lib/4/geodata/worldLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
	<?php endif; ?>

</head>
<?php $body_class = get_dna_body_class(); ?>
<body>

<?php 
    class Sublevel_Walker extends Walker_Nav_Menu {
        function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<div class='containerSubmenu'><ul class='subMenu'>\n";
        }
        function end_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul></div>\n";
        }
    }
?>

<header>
    <div class="headerMobile">
        <div class="container">
            <div class="row">
                <div class="col-12 col-header">
                    <?php if (fol('logo')): ?>
                        <?php $logo = fol('logo'); ?>
                        <div class="logoMobile">
                            <a href="<?php esc_html_e(pll_home_url()); ?>">
                                <img src="<?php esc_html_e($logo["url"]); ?>">
                            </a>
                        </div>
                    <?php endif ?>
                    <div class="toggleMenu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (fol('before_menu')): ?>
        <section class="beforeMenu">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-menu">
                        <?php
                            wp_nav_menu(array(
                                'theme_location' => 'header-sup-menu',
                                'menu_class' => 'menu',
                                'submenu_class' => 'mainMenu-label',
                            ));
                        ?>
                        <div class="containerLang">
                            <?php pll_the_languages(array('display_names_as' => 'slug')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif ?>

    <nav class="mainMenu">
        <div class="container">
            <div class="row row-mainMenu">
                <?php if (fol('logo')): ?>
                    <div class="col-lg-3 col-logo">
                        <?php $logo = fol('logo'); ?>
                        <div class="logo">
                            <a href="<?php esc_html_e(pll_home_url()); ?>">
                                <img src="<?php esc_html_e($logo["url"]); ?>">
                            </a>
                        </div>
                    </div>
                <?php endif ?>

                <div class="col-lg-6">
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'header-main-menu',
                            'menu_class' => 'nav-mainMenu',
                            'container' => 'section',
                            'items_wrap' => '<section class="nav-mainMenu">%3$s</section>',
                            'submenu_class' => 'mainMenu-label',
                            'walker' => new Sublevel_Walker()
                        ));
                    ?>
                </div>

                <?php if (fol('last_btn')): ?>
                    <div class="col-lg-3">
                        <div class="lastBtn">
                            <?php $btn = fol('last_btn'); ?>
                            <a class="cta green" target="<?php esc_html_e($btn["target"]); ?>" href="<?php esc_html_e($btn["url"]); ?>">
                                <?php esc_html_e($btn["title"]); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>


                <?php if (fol('before_menu')): ?>
                    <section class="beforeMobile">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-menu">
                                    <?php
                                        wp_nav_menu(array(
                                            'theme_location' => 'header-sup-menu',
                                            'menu_class' => 'menu',
                                            'submenu_class' => 'mainMenu-label',
                                        ));
                                    ?>
                                    <div class="containerLang">
                                        <?php pll_the_languages(array('display_names_as' => 'slug')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endif ?>
            </div>
        </div>
    </nav>
</header>

<div class="bg-content">
