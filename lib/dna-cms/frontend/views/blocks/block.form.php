<?php if ($block["form"]): ?>
    <section class="blockForm <?php echo $block["white_bg"] ? "white" : ""; ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <h2><?php esc_html_e($block["title"]); ?></h2>

                    <div class="content"><?php echo ($block["text"]); ?></div>
                </div>
                <div class="col-lg-6 offset-lg-1 col-md-6">
                    <?php render('display_form', 'Forms', array('form_id' => $block["form"])); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
