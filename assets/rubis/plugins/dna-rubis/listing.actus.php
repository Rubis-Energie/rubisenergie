<section class="listingActus">
    <section class="filter">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 title">
                    <?php pll_e('Filtrer les actualités'); ?>
                </div>
                <div class="col-lg-8">
                    <form id="formActus" action="<?php echo get_the_permalink(); ?>" method="get">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="custom-select2">
                                    <select id="themeActus" name="cat" >
                                        <option value="false"><?php pll_e('Tous les thèmes') ?></option>
                                        <?php $i = 0; ?>
                                        <?php foreach ($themes as $theme) : ?>
                                            <?php if ($i == 0): ?>
                                                <option value="false"><?php pll_e('Tous les thèmes') ?></option>
                                            <?php endif; ?>
                                            <option <?php echo (isset($_GET) && isset($_GET['cat']) && $theme->slug == $_GET['cat']) ? 'selected' : '' ?> value="<?php echo $theme->slug ?>"><?php echo $theme->name ?></option>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6">
                                <input class="cta blue" type="submit" value="valider"/>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="listing">
        <div class="container">
            <div class="row">
                <div class="col-12 title">
                    <h1><?php the_title(); ?></h1>
                </div>
                <?php if ($list->have_posts()) :  ?>

                    <?php while ($list->have_posts()) : $list->the_post(); ?>
                        <div class="col-lg-4 col-md-6 col-eachCardActu">
                            <a href="<?php esc_html_e(get_the_permalink()); ?>">
                                <div class="containerImg">
                                    <div class="img" style="background-image: url('<?php esc_html_e(get_the_post_thumbnail_url()); ?>')"></div>
                                </div>

                                <?php $date = get_the_date('Y-m-d', get_the_ID()); ?>
                                <div class="date"><?php echo date_i18n('d F Y', strtotime($date)); ?></div>

                                <h2><?php esc_html_e(get_the_title()); ?></h2>

                                <div class="content"><?php echo get_the_content(); ?></div>

                                <div class="link"><?php pll_e('Lire la suite') ?></div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                <div class="pagination col-12">
                    <?php echo pkr_paging_nav($list); ?>
                </div>
            </div>
        </div>
    </section>
</section>
