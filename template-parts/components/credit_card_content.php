<?php
    $anchor = get_sub_field('anchor');
    $mediaType = get_sub_field('media_type');
    $video = get_sub_field('video');
    $youtube = get_sub_field('youtube');
    $lottie = get_sub_field('lottie');
    $image = get_sub_field('image');
    $featuresTitle = get_sub_field('features_title');
    $headline = get_sub_field('headline');
    $subline = get_sub_field('subline');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
?>
<section class="credit-card-content<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" id="<?= $anchor; ?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    ">
    <div class="container">
        <div class="credit-card-image">
                <?php if($mediaType === 'Image'):?>
                    <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large'); ?>" alt="<?= esc_attr(get_post_meta($image, '_wp_attachment_image_alt', true)); ?>">
                <?php endif;?>
                <?php if($mediaType === 'Video'):?>
                    <video controls autoplay muted preload="metadata" class="video">
                        <source src="<?= $video; ?>" type="video/mp4">
                    </video>
                <?php endif;?>
                <?php if($mediaType === 'Youtube'):?>
                    <div class="iframe-container">
                        <iframe src="<?= $youtube; ?>?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                <?php endif;?>
                <?php if($mediaType === 'Lottie'):?>
                    <?= $lottie; ?>
            <?php endif;?>
            <span class="features-title"><?= $featuresTitle; ?></span>
            <?php if( have_rows('feature')):?>
                <div class="feature-wrapper">
                    <?php while( have_rows('feature') ): the_row();
                    $featureTitle = get_sub_field('feature_title');
                    $featureInfo = get_sub_field('feature_info');?>
                        <div class="feature">
                            <span class="feature-title"><?= $featureTitle; ?></span>
                            <span><?= $featureInfo; ?></span>
                        </div>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
            <?php if( have_rows('button')):?>
                <div class="cta hide-desktop">
                    <?php while( have_rows('button') ): the_row();
                    $buttonStyle = get_sub_field('button_style');
                    $buttonText = get_sub_field('button_text');
                    $buttonUrl = get_sub_field('button_url');
                    $buttonIcon = get_sub_field('button_icon');?>
                        <a href="<?= $buttonUrl; ?>" class="btn 
                            <?php if($buttonStyle == 'Link'): ?>btn-link<?php else: ?>btn-primary<?php endif; ?>">
                            
                            <?php if($buttonStyle == 'Icon Left'): ?>
                                <i class="bi bi-<?= $buttonIcon; ?>" style="margin-right:10px; margin-left: 0;"></i>
                            <?php endif; ?>

                            <?= $buttonText; ?>

                            <?php if($buttonStyle == 'Link'): ?>
                                <i class="bi bi-chevron-right"></i>
                            <?php elseif($buttonStyle == 'Icon Right'): ?>
                                <i class="bi bi-<?= $buttonIcon; ?>"></i>
                            <?php endif; ?>
                        </a>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
        </div>

        <div class="credit-card-info">
            <h2><?= $headline; ?></h2>
            <span><?= $subline; ?></span>
            <?php if( have_rows('list_item')):?>
                <ul>
                    <?php while( have_rows('list_item') ): the_row();
                    $list_item_icon = get_sub_field('list_item_icon');
                    $list_item_text = get_sub_field('list_item_text');?>
                        <li><i class="bi bi-<?= $list_item_icon; ?>"></i><span><?= $list_item_text; ?></span></li>
                    <?php endwhile;?>
                </ul>
            <?php endif;?>
            <?php if( have_rows('button')):?>
                <div class="cta hide-mobile">
                    <?php while( have_rows('button') ): the_row();
                    $buttonStyle = get_sub_field('button_style');
                    $buttonText = get_sub_field('button_text');
                    $buttonUrl = get_sub_field('button_url');
                    $buttonIcon = get_sub_field('button_icon');?>
                        <a href="<?= $buttonUrl; ?>" class="btn 
                            <?= $buttonStyle == 'Link' ? 'btn-link' : 'btn-primary'; ?>">
                            
                            <?php if ($buttonStyle == 'Icon Left'): ?>
                                <i class="bi bi-<?= $buttonIcon; ?>" style="margin-right:10px; margin-left: 0;"></i>
                            <?php endif; ?>

                            <?= $buttonText; ?>

                            <?php if ($buttonStyle == 'Link'): ?>
                                <i class="bi bi-chevron-right"></i>
                            <?php elseif ($buttonStyle == 'Icon Right'): ?>
                                <i class="bi bi-<?= $buttonIcon; ?>"></i>
                            <?php endif; ?>
                        </a>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
        </div>
        
    </div>
</section>