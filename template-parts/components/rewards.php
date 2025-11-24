<?php
    $highlightTextLeft = get_sub_field('highlight_text_left');
    $headlineLeft = get_sub_field('headline_left');
    $textLeft = get_sub_field('text_left');
    $buttonTextLeft = get_sub_field('button_text_left');
    $imageLeft = get_sub_field('image_left');
    $buttonUrlLeft = get_sub_field('button_url_left');
    $highlightTextRight = get_sub_field('highlight_text_right');
    $headlineRight = get_sub_field('headline_right');
    $buttonTextRight = get_sub_field('button_text_right');
    $imageRight = get_sub_field('image_right');
    $buttonUrlRight = get_sub_field('button_url_right');
    $mediaTypeRight = get_sub_field('media_type_right');
    $videoRight = get_sub_field('video_right');
    $youtubeRight = get_sub_field('youtube_right');
    $lottieRight = get_sub_field('lottie_right');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
?>
<section class="rewards<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    ">
    <div class="container">
        <a class="content-wrapper cryptoback" href="<?= $buttonUrlLeft; ?>">
            <div class="content">
                <span class="highlight">
                    <?= $highlightTextLeft; ?>
                </span>
                <h2><?= $headlineLeft; ?></h2>
                <span><?= $textLeft; ?></span>
                <span class="btn btn-primary">
                    <?= $buttonTextLeft; ?>
                    <i class="bi bi-arrow-right"></i>
                </span>
            </div>
            <div class="image" style="background-image: url('<?= wp_get_attachment_image_url($imageLeft, 'large');?>;">
            </div>
        </a>
        <?php if($buttonUrlRight):?><a class="content-wrapper token" href="<?= $buttonUrlRight; ?>">
            <div class="content">
                <div class="subline">
                    <span class="highlight">
                        <?= $highlightTextRight; ?>
                    </span>
                    <span class="btn btn-link">
                        <?= $buttonTextRight; ?>
                        <i class="bi bi-chevron-right"></i>
                    </span>
                </div>
                <h2><?= $headlineRight; ?></h2>
            </div>
                <?php if($mediaTypeRight === 'Image'):?><div class="image">
                    <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageRight, 'large');?>" alt="<?= esc_attr(get_post_meta($imageRight, '_wp_attachment_image_alt', true)); ?>">
                </div>
                <?php endif;?>
                <?php if($mediaTypeRight === 'Video'):?><div class="image">
                    <video controls autoplay muted preload="metadata" class="video">
                        <source src="<?= $videoRight; ?>" type="video/mp4">
                    </video>
                </div>
                <?php endif;?>
                <?php if($mediaTypeRight === 'Youtube'):?><div class="image">
                    <div class="iframe-container">
                        <iframe src="<?= $youtubeRight; ?>?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
                <?php endif;?>
                <?php if($mediaTypeRight === 'Lottie'):?><div class="image">
                    <?= $lottieRight; ?>
                </div>
                <?php endif;?>
        </a><?php endif;?>
        <?php if(!$buttonUrlRight):?>
            <div class="content" style="    display: flex;align-content: center;justify-content: center;align-items: center;">
                <?php if($mediaTypeRight === 'Image'):?><div class="image">
                    <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageRight, 'large');?>" alt="<?= esc_attr(get_post_meta($imageRight, '_wp_attachment_image_alt', true)); ?>" style="width: 65%; height: auto;">
                </div>
                <?php endif;?>
                <?php if($mediaTypeRight === 'Video'):?><div class="image">
                    <video controls autoplay muted preload="metadata" class="video">
                        <source src="<?= $videoRight; ?>" type="video/mp4">
                    </video>
                </div>
                <?php endif;?>
                <?php if($mediaTypeRight === 'Youtube'):?>
                    <div class="iframe-container">
                        <iframe src="<?= $youtubeRight; ?>?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                <?php endif;?>
                <?php if($mediaTypeRight === 'Lottie'):?><div class="image">
                    <?= $lottieRight; ?>
                </div>
                <?php endif;?>
            </div>
        <?php endif;?>
    </div>
</section>