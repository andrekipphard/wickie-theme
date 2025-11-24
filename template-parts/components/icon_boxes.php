<?php
    $headline = get_sub_field('headline');
    $highlightText = get_sub_field('highlight_text');
    $subline = get_sub_field('subline');
    $alignHeadline = get_sub_field('align_headline');
    $icon_with_background_color = get_sub_field('icon_with_background_color');
    $iconBoxesPerRow = get_sub_field('icon_boxes_per_row');
    $iconOrImage = get_sub_field('icon_or_image');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $backgroundImage = get_sub_field('background_image');
    $backgroundImageSize = get_sub_field('background_image_size');
    $backgroundImagePosition = get_sub_field('background_image_position');
    $backgroundImageRepeat = get_sub_field('background_image_repeat');
    $backgroundImageUrl = $backgroundImage ? wp_get_attachment_image_url($backgroundImage, 'large') : '';
    $text = get_sub_field('text');
    $fullHeight = get_sub_field('full_height');
?>
<section class="icon-boxes<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="<?php if($backgroundColor):?>background: <?= $backgroundColor; ?>;<?php endif;?>    <?php if ($textColor): ?>
        color: <?= $textColor; ?>;
    <?php endif; ?>
    <?php if ($backgroundImageUrl): ?>
        background-image: url('<?= $backgroundImageUrl; ?>');
        background-size: <?= $backgroundImageSize ? $backgroundImageSize : 'cover'; ?>;
        background-repeat: <?= $backgroundImageRepeat ? $backgroundImageRepeat : 'no-repeat'; ?>;
        background-position: <?= $backgroundImagePosition ? $backgroundImagePosition : 'center center'; ?>;
    <?php endif; ?>">
    <div class="container">
        <div class="title" <?php if($alignHeadline == 'Center'):?>style="align-items: center;"<?php endif;?><?php if($alignHeadline == 'Right'):?>style="align-items: end;"<?php endif;?>>
            <?php if($highlightText):?>
                <span class="highlight">
                    <?= $highlightText; ?>
                </span>
            <?php endif;?>
            <?php if($headline):?><h2 <?php if($textColor || $alignHeadline):?> style="<?php if($alignHeadline == 'Center'):?>text-align: center;<?php endif;?><?php if($alignHeadline == 'Right'):?>text-align: right;<?php endif;?><?php if($alignHeadline == 'Left'):?>text-align: left;<?php endif;?><?php if($textColor):?>color: <?= $textColor; ?>;<?php endif;?>"<?php endif;?>><?= $headline; ?></h2><?php endif;?>
            <?php if($subline):?><span class="subline"<?php if($textColor):?> style="color: <?= $textColor; ?>;"<?php endif;?>><?= $subline; ?></span><?php endif;?>
            <?php if($text != null):?><span><?= $text; ?></span><?php endif;?>
        </div>
        <?php if( have_rows('icon_box')):?>
            <div class="icon-boxes-wrapper<?php if($subline):?> has-subline<?php endif;?>" <?php if($textColor):?> style="color: <?= $textColor; ?>;"<?php endif;?>>
                <?php while( have_rows('icon_box') ): the_row();
                $alignIconBox = get_sub_field('align_icon_box');
                $image = get_sub_field('image');
                $iconBoxIcon = get_sub_field('icon_box_icon');
                $iconBoxHeadline = get_sub_field('icon_box_headline');
                $iconBoxText = get_sub_field('icon_box_text');
                $iconOrImage = get_sub_field('icon_or_image');
                $iconColor = get_sub_field('icon_color');
                $iconColorBg = get_sub_field('icon_color_bg');?>
                    <div class="icon-box" 
                                                style="
                            <?php if($alignIconBox == 'Center'):?>text-align:center;<?php endif;?>
                            <?php if($alignIconBox == 'Right'):?>text-align:end;<?php endif;?>
                            <?php
                                // Calculate gap based on existing logic
                                $gap = 0;
                                if ($iconBoxesPerRow == '2') {
                                    $gap = 10; // Example gap, adjust as needed
                                    echo 'flex-basis: calc(50% - ' . $gap . 'px);';
                                } elseif ($iconBoxesPerRow == '3') {
                                    $gap = 26.66;
                                    echo 'flex-basis: calc(33.333% - ' . $gap . 'px);';
                                } elseif ($iconBoxesPerRow == '4') {
                                    $gap = 30;
                                    echo 'flex-basis: calc(25% - ' . $gap . 'px);';
                                }
                            ?>
                        "
                    >
                    <?php if($iconOrImage == 'Image'):?><img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large'); ?>" alt="<?= esc_attr(get_post_meta($image, '_wp_attachment_image_alt', true)); ?>" style="width:100%; margin-bottom: 20px;"><?php endif;?>
                        <?php if($iconOrImage == 'Icon'):?><i class="bi bi-<?= $iconBoxIcon; ?>" <?php if($icon_with_background_color == 'No'):?>style="color: <?= $iconColor; ?>;"<?php endif;?>
                            <?php if($icon_with_background_color == 'Yes'):?>style="<?php if($iconColor):?>color: <?= $iconColor; ?>;<?php endif;?><?php if(!$iconColor):?>color: #fff;<?php endif;?><?php if(!$iconColorBg):?> background-color: #93E100;<?php endif;?><?php if($iconColorBg):?> background-color: <?= $iconColorBg; ?>;<?php endif;?> border-radius: 20px; width: fit-content; padding-left: 15px; padding-right: 15px; padding-top: 3px; align-self: <?php if($alignIconBox == 'Center'):?>center;<?php endif;?><?php if($alignIconBox == 'Right'):?>end;<?php endif;?>"<?php endif;?>
                        ></i><?php endif;?>
                        <?php if($iconBoxHeadline):?><h3><?= $iconBoxHeadline; ?></h3><?php endif;?>
                        <span><?= $iconBoxText; ?></span>
                    </div>
                <?php endwhile;?>
            </div>
        <?php endif;?>
        
    </div>
</section>
