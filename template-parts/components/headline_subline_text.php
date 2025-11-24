<?php
    $headline = get_sub_field('headline');
    $highlightText = get_sub_field('highlight_text');
    $subline = get_sub_field('subline');
    $text = get_sub_field('text');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
    $backgroundImage = get_sub_field('background_image');
    $backgroundImageSize = get_sub_field('background_image_size');
    $backgroundImagePosition = get_sub_field('background_image_position');
    $backgroundImageRepeat = get_sub_field('background_image_repeat');
    $backgroundImageUrl = $backgroundImage ? wp_get_attachment_image_url($backgroundImage, 'large') : '';
    $textPosition = get_sub_field('text_position');
    $paddingBottom = get_sub_field('padding_bottom');
    $headlineTag = get_sub_field('headline_tag');
    $anchorTag = get_sub_field('anchor_tag');
?>
<section id="<?php if($anchorTag) echo esc_attr($anchorTag); ?>" class="headline-subline-text<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if($textPosition):?>--text-position:<?php if($textPosition === 'Left'):?> start;<?php endif; ?><?php if($textPosition === 'Center'):?> center;<?php endif; ?><?php if($textPosition === 'Right'):?> end;<?php endif; ?><?php endif;?>
    <?php if($textPosition):?>--text-position-flex:<?php if($textPosition === 'Left'):?> flex-start;<?php endif; ?><?php if($textPosition === 'Center'):?> center;<?php endif; ?><?php if($textPosition === 'Right'):?> flex-end;<?php endif; ?><?php endif;?>
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    <?php if ($backgroundImageUrl): ?>
        background-image: url('<?= $backgroundImageUrl; ?>');
        background-size: <?= $backgroundImageSize ? $backgroundImageSize : 'cover'; ?>;
        background-repeat: <?= $backgroundImageRepeat ? $backgroundImageRepeat : 'no-repeat'; ?>;
        background-position: <?= $backgroundImagePosition ? $backgroundImagePosition : 'center center'; ?>;
    <?php endif; ?>
    <?php if($paddingBottom === 'No'):?>
        padding-bottom: 0;
    <?php endif;?>">
    <div class="container">
        <?php if($highlightText): ?>
            <span class="highlight">
                <?= $highlightText; ?>
            </span>
        <?php endif;?>
        <?php if($headline): ?><?php if($headlineTag): ?><<?=$headlineTag;?>><?php else:?><h2><?php endif;?><?= $headline; ?></h2><?php endif;?>
        <?php if($subline): ?><h3><?= $subline; ?></h3><?php endif;?>
        <?php if($text): ?><span>
            <?= $text; ?>
        </span><?php endif;?>
        <?php if( have_rows('buttons')):?>
            <div class="cta">
                <?php while (have_rows('buttons')): the_row();
                    $buttonText = get_sub_field('button_text');
                    $buttonUrl = get_sub_field('button_url');
                    $buttonIcon = get_sub_field('button_icon');
                    $buttonIconPosition = get_sub_field('button_icon_position');
                    $buttonStyle = get_sub_field('button_style'); ?>
                        <a href="<?= $buttonUrl; ?>" class="btn btn-<?= $buttonStyle; ?><?php if (!$buttonText): ?> round<?php endif; ?>">
                            <?php if ($buttonIconPosition === 'Left'): ?>
                                <i class="bi bi-<?= $buttonIcon; ?><?php if ($buttonText): ?> margin-right<?php endif; ?>"></i>
                            <?php endif; ?>

                            <?= $buttonText; ?>

                            <?php if ($buttonIconPosition === 'Right'): ?>
                                <i class="bi bi-<?= $buttonIcon; ?><?php if ($buttonText): ?> margin-left<?php endif; ?>"></i>
                            <?php endif; ?>
                        </a>
                <?php endwhile; ?>
            </div>
        <?php endif;?>
    </div>
</section>