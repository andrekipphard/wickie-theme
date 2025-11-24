<?php
    $headline = get_sub_field('headline');
    $subline = get_sub_field('subline');
    $image = get_sub_field('image');
    $imageWidth = get_sub_field('image_width');
    $mediaType = get_sub_field('media_type');
    $video = get_sub_field('video');
    $youtube = get_sub_field('youtube');
    $lottie = get_sub_field('lottie');
    $layout = get_sub_field('layout');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $sectionBackgroundColor = get_sub_field('section_background_color');
    $backgroundImage = get_sub_field('background_image');
    $backgroundImageSize = get_sub_field('background_image_size');
    $backgroundImagePosition = get_sub_field('background_image_position');
    $backgroundImageRepeat = get_sub_field('background_image_repeat');
    $backgroundImageUrl = $backgroundImage ? wp_get_attachment_image_url($backgroundImage, 'large') : '';
    $fullHeight = get_sub_field('full_height');
    $textColumnSize = get_sub_field('text_column_size');
?>

<section class="content-card <?= $layout == 'List' ? 'content-card-list' : ''; ?><?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($textColumnSize): ?>--text-column-size: <?= $textColumnSize; ?>;<?php endif; ?>
    <?php if ($textColor): ?>
        color: <?= $textColor; ?>;
    <?php endif; ?>
    <?php if ($sectionBackgroundColor): ?>
        background-color: <?= $sectionBackgroundColor; ?>;
    <?php endif; ?>
    <?php if ($backgroundImageUrl): ?>
        background-image: url('<?= $backgroundImageUrl; ?>');
        background-size: <?= $backgroundImageSize ? $backgroundImageSize : 'cover'; ?>;
        background-repeat: <?= $backgroundImageRepeat ? $backgroundImageRepeat : 'no-repeat'; ?>;
        background-position: <?= $backgroundImagePosition ? $backgroundImagePosition : 'center center'; ?>;
    <?php endif; ?>">
    <div class="container">
        <div class="content-wrapper" style="<?php if($backgroundColor):?>background: <?= $backgroundColor; ?><?php endif;?>">
            <div class="content" style="<?php if($textColor):?>color: <?= $textColor; ?><?php endif;?>">
                <h2><?= $headline; ?></h2>
                <span><?= $subline; ?></span>
                
                <?php if ($layout == 'List' && have_rows('list_item')): ?>
                    <div class="list-items">
                        <?php while (have_rows('list_item')): the_row();
                            $listItemIcon = get_sub_field('list_item_icon');
                            $listItemHeadline = get_sub_field('list_item_headline');
                            $listItemText = get_sub_field('list_item_text'); 
                            $listItemIconColor = get_sub_field('list_item_icon_color');?>
                            <div class="list-item">
                                <?php if ($listItemIcon): ?>
                                    <div class="list-item-icon">
                                        <i class="bi bi-<?= $listItemIcon; ?>"<?php if ($listItemIconColor): ?> style="color: <?= $listItemIconColor; ?>;"<?php endif;?>></i>
                                    </div>
                                <?php endif; ?>
                                <div class="list-item-content">
                                    <h3 style="<?php if($textColor): ?>color: <?= $textColor; ?>;<?php endif; ?>"><?= $listItemHeadline; ?></h3>
                                    <p style="<?php if($textColor): ?>color: <?= $textColor; ?>;<?php endif; ?>"><?= $listItemText; ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>


                <?php if(have_rows('cta')): ?>
                    <div class="cta">
                        <?php while(have_rows('cta')): the_row();
                        $buttonUrl = get_sub_field('button_url');
                        $buttonIcon = get_sub_field('button_icon');
                        $buttonText = get_sub_field('button_text'); ?>
                            <a href="<?= $buttonUrl; ?>" class="btn btn-white">
                                <i class="bi bi-<?= $buttonIcon; ?>"></i>
                                <?= $buttonText; ?>
                            </a>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if($mediaType === 'Image'):?><div class="image">
                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large'); ?>" alt="<?= esc_attr(get_post_meta($image, '_wp_attachment_image_alt', true)); ?>"<?php if($imageWidth !== ''):?> style="max-width: <?= $imageWidth; ?>px"<?php endif;?>>
                </div>
                <?php endif;?>
                <?php if($mediaType === 'Video'):?><div class="image video">
                    <video controls autoplay muted preload="metadata" class="video">
                        <source src="<?= $video; ?>" type="video/mp4">
                    </video>
                </div>
                <?php endif;?>
                <?php if($mediaType === 'Youtube'):?><div class="image video">
                    <div class="iframe-container">
                        <iframe src="<?= $youtube; ?>?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
                <?php endif;?>
                <?php if($mediaType === 'Lottie'):?><div class="image video">
                    <?= $lottie; ?>
                </div>
            <?php endif;?>
            
        </div>
    </div>
</section>
