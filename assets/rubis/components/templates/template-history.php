<?php
    $fields = $args['fields'];
?>

<section class="history">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-text wysiwyg">
                <?php echo $fields["history_text"]; ?>
            </div>
            <div class="col-lg-10 offset-lg-1">
                <div class="row">
                    <?php if(isset($fields["history_decade_left"]) && $fields["history_decade_left"] != "") : ?>  
                        <div class="col-lg-6">
                            <?php foreach($fields["history_decade_left"] as $history) : ?>
                                <div class="eachDecade">
                                    <div class="decadeTitle"><?php esc_html_e($history["decade"]); ?></div>
                                    <?php if($history["each_year"]) : ?>
                                        <?php foreach($history["each_year"] as $eachYear) : ?>  
                                            <div class="detailDecade">
                                                <div class="year"><?php esc_html_e($eachYear["year"]); ?></div>

                                                <div class="deco">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>

                                                <?php if($eachYear["countries"]) : ?>
                                                    <div class="countries">
                                                        <?php foreach($eachYear["countries"] as $countries) : ?>
                                                            <span><?php esc_html_e($countries["each_country"]); ?></span>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif;?>
                                </div>
                            <?php endforeach;?>
                        </div>
                    <?php endif;?>
                
                    <?php if(isset($fields["history_decade_right"]) && $fields["history_decade_right"] != "") : ?>             
                        <div class="col-lg-6">
                            <?php foreach($fields["history_decade_right"] as $history) : ?>
                                <div class="eachDecade">
                                    <div class="decadeTitle"><?php esc_html_e($history["decade"]); ?></div>
                                    <?php if($history["each_year"]) : ?>
                                        <?php foreach($history["each_year"] as $eachYear) : ?>  
                                            <div class="detailDecade">
                                                <div class="year"><?php esc_html_e($eachYear["year"]); ?></div>

                                                <div class="deco">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>

                                                <?php if($eachYear["countries"]) : ?>
                                                    <div class="countries">
                                                        <?php foreach($eachYear["countries"] as $countries) : ?>
                                                            <span><?php esc_html_e($countries["each_country"]); ?></span>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif;?>
                                </div>
                            <?php endforeach;?>         
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</section>