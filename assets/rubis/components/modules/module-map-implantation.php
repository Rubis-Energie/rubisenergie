<?php
$translate_cont = array(
    'Afrique' => 'Africa',
    'Asie' => 'Asia',
    'Caraïbes' => 'Caribbean',
    'Europe' => 'Europe',
    'Océan Indien' => 'Indian ocean',
    'Amérique du Nord' => 'North America',
    'Amérique du Sud' => 'South America',
);

$cont = $args['cont'];
$implantations = $args['implantations'];
$countries = $args['countries'];
$countries_sort_cont = $args['countries_sort_cont'];

?>


<section class="mapImplantation">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-8 col-map">
                        <div id="chartdiv" style="width: 100%; height: 500px;"></div>
                    </div>
                    <div class="col-lg-4 col-right">
                        <div class="containerColRight">
                            <div class="eachTextCountry continentContent wysiwyg">
                                <div class="innerContainerEachText">
                                    <p><?php pll_e('Cliquez sur la zone de votre choix dans la liste ci-dessous pour en savoir plus.'); ?></p>

                                    <div class="col-continents">
                                        <?php if ($cont): ?>
                                            <?php asort($cont); ?>
                                            <div class="continents-click all" data-cont="all">
                                                <p><?php pll_e('Tous les continents'); ?></p>
                                            </div>
                                            <?php foreach ($cont as $key => $c): ?>
                                                <div class="continents-click <?php echo $key ?>" data-cont="<?php echo $key ?>">
                                                    <?php if (pll_current_language() == 'en'): ?>
                                                        <p><?php echo $translate_cont[$c]; ?></p>
                                                    <?php else : ?>
                                                        <p><?php echo $c; ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <?php if ($countries): ?>
                                <div class="eachTextCountry all wysiwyg allCountry" style="opacity: 0;pointer-events:none;">
                                    <div class="innerContainerEachText">
                                        <div class="back continent"><?php pll_e("retour"); ?></div>
                                        <p><?php pll_e('Cliquez sur le pays de votre choix dans la liste ci-dessous pour en savoir plus.'); ?></p>
                                        <div class="col-countries">
                                            <div class="row">

                                                <?php foreach ($countries as $all_c): ?>
                                                    <div class="col-12">
                                                        <div class="countries-click" data-pid="<?php esc_html_e($all_c->ID); ?>" data-id="<?php esc_html_e(get_field('imp_id', $all_c->ID)); ?>">
                                                            <p><?php esc_html_e(get_field('imp_name', $all_c->ID)) ?></p>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </diV>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($countries_sort_cont): ?>
                                <?php foreach ($countries_sort_cont as $cont => $country): ?>
                                    <div class="eachTextCountry <?php echo $cont; ?> wysiwyg" style="opacity: 0;pointer-events:none;">
                                        <div class="innerContainerEachText">
                                            <div class="back continent"><?php pll_e("retour"); ?></div>
                                            <p><?php pll_e('Cliquez sur le pays de votre choix dans la liste ci-dessous pour en savoir plus.'); ?></p>

                                            <div class="col-countries">

                                                <?php if ($country): ?>
                                                    <?php /*?>
                                                    <?php $nbCountry = count($country); ?>
                                                    <?php
                                                        if ($nbCountry > 20) {
                                                            $sliceCountry = $nbCountry%2;
                                                        } else {
                                                            $sliceCountry = 10;
                                                        }
                                                    ?>
                                                    <?php */ ?>
                                                    <div class="row">
                                                        <?php //$i = 1; ?>
                                                        <?php foreach ($country as $c): ?>
                                                            <?php /*?>
                                                            <?php if($i == 1 || $i == $sliceCountry) : ?>
                                                                <div class="<?php echo ($nbCountry <= $sliceCountry) ? 'col-12' : 'col-6'; ?>">
                                                            <?php endif; ?>
                                                            <?php */ ?>
                                                            <div class="col-12">
                                                                <div class="countries-click" data-pid="<?php esc_html_e($c->ID); ?>" data-id="<?php esc_html_e(get_field('imp_id', $c->ID)); ?>">
                                                                    <p><?php esc_html_e(get_field('imp_name', $c->ID)) ?></p>
                                                                </div>
                                                            </div>
                                                            <?php /* ?>
                                                            <?php if($nbCountry == $i || $i == $sliceCountry) : ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php $i++; ?>
                                                        <?php */ ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php if ($implantations): ?>
                                <?php foreach ($implantations as $imp): ?>
                                    <?php $imp_cont = get_field('imp_cont', $imp->ID); ?>
                                    <div style="opacity: 0;pointer-events:none;" class="eachTextCountry wysiwyg" data-pid="<?php esc_html_e($imp->ID); ?>" data-id="<?php esc_html_e(get_field('imp_id', $imp->ID)); ?>" data-cont="<?php esc_html_e($imp_cont["value"]); ?>">
                                        <div class="innerContainerEachText">
                                            <div class="back continentCountries" data-cont="<?php esc_html_e($imp_cont["value"]); ?>"><?php pll_e("retour"); ?></div>
                                            <h2><?php esc_html_e(get_the_title($imp->ID)); ?></h2>
                                            <?php echo get_field('imp_text', $imp->ID); ?>

                                            <?php $pictos = get_field('pictos', $imp->ID); ?>
                                            <div class="pictos">
                                                <?php if($pictos != "") : ?>
                                                    <?php foreach($pictos as $p) : ?>
                                                        <img src="<?php esc_html_e($p["picto"]["url"]); ?>" alt="<?php esc_html_e($p["picto"]["alt"]); ?>">
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                            <?php $url_1 = get_field('imp_url', $imp->ID); ?>
                                            <?php $url_2 = get_field('imp_url_two', $imp->ID); ?>
                                            <?php if(isset($url_1) && $url_1 != "") : ?>
                                                <a class="cta green" target="_blank" href="<?php esc_html_e($url_1); ?>"><?php pll_e("En savoir plus"); ?></a>
                                            <?php endif; ?>
                                            <?php if(isset($url_2["url"]) && $url_2["url"] != "") : ?>
                                                <a class="cta green" target="<?php esc_html_e($url_2["target"]); ?>" href="<?php esc_html_e($url_2["url"]); ?>"><?php esc_html_e($url_2["title"]); ?></a>
                                            <?php endif; ?>

                                            <?php $other_imp = get_field('others_subsidiaries', $imp->ID); ?>
                                            <?php //$other_text = get_field('others_text', $imp->ID); ?>

                                            <?php if ($other_imp): ?>
                                                <div class="otherSubsidiaries">
                                                    <?php foreach($other_imp as $oi) : ?>
                                                        <h2><?php echo $oi["title"]; ?></h2>
                                                        <?php echo $oi["others_text"]; ?>
                                                        <?php if($oi["pictos"] != "") : ?>
                                                            <div class="pictos">
                                                                <?php foreach($oi["pictos"] as $pictos) : ?>
                                                                    <img src="<?php esc_html_e($pictos["picto"]["url"]); ?>" alt="<?php esc_html_e($pictos["picto"]["alt"]); ?>">
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if($oi["links"] != "") : ?>
                                                            <?php foreach($oi["links"] as $links) : ?>
                                                                <?php if(isset($links["link"]["url"]) && $links["link"]["url"] != "") : ?>
                                                                    <div class="eachLink">
                                                                        <a class="cta green" href="<?php esc_html_e($links["link"]["url"])?>" target="<?php esc_html_e($links["link"]["target"])?>"><?php esc_html_e($links["link"]["title"])?></a>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

