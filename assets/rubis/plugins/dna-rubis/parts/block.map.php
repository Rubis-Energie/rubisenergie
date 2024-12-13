<section class="blockMap">
    <img src="<?php esc_html_e($block_map["img"]["url"]); ?>">
    <div class="containerText">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-8 col-md-6 offset-md-6 col-12">
                    <div class="text">
                        <h2><?php esc_html_e($block_map["title"]); ?></h2>

                        <a class="cta green" target="<?php esc_html_e($block_map["link"]["target"]); ?>" href="<?php esc_html_e($block_map["link"]["url"]); ?>"><?php esc_html_e($block_map["link"]["title"]); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
