<?php
/**
 * Frontend Class
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */
if (!defined('DNA_THEME_VERSION')) exit;
?>
<div class="bloc bloc-cols bg-light">
    <div class="container">
        <div class="cols-inner">
            <div class="ctn-flex layout layout--2-2 ctn-flex-row-reverse">
                <div class="layout-main">
                    <?php if ($tag = $cross_content['basetitle']): ?>
                        <div class="tag"><?php echo $tag; ?></div>
                    <?php endif; ?>
                    <h2><?php echo $cross_content['title'] ?></h2>
                    <p><?php echo $cross_content['text']; ?></p>
                    <?php $button = $cross_content['button'] ?>
                    <?php $target = $button['link']['target'] ? ' target="'.$button['link']['target'].'"' : ''; ?>
                    <a href="<?php echo $button['link']['url'] ?>" class="btn"<?php echo $target; ?>><?php echo $button['label'] ?> <?php echo fgc('ico-arrow-btn.svg'); ?></a>
                </div>
                <div class="layout-aside">
                    <div class="cols-media">
                        <?php $img = $cross_content['image']['sizes']['display'] ?>
                        <img src="<?php echo $img ?>" alt="<?php echo $cross_content['image']['alt'] ?>" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>