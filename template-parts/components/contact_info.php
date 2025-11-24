<?php
    $headline = get_sub_field('headline');
    $map = get_sub_field('map');
    $subline = get_sub_field('subline');
    $fullHeight = get_sub_field('full_height');
?>
<section class="contact-info<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>">
    <div class="container">
        <div class="contact-info-map">
        <?php if ($map): ?>
            <div id="acfMap" style="width: 100%; height: 400px;"></div>
            <script>
                function initMap() {
                    var location = {lat: <?= $map['lat']; ?>, lng: <?= $map['lng']; ?>};
                    var map = new google.maps.Map(document.getElementById('acfMap'), {
                        zoom: 15,  // Adjust zoom level if needed
                        center: location
                    });
                    var marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                }
            </script>
            <!-- Ensure you have the Google Maps API key -->
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
        <?php else: ?>
            <p>Map data is not available.</p>
        <?php endif; ?>
        </div>
        <div class="contact-info-content">
            <h2><?= $headline; ?></h2>
            <span><?= $subline; ?></span>
            <?php if( have_rows('detail')):?>
                <div class="contact-info-content-details">
                    <?php while( have_rows('detail') ): the_row();
                    $detailHeadline = get_sub_field('detail_headline');?>
                        <div class="contact-info-content-detail">
                            <h5><?= $detailHeadline; ?></h5>
                            <?php if( have_rows('detail_list_item')):?>
                                <ul>
                                    <?php while( have_rows('detail_list_item') ): the_row();
                                    $detailListItemText = get_sub_field('detail_list_item_text');
                                    $detailListItemUrl = get_sub_field('detail_list_item_url');?>
                                        <?php if($detailListItemUrl):?><a href="<?= $detailListItemUrl; ?>"><?php endif;?><li><?= $detailListItemText; ?></li><?php if($detailListItemUrl):?></a><?php endif;?>
                                    <?php endwhile;?>
                                </ul>
                            <?php endif;?>
                        </div>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
        </div>
    </div>
</section>