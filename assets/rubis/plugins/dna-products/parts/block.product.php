<section class="blockProduct">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="title">
                    <h2><?php esc_html_e($block_prd["title"]); ?></h2>

                    <?php echo $block_prd["text"]; ?>
                </div>

                <?php if ($block_prd["products"]): ?>
                <?php $i = 0;?>
                <?php foreach ($block_prd["products"] as $prd): ?>

                    <?php if (is_singular('products') && get_the_ID() == $prd->ID): ?>
                        <?php continue; ?>
                    <?php endif; ?>


                    <a class="textHover" data-hover="<?php echo $i; ?>" href="<?php esc_html_e(get_the_permalink($prd->ID)); ?>">
                        <?php esc_html_e(get_the_title($prd->ID)); ?>
                    </a>
                <?php $i++; ?>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="col-lg-6 offset-lg-1 colImg">
                <div id="imgBg" class="img" style="background-image: url('<?php esc_html_e($block_prd["img"]["url"]); ?>')"></div>

                <?php if ($block_prd["products"]): ?>
                <?php $i = 0;?>
                <?php foreach ($block_prd["products"] as $prd): ?>

                    <?php if (is_singular('products') && get_the_ID() == $prd->ID): ?>
                        <?php continue; ?>
                    <?php endif; ?>

                    <a  
                    href="<?php esc_html_e(get_the_permalink($prd->ID)); ?>">

                        <div class="imgHover" style="display:none;" class="img" data-hover="<?php echo $i; ?>" data-img="<?php esc_html_e(get_the_post_thumbnail_url($prd->ID)); ?>"></div>
                    </a>
                <?php $i++; ?>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

           
        </div>
    </div>
</section>