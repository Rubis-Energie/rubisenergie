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
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.min.css" type="text/css" media="all"/>

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
                        <div class="menu">
                            <?php foreach (fol('before_menu') as $b_menu): ?>
                                <a target="<?php esc_html_e($b_menu["link"]["target"]); ?>" href="<?php esc_html_e($b_menu["link"]["url"]); ?>">
                                    <?php esc_html_e($b_menu["link"]["title"]); ?>
                                </a>
                            <?php endforeach ?>
                        </div>
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

                <?php if (fol('main_menu')): ?>
                    <?php $menus = fol('main_menu'); ?>
                    <?php $nb_items = count($menus); ?>
                    <?php $i = 1; ?>
                    <div class="col-lg-6">
                        <section class="nav-mainMenu">
                            <?php foreach ($menus as $menu): ?>
                                <?php $class = get_item_menu_active(get_the_ID(), $menu["link"]); ?>
                                <?php if ($menu["is_sub_menu"]): ?>
                                    <div class="mainMenu-label <?php echo $class; ?>">
                                        <div class="labelSub">
                                            <?php esc_html_e($menu["label"]) ?>
                                        </div>
                                        <div class="containerSubmenu">
                                            <div class="subMenu">
                                                <?php foreach ($menu["sub_menu"] as $sub_menu): ?>
                                                    <a target="<?php esc_html_e($sub_menu["link"]["target"]); ?>" href="<?php esc_html_e($sub_menu["link"]["url"]); ?>">
                                                        <?php esc_html_e($sub_menu["link"]["title"]); ?>
                                                    </a>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                    </div>

                                <?php else : ?>

                                    <?php if ($i == $nb_items): //last item menu ?>

                                        <a class="mainMenu-label <?php echo $class; ?>" target="<?php esc_html_e($menu["link"]["target"]); ?>" href="<?php esc_html_e($menu["link"]["url"]); ?>">
                                            <?php esc_html_e($menu["link"]["title"]); ?>
                                        </a>

                                    <?php else :  ?>

                                        <a class="mainMenu-label" target="<?php esc_html_e($menu["link"]["target"]); ?>" href="<?php esc_html_e($menu["link"]["url"]); ?>">
                                            <?php esc_html_e($menu["link"]["title"]); ?>
                                        </a>

                                    <?php endif; ?>

                                <?php endif ?>
                                <?php $i++; ?>
                            <?php endforeach ?>
                        </section>

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
                                        <div class="menu">
                                            <?php foreach (fol('before_menu') as $b_menu): ?>
                                                <a target="<?php esc_html_e($b_menu["link"]["target"]); ?>" href="<?php esc_html_e($b_menu["link"]["url"]); ?>">
                                                    <?php esc_html_e($b_menu["link"]["title"]); ?>
                                                </a>
                                            <?php endforeach ?>
                                        </div>
                                        <div class="containerLang">
                                            <?php pll_the_languages(array('display_names_as' => 'slug')); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endif ?>
                <?php endif ?>
            </div>
        </div>
    </nav>
</header>

<div class="bg-content">
