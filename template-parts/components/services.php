<?php
    $headline = get_sub_field('headline');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
?>
<section class="services<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    ">
    <div class="container">
        <h2><?= $headline; ?></h2>
        <?php if( have_rows('service')):?>
            <div class="services-wrapper">
                <?php while( have_rows('service') ): the_row();
                $serviceHighlightText = get_sub_field('service_highlight_text');
                $serviceHeadline = get_sub_field('service_headline');
                $serviceButtonUrl = get_sub_field('service_button_url');
                $serviceButtonText = get_sub_field('service_button_text');
                $serviceImage = get_sub_field('service_image');
                $serviceMediaType = get_sub_field('service_media_type');
                $serviceVideo = get_sub_field('service_video');
                $serviceYoutube = get_sub_field('service_youtube');
                $serviceLottie = get_sub_field('service_lottie');?>
                    <a class="service" href="<?= $serviceButtonUrl; ?>">
                        <span class="highlight">
                            <?= $serviceHighlightText; ?>
                        </span>
                        <h3><?= $serviceHeadline; ?></h3>
                            <?php if($serviceMediaType === 'Image'):?><div class="image">
                                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($serviceImage, 'large'); ?>" alt="<?= esc_attr(get_post_meta($serviceImage, '_wp_attachment_image_alt', true)); ?>">
                            </div>
                            <?php endif;?>
                            <?php if($serviceMediaType === 'Video'):?><div class="image">
                                <video controls autoplay muted preload="metadata" class="video">
                                    <source src="<?= $serviceVideo; ?>" type="video/mp4">
                                </video>
                            </div>
                            <?php endif;?>
                            <?php if($serviceMediaType === 'Youtube'):?><div class="image">
                                <div class="iframe-container">
                                    <iframe src="<?= $serviceYoutube; ?>?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                            </div>
                            <?php endif;?>
                            <?php if($serviceMediaType === 'Lottie'):?><div class="image">
                                <?= $serviceLottie; ?>
                            </div>
                        <?php endif;?>
                        <span class="btn btn-link">
                            <?= $serviceButtonText; ?>
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </a>
                <?php endwhile; ?>
            </div>
        <?php endif;?>
    </div>
</section>