<section class="blockSlider block">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if ($block["slider"]): ?>
                    <div class="owl-carousel <?php echo (count($block["slider"]) > 1) ? "owl-slider" : "owl-sliderNone"; ?>">
                        <?php foreach ($block['slider'] as $slider) : ?>
                            <div class="img" style="background-image: url('<?php esc_html_e($slider['image']['url']); ?>')"></div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (count($block["slider"]) > 1) : ?>
                        <div class="navBtn">
                            <div class="prevBtn">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/white_arrow.png" alt="">
                            </div>
                            <div class="nextBtn">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/white_arrow.png" alt="">
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>