var countries = [];
var af = [];
var zoomToaf = [];
var an = [];
var zoomToan = [];
var as = [];
var zoomToas = [];
var zh = [];
var zoomTozh = [];
var ca = [];
var zoomToca = [];
var eu = [];
var zoomToeu = [];
var oc = [];
var zoomTooc = [];

<?php if ($implantations) : ?>
    <?php $i = 0; ?>
    <?php $fr_already_push = false; ?>
    <?php foreach ($implantations as $imp) : ?>
        <?php $imp_id = get_field('imp_id', $imp->ID); ?>
        <?php $imp_name = get_field('imp_name', $imp->ID); ?>
        <?php $imp_cont = get_field('imp_cont', $imp->ID); ?>

        <?php if ($imp_id == 'FR' && $fr_already_push === true) : ?>
            <?php continue; ?>
        <?php else : ?>
            <?php if ($imp_id == 'FR') : ?>
                <?php $fr_already_push = true; ?>
            <?php endif; ?>
            <?php if ($imp_id == 'ZW' || $imp_id == 'NA' || $imp_id == 'BJ' || $imp_id == 'BF' || $imp_id == 'NE' || $imp_id == 'GH' || $imp_id == 'ML' || $imp_id == 'MR' || $imp_id == 'GM' || $imp_id == 'GW' || $imp_id == 'GN' || $imp_id == 'CF' || $imp_id == 'CD' || $imp_id == 'GQ' || $imp_id == 'TD' || $imp_id == 'SL') : ?>
                countrie = {"id": "<?php esc_html_e($imp_id); ?>", "nameC": "<?php esc_html_e($imp_name); ?>", "fill": am4core.color("#D6D6D6")};
            <?php else : ?>
                countrie = {"id": "<?php esc_html_e($imp_id); ?>", "nameC": "<?php esc_html_e($imp_name); ?>", "fill": am4core.color("#01614D")};
            <?php endif; ?>
        <?php endif;?>

        <?php if ($imp_cont["value"] == 'eu') : ?>
            cont = {"id": "<?php esc_html_e($imp_id); ?>", "nameC": "<?php esc_html_e($imp_name); ?>", "fill": am4core.color("#01614D")};
            eu.push(cont);
            codeC = "<?php esc_html_e($imp_id); ?>";
            zoomToeu.push(codeC);
        <?php elseif ($imp_cont["value"] == 'af') : ?>
            <?php if ($imp_id == 'ZW' || $imp_id == 'NA' || $imp_id == 'BJ' || $imp_id == 'BF' || $imp_id == 'NE' || $imp_id == 'GH' || $imp_id == 'ML' || $imp_id == 'MR' || $imp_id == 'GM' || $imp_id == 'GW' || $imp_id == 'GN' || $imp_id == 'CF' || $imp_id == 'CD' || $imp_id == 'GQ' || $imp_id == 'TD' || $imp_id == 'SL') : ?>
                cont = {"id": "<?php esc_html_e($imp_id); ?>", "nameC": "<?php esc_html_e($imp_name); ?>", "fill": am4core.color("#D6D6D6")};
            <?php else : ?>
                cont = {"id": "<?php esc_html_e($imp_id); ?>", "nameC": "<?php esc_html_e($imp_name); ?>", "fill": am4core.color("#01614D")};
            <?php endif; ?>
            af.push(cont);
            codeC = "<?php esc_html_e($imp_id); ?>";
            zoomToaf.push(codeC);
        <?php elseif ($imp_cont["value"] == 'an') : ?>
            cont = {"id": "<?php esc_html_e($imp_id); ?>", "nameC": "<?php esc_html_e($imp_name); ?>", "fill": am4core.color("#01614D")};
            an.push(cont);
            codeC = "<?php esc_html_e($imp_id); ?>";
            zoomToan.push(codeC);
        <?php elseif ($imp_cont["value"] == 'as') : ?>
            cont = {"id": "<?php esc_html_e($imp_id); ?>", "nameC": "<?php esc_html_e($imp_name); ?>", "fill": am4core.color("#01614D")};
            as.push(cont);
            codeC = "<?php esc_html_e($imp_id); ?>";
            zoomToas.push(codeC);
        <?php elseif ($imp_cont["value"] == 'zh') : ?>
            cont = {"id": "<?php esc_html_e($imp_id); ?>", "nameC": "<?php esc_html_e($imp_name); ?>", "fill": am4core.color("#01614D")};
            zh.push(cont);
            codeC = "<?php esc_html_e($imp_id); ?>";
            zoomTozh.push(codeC);
        <?php elseif ($imp_cont["value"] == 'ca') : ?>
            cont = {"id": "<?php esc_html_e($imp_id); ?>", "nameC": "<?php esc_html_e($imp_name); ?>", "fill": am4core.color("#01614D")};
            ca.push(cont);
            codeC = "<?php esc_html_e($imp_id); ?>";
            zoomToca.push(codeC);
        <?php elseif ($imp_cont["value"] == 'oc') : ?>
            cont = {"id": "<?php esc_html_e($imp_id); ?>", "nameC": "<?php esc_html_e($imp_name); ?>", "fill": am4core.color("#01614D")};
            oc.push(cont);
            codeC = "<?php esc_html_e($imp_id); ?>";
            zoomTooc.push(codeC);
        <?php endif; ?>

        countries.push(countrie);
        <?php $i++; ?>
    <?php endforeach; ?>
<?php endif; ?>
</script>
