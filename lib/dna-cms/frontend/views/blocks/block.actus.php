<section class="actusHp">
    <div class="container">
        <div class="row title">
            <div class="col-lg-6 col-md-6">
                <h2><?php esc_html_e($block["title"]); ?></h2>
            </div>
            <div class="col-lg-6 col-md-6 col-cta">
                <a class="cta green" target="<?php esc_html_e($block["link"]["target"]); ?>" href="<?php esc_html_e($block["link"]["url"]); ?>"><?php esc_html_e($block["link"]["title"]); ?></a>
            </div>
        </div>

        <?php if ($block["actus"]): ?>
            <div class="row">
                <?php foreach ($block["actus"] as $actu): ?>
                    <div class="col-lg-4 col-eachCardActu">
                        <a href="<?php esc_html_e(get_the_permalink($actu->ID)); ?>">
                            <div class="containerImg">
                                <div class="img" style="background-image: url('<?php esc_html_e(get_the_post_thumbnail_url($actu->ID)); ?>')"></div>
                            </div>

                            <?php $date = get_the_date('Y-m-d', $actu->ID); ?>
                            <div class="date"><?php echo date_i18n('d F Y', strtotime($date)); ?></div>

                            <h3><?php esc_html_e(get_the_title($actu->ID)); ?></h3>

                            <div class="content"><?php echo apply_filters('the_content', $actu->post_content) ?></div>

                            <div class="hypertext"><?php pll_e('Lire la suite') ?></div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>