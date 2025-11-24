<?php
    $headline = get_sub_field('headline');
    $subline = get_sub_field('subline');
    $imageTopLeft = get_sub_field('image_top_left');
    $imageBottomLeft = get_sub_field('image_bottom_left');
    $imageTopRight = get_sub_field('image_top_right');
    $imageBottomRight = get_sub_field('image_bottom_right');
    $imageCenter = get_sub_field('image_center');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $imageMobile = get_sub_field('image_mobile');
    $fullHeight = get_sub_field('full_height');
?>
<section class="hero<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    ">
    <div class="container">
        <div class="content">
            <h1><?= $headline; ?></h1>
            <span><?= $subline; ?></span>
            <?php if( have_rows('cta')):?>
                <div class="cta">
                    <?php while( have_rows('cta') ): the_row();
                    $buttonUrl = get_sub_field('button_url');
                    $buttonIcon = get_sub_field('button_icon');
                    $buttonText = get_sub_field('button_text');
                    $buttonType = get_sub_field('button_type');
                    $buttonIconPosition = get_sub_field('button_icon_position');?>
                        <a href="<?= $buttonUrl; ?>" class="btn btn-<?= $buttonType; ?>">
                            <?php if ($buttonIconPosition == 'Left'): ?>
                                <i class="bi bi-<?= $buttonIcon; ?>"></i>
                            <?php endif; ?>

                            <?= $buttonText; ?>

                            <?php if ($buttonIconPosition == 'Right'): ?>
                                <i class="bi bi-<?= $buttonIcon; ?>"></i>
                            <?php endif; ?>
                        </a>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
        </div>
        <div class="images">
            <div class="top-left image">
                <?php if($imageTopLeft):?><img src="<?= wp_get_attachment_image_url($imageTopLeft, 'large');?>" alt="<?= esc_attr(get_post_meta($imageTopLeft, '_wp_attachment_image_alt', true)); ?>"><?php endif;?>
            </div>
            <div class="bottom-left image">
            <?php if($imageBottomLeft):?><img src="<?= wp_get_attachment_image_url($imageBottomLeft, 'large');?>" alt="<?= esc_attr(get_post_meta($imageBottomLeft, '_wp_attachment_image_alt', true)); ?>"><?php endif;?>
            </div>
            <div class="top-right image">
            <?php if($imageTopRight):?><img src="<?= wp_get_attachment_image_url($imageTopRight, 'large');?>" alt="<?= esc_attr(get_post_meta($imageTopRight, '_wp_attachment_image_alt', true)); ?>"><?php endif;?>
            </div>
            <div class="bottom-right image">
            <?php if($imageBottomRight):?><img src="<?= wp_get_attachment_image_url($imageBottomRight, 'large');?>" alt="<?= esc_attr(get_post_meta($imageBottomRight, '_wp_attachment_image_alt', true)); ?>"><?php endif;?>
            </div>
            <div class="center">
            <?php if($imageCenter):?><img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageCenter, 'large');?>" alt="<?= esc_attr(get_post_meta($imageCenter, '_wp_attachment_image_alt', true)); ?>"><?php endif;?>
            </div>
        </div>
        <div class="image">
            <?php if($imageMobile):?><img class="w-100" loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($imageMobile, 'large');?>" alt="<?= esc_attr(get_post_meta($imageMobile, '_wp_attachment_image_alt', true)); ?>"><?php endif;?>
        </div>
    </div>
</section>
