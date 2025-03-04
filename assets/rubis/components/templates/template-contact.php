<?php
    $fields = $args['fields'];
?>

<section class="contact">
    <div class="img" style="background-image: url('<?php esc_html_e(get_the_post_thumbnail_url()); ?>')"></div>
    <div class="container">
        <div class="row">
            <div class="col-12 title">
                <h2><?php the_title(); ?></h2>
            </div>
            <div class="col-12 col-blockMap">
                <div class="row">
                    <div class="col-lg-9 col-map">
                        <div id="map" style="height:480px;">
                    </div>
                    </div>

                    <div class="col-lg-3 col-text">
                    
                        <?php if (isset($fields["map_title"]) && $fields["map_title"] != ""): ?>
                            <h3><?php esc_html_e($fields["map_title"]); ?></h3>
                        <?php endif; ?>

                        <?php if (isset($fields["map_text"]) && $fields["map_text"] != ""): ?>
                            <div class="content"><?php echo $fields["map_text"]; ?></div>
                        <?php endif; ?>

                        <div class="bottomText">
                            <?php if (isset($fields["map_phone"]) && $fields["map_phone"] != ""): ?>
                                <div class="phone">
                                    <?php pll_e('Tél.'); ?><a href="+33<?php esc_html_e($fields["map_phone"]); ?>"><?php esc_html_e($fields["map_phone"]); ?></a>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($fields["map_link"]["url"]) && $fields["map_link"]["url"] != ""): ?>
                                <a class="link" target="<?php esc_html_e($fields["map_link"]["target"]); ?>" href="<?php esc_html_e($fields["map_link"]["url"]); ?>"><?php esc_html_e($fields["map_link"]["title"]); ?></a>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($fields["block_form"])): ?>
        <?php render('block', 'Cms', array('layout' => 'block.form', 'fields' => $fields["block_form"])) ?>      
    <?php endif; ?>

    <?php if (isset($fields["gg_map"]["lat"]) && isset($fields["gg_map"]["lng"]) ): ?>



    <script type="text/javascript">
        var map = L.map('map', {zoomControl: true}).setView([<?php echo $fields["gg_map"]["lat"]; ?>,<?php echo $fields["gg_map"]["lng"]; ?>], 13);
//        map.dragging.disable();
//        map.touchZoom.disable();
//        map.doubleClickZoom.disable();
//        map.scrollWheelZoom.disable();
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',	
            maxZoom: 18
        }).addTo(map);
        //var marker = L.marker([<?php echo $fields["gg_map"]["lat"]; ?>,<?php echo $fields["gg_map"]["lng"]; ?>]).addTo(map).bindPopup("<b>LIJE Creative</b>");
	var marker = L.marker([<?php echo $fields["gg_map"]["lat"]; ?>,<?php echo $fields["gg_map"]["lng"]; ?>]).addTo(map);	
    </script>



<?php /*
        <script type="text/javascript">
            function initMap() {
                const uluru = { lat: <?php echo $fields["gg_map"]["lat"]; ?>, lng: <?php echo $fields["gg_map"]["lng"]; ?> };

                const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: uluru,
                });
                // The marker, positioned at Uluru
                const marker = new google.maps.Marker({
                position: uluru,
                map: map,
                });
            }
        </script>

*/ ?>

    <?php endif; ?>
</section>

<?php /* <script src="https://maps.googleapis.com/maps/api/js?key=<?php esc_html_e(fo('key_gmap')); ?>&callback=initMap&libraries=&v=weekly" async></script> */ ?>
