<?php
    $headline = get_sub_field('headline');
    $text = get_sub_field('text');
    $layout = get_sub_field('layout');
    $padding = get_sub_field('padding');
    $marginTop = get_sub_field('margin_top');
    $marginBottom = get_sub_field('margin_bottom');
    $video = get_sub_field('video');
    $youtube = get_sub_field('youtube');
    $lottie = get_sub_field('lottie');
    $paddingFromTextToImageColumn = get_sub_field('padding_from_text_to_image_column');
    $gap = get_sub_field('gap');
    $fullHeight = get_sub_field('full_height');
?>
<section class="<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?><?php if($marginBottom == 'Yes'):?> margin-bottom <?php endif;?><?php if($marginTop == 'Yes'):?>margin-top <?php endif;?><?php if($padding == 'Yes'):?>padding-top padding-bottom <?php endif;?><?= $layout == 'Single Image' ? 'banner-two-buttons' : 'banner'; ?>">
    <div class="container">
        <div class="<?= $layout == 'Single Image' ? 'banner-two-buttons-wrapper' : 'banner-wrapper'; ?>"<?php if($gap !== ''):?> style="gap: <?=$gap;?>px;"<?php endif;?>>
            <div class="content" style="<?php if($gap !== ''):?>flex-basis: calc(50% - (<?= $gap;?>px/2));<?php endif;?><?php if($paddingFromTextToImageColumn !== ''):?>padding-right: <?=$paddingFromTextToImageColumn;?>px;<?php endif;?>">
                <h2><?=$headline;?></h2>
                <span><?=$text;?></span>
                <?php if( have_rows('cta')):?>
                    <div class="cta">
                        <?php while( have_rows('cta') ): the_row();
                        $buttonUrl = get_sub_field('button_url');
                        $buttonIcon = get_sub_field('button_icon');
                        $buttonText = get_sub_field('button_text');?>
                            <a href="<?=$buttonUrl;?>" class="btn btn-white">
                                <i class="bi bi-<?= $buttonIcon; ?>"></i>
                                <?= $buttonText; ?>
                            </a>
                        <?php endwhile;?>
                    </div>
                <?php endif;?>
            </div>
            <?php if($layout === 'Single Image' || $layout === 'Multiple Images'):?><div class="image"<?php if($gap !== ''):?> style="flex-basis: calc(50% - (<?= $gap;?>px/2));"<?php endif;?>>
                <?php if( have_rows('image')):?>
                    <div class="images">
                        <?php while( have_rows('image') ): the_row();
                        $image = get_sub_field('image');
                        $overlay = get_sub_field('overlay');?>
                            <img class="<?= $overlay == 'Yes' ? 'overlay-image' : ''; ?>" loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large');?>" alt="<?= esc_attr(get_post_meta($image, '_wp_attachment_image_alt', true)); ?>">
                        <?php endwhile;?>
                    </div>
                <?php endif;?>
            
            <?php endif;?>
                <?php if($layout === 'Video'):?><div class="image"<?php if($gap !== ''):?> style="flex-basis: calc(50% - (<?= $gap;?>px/2));"<?php endif;?>>
                    <video controls autoplay muted preload="metadata" class="video">
                        <source src="<?= $video; ?>" type="video/mp4">
                    </video>
                </div>
                <?php endif;?>
                <?php if($layout === 'Youtube'):?><div class="image"<?php if($gap !== ''):?> style="flex-basis: calc(50% - (<?= $gap;?>px/2));"<?php endif;?>>
                    <div class="iframe-container">
                        <iframe src="<?= $youtube; ?>?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
                <?php endif;?>
                <?php if($layout === 'Lottie'):?><div class="image"<?php if($gap !== ''):?> style="flex-basis: calc(50% - (<?= $gap;?>px/2));"<?php endif;?>>
                    <?= $lottie; ?>
                </div>
            <?php endif;?>
        </div>
    </div>
</section>