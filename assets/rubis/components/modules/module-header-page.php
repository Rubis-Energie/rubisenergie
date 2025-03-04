<?php
    $header_page = $args['header_page'];
?>

<section class="blockHeaderPage" style="background-color:<?php esc_html_e($header_page["color"]); ?>;">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="text">
                    <h1><?php esc_html_e(get_the_title()); ?></h1>

                    <?php echo $header_page["text"]; ?>
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1">
                <div class="img" style="background-image: url('<?php esc_html_e($header_page["img"]["url"]); ?>')"></div>
            </div>
        </div>
    </div>
</section>