<?php
    $headline = get_sub_field('headline');
    $buttonText = get_sub_field('button_text');
    $buttonUrl = get_sub_field('button_url');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
?>
<section class="popular-services<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    ">
    <div class="container">
        <div class="title">
            <h2><?= $headline; ?></h2>
            <a href="<?= $buttonUrl; ?>" class="desktop-button btn btn-primary">
                <?= $buttonText; ?>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <?php if( have_rows('content_box')):?>
            <div class="content-boxes">
                <?php while( have_rows('content_box') ): the_row();
                $contentBoxImage = get_sub_field('content_box_image');
                $contentBoxMediaType = get_sub_field('content_box_media_type');
                $contentBoxVideo = get_sub_field('content_box_video');
                $contentBoxYoutube = get_sub_field('content_box_youtube');
                $contentBoxLottie = get_sub_field('content_box_lottie');
                $contentBoxHighlightText = get_sub_field('content_box_highlight_text');
                $contentBoxHeadline = get_sub_field('content_box_headline');
                $contentBoxButtonText = get_sub_field('content_box_button_text');
                $contentBoxButtonUrl = get_sub_field('content_box_button_url');?>
                    <a class="content-box" href="<?= $contentBoxButtonUrl; ?>">
                        <?php if($contentBoxMediaType === 'Image'):?><div class="image">
                            <img class="w-100" loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($contentBoxImage, 'large');?>" alt="<?= esc_attr(get_post_meta($contentBoxImage, '_wp_attachment_image_alt', true)); ?>">
                            </div>
                            <?php endif;?>
                            <?php if($contentBoxMediaType === 'Video'):?><div class="image">
                                <video controls autoplay muted preload="metadata" class="video">
                                    <source src="<?= $contentBoxVideo; ?>" type="video/mp4">
                                </video>
                            </div>
                            <?php endif;?>
                            <?php if($contentBoxMediaType === 'Youtube'):?><div class="image">
                                <div class="iframe-container">
                                    <iframe src="<?= $contentBoxYoutube; ?>?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                            </div>
                            <?php endif;?>
                            <?php if($contentBoxMediaType === 'Lottie'):?><div class="image">
                                <?= $contentBoxLottie; ?>
                            </div>
                        <?php endif;?>
                        
                        <div class="content">
                            <div class="text">
                                <span class="highlight">
                                    <?= $contentBoxHighlightText; ?>
                                </span>
                                <h3 class="title"><?= $contentBoxHeadline; ?></h3>
                            </div>
                            <span class="btn btn-link">
                                <?= $contentBoxButtonText; ?>
                                <i class="bi bi-chevron-right"></i>
                            </span>
                        </div>
                    </a>
                <?php endwhile;?>
            </div>
        <?php endif;?>
        <a href="<?= $buttonUrl; ?>" class="mobile-button btn btn-primary">
            <?= $buttonText; ?>
            <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</section>