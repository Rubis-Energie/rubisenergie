<?php if ($fields_hp["block_hp"]): ?>
    <section class="blockHeaderPage" style="background-color:<?php esc_html_e($fields_hp["block_hp"]["color"]); ?>;">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="text">
                        
                        <h1><?php esc_html_e($fields_hp["block_hp"]["title"]); ?></h1>

                        <?php echo $fields_hp["block_hp"]["text"]; ?>
                    </div>
                </div>

                
                <div class="col-lg-6 offset-lg-1">
                    <div class="img" style="background-image: url('<?php esc_html_e($fields_hp["block_hp"]["img"]["url"]); ?>')"></div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ($fields_hp["block_engagement"]): ?>
    <section class="engagement wysiwyg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 title">
                    <h2><?php esc_html_e($fields_hp["block_engagement"]["title"]); ?></h2>

                    <?php echo $fields_hp["block_engagement"]["text"]; ?>
                </div>

                <?php if ($fields_hp["block_engagement"]["columns"]): ?>
                    <div class="col-12">
                        <div class="row">
                            <?php foreach ($fields_hp["block_engagement"]["columns"] as $col): ?>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-eachCol">
                                    <a class="eachCol" target="<?php esc_html_e($col["link"]["target"]); ?>" href="<?php esc_html_e($col["link"]["url"]); ?>">

                                        <div class="containerImg">
                                            <div class="img" style="background-image: url('<?php esc_html_e($col["img"]["url"]); ?>')"></div>
                                        </div>

                                        <?php echo ($col["title"]); ?>

                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ($fields_hp["is_block_prd"]): ?>

    <?php render('block_product', 'Products'); ?>

<?php endif; ?>

<?php if ($fields_hp["is_block_actus"]): ?>

    <?php if ($fields_hp["block_actus"]): ?>
        <section class="actusHp">
            <div class="container">
                <div class="row title">
                    <div class="col-lg-6 col-md-6">
                        <h2><?php esc_html_e($fields_hp["block_actus"]["title"]); ?></h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-cta">
                        <a class="cta green" target="<?php esc_html_e($fields_hp["block_actus"]["link"]["target"]); ?>" href="<?php esc_html_e($fields_hp["block_actus"]["link"]["url"]); ?>"><?php esc_html_e($fields_hp["block_actus"]["link"]["title"]); ?></a>
                    </div>
                </div>

                <?php $actus = get_last_actus(); ?>
                <?php if ($actus): ?>
                    
                    <div class="row">
                        <?php foreach ($actus as $actu): ?>
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

    <?php endif; ?>

<?php endif; ?>

<?php if ($fields_hp["is_block_map"]): ?>

    <?php render('block_map', 'Rubis'); ?>

<?php endif; ?>
