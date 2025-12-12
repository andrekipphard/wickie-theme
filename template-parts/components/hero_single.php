<?php
    $headline = get_sub_field('headline');
    $subline = get_sub_field('subline');
    $mediaType = get_sub_field('media_type');
    $video = get_sub_field('video');
    $youtube = get_sub_field('youtube');
    $lottie = get_sub_field('lottie');
    $image = get_sub_field('image');
    $highlightText = get_sub_field('highlight_text');
    $text = get_sub_field('text');
    $buttonStyle = get_sub_field('button_style');
    $backgroundImage = get_sub_field('background_image');
    $backgroundImageSize = get_sub_field('background_image_size');
    $backgroundImagePosition = get_sub_field('background_image_position');
    $backgroundImageRepeat = get_sub_field('background_image_repeat');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $backgroundImageUrl = $backgroundImage ? wp_get_attachment_image_url($backgroundImage, 'large') : '';
    $fullHeight = get_sub_field('full_height');
?>
<section class="hero-single<?php if(is_front_page()):?> is-front-page<?php endif;?><?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    <?php if ($backgroundImageUrl): ?>
        background-image: url('<?= $backgroundImageUrl; ?>');
        background-size: <?= $backgroundImageSize ?: 'cover'; ?>;
        background-repeat: <?= $backgroundImageRepeat ?: 'no-repeat'; ?>;
        background-position: <?= $backgroundImagePosition ?: 'center center'; ?>;
    <?php endif; ?>
">
    <div class="container">
        <div class="content-image">
            <div class="content">
                <span class="highlight">
                    <?= $highlightText; ?>
                </span>
                <h1><?= $headline; ?></h1>
                <?php if($subline):?><h3><?= $subline; ?></h3><?php endif;?>
                <span><?= $text; ?></span>
                <?php if($buttonStyle == 'Contact Button'):?>
                    <?php if( have_rows('button')):?>
                        <div class="cta contact-button">
                            <?php while( have_rows('button') ): the_row();
                            $buttonText = get_sub_field('button_text');
                            $buttonUrl = get_sub_field('button_url');
                            $buttonIcon = get_sub_field('button_icon');?>
                                <a href="<?= $buttonUrl; ?>" class="btn btn-link">
                                    <i class="bi bi-<?= $buttonIcon; ?>"></i>
                                    <?= $buttonText; ?>
                                </a>
                            <?php endwhile;?>
                        </div>
                    <?php endif;?>
                <?php endif;?>
            </div>
            <?php if($mediaType === 'Image'):?><div class="image">
                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large'); ?>" alt="<?= esc_attr(get_post_meta($image, '_wp_attachment_image_alt', true)); ?>">
            </div>
            <?php endif;?>
            <?php if($mediaType === 'Video'):?><div class="image">
                <video controls autoplay muted preload="metadata" class="video">
                    <source src="<?= $video; ?>" type="video/mp4">
                </video>
            </div>
            <?php endif;?>
            <?php if($mediaType === 'Youtube'):?><div class="image">
                <div class="iframe-container">
                    <iframe src="<?= $youtube; ?>?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
            <?php endif;?>
            <?php if($mediaType === 'Lottie'):?><div class="image">
                <?= $lottie; ?>
            </div>
            <?php endif;?>
            <?php if($mediaType === 'Text'):?>
                <?php $mediaTypeText = get_sub_field('mediatype_text'); ?>
                <div class="image">
                    <?= $mediaTypeText; ?>
                </div>
            <?php endif;?>
        </div>
        <?php if($buttonStyle == 'Multiple Buttons'):?>
            <?php if( have_rows('button')):?>
                <div class="cta multiple-buttons">
                    <?php while( have_rows('button') ): the_row();
                    $buttonText = get_sub_field('button_text');
                    $buttonUrl = get_sub_field('button_url');?>
                        <a href="<?= $buttonUrl; ?>" class="btn btn-white">
                            <?= $buttonText; ?>
                        </a>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
        <?php endif;?>
    </div>
</section>