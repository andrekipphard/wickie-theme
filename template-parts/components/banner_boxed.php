<?php
    $headline = get_sub_field('headline');
    $highlightText = get_sub_field('highlight_text');
    $subline = get_sub_field('subline');
    $image = get_sub_field('image');
    $floatingImage = get_sub_field('floating_image');
    $text = get_sub_field('text');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
    $socialMediaButtons = get_sub_field('social_media_buttons');
?>
<section class="banner-boxed<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    ">
    <div class="container">
        <div class="container-wrapper" style="background-image: url('<?= wp_get_attachment_image_url($image, 'large');?>;">
            <div class="subline">
                <?php if ($highlightText): ?>
                    <span class="highlight">
                        <?= $highlightText; ?>
                    </span>
                <?php endif;?>
                <span><?= $subline; ?></span>
            </div>
            <h2><?= $headline; ?></h2>
            <span class="text"><?= $text; ?></span>
            <?php if( have_rows('buttons')):?>
                <div class="buttons<?php if($socialMediaButtons === 'Yes'):?> buttons-social-media<?php endif;?>">
                    <?php while( have_rows('buttons') ): the_row();
                    $buttonUrl = get_sub_field('button_url');
                    $buttonIcon = get_sub_field('button_icon');
                    $buttonText = get_sub_field('button_text');
                    $buttonType = get_sub_field('button_type');
                    $buttonIconPosition = get_sub_field('button_icon_position');?>
                        <a href="<?= $buttonUrl; ?>" class="btn btn-<?= $buttonType; ?><?= !$buttonText ? ' btn-no-text' : '' ?>">
                            <?php if ($buttonText): ?>
                                <?php if ($buttonIconPosition == 'Left'): ?>
                                    <i class="bi bi-<?= $buttonIcon; ?>"></i>
                                <?php endif; ?>
                                <?= $buttonText; ?>
                                <?php if ($buttonIconPosition == 'Right'): ?>
                                    <i class="bi bi-<?= $buttonIcon; ?>" style="margin-left: 10px; margin-right: 0;"></i>
                                <?php endif; ?>
                            <?php else: ?>
                                <i class="bi bi-<?= $buttonIcon; ?>"></i>
                            <?php endif; ?>
                        </a>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
            <?php if($floatingImage):?><img class="floating" loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($floatingImage, 'large'); ?>" alt="<?= get_post_meta($floatingImage, '_wp_attachment_image_alt', true); ?>"><?php endif;?>
        </div>
    </div>
</section>