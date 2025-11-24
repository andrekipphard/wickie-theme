<?php
$headline = get_sub_field('headline');
$subline = get_sub_field('subline');
$highlightText = get_sub_field('highlight_text');
$text = get_sub_field('text');
$backgroundImage = get_sub_field('background_image');
$backgroundImageSize = get_sub_field('background_image_size');
$backgroundImagePosition = get_sub_field('background_image_position');
$backgroundImageRepeat = get_sub_field('background_image_repeat');
$backgroundColor = get_sub_field('background_color');
$textColor = get_sub_field('text_color');
$backgroundImageUrl = $backgroundImage ? wp_get_attachment_image_url($backgroundImage, 'large') : '';
$fullHeight = get_sub_field('full_height');
?>
<section class="team<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    background-image: url('<?= $backgroundImageUrl; ?>');
    background-size: <?= $backgroundImageSize ?: 'cover'; ?>;
    background-repeat: <?= $backgroundImageRepeat ?: 'no-repeat'; ?>;
    background-position: <?= $backgroundImagePosition ?: 'center center'; ?>;
">
    <div class="container">
        <div class="text">
            <div class="subline">
                <?php if($highlightText != null):?>
                    <span class="highlight">
                        <?= $highlightText; ?>
                    </span>
                <?php endif;?>
            </div>
            <?php if($headline != null):?><h2><?= $headline; ?></h2><?php endif;?>
            <?php if($subline != null):?><h3><?= $subline; ?></h3><?php endif;?>
            <?php if($text != null):?><span><?= $text; ?></span><?php endif;?>
        </div>
        <?php if( have_rows('teammember')):?>
            <div class="team-members">
                <?php while( have_rows('teammember') ): the_row();
                    $teamMemberName = get_sub_field('teammember_name');
                    $teamMemberRole = get_sub_field('teammember_role');
                    $teamMemberText = get_sub_field('teammember_text');
                    $teamMemberImage = get_sub_field('teammember_image');
                    $teamMemberColorElement = get_sub_field('teammember_color_element');
                    $teamMemberColorElementXPosition = get_sub_field('teammember_color_element_x_position') ?: '-50';
                    $teamMemberColorElementYPosition = get_sub_field('teammember_color_element_y_position') ?: '50';
                    $circleColor = $teamMemberColorElement ?: '#93E100';?>
                    <div class="team-member" style="--team-member-color: <?= $circleColor; ?>; --x-position: <?= $teamMemberColorElementXPosition; ?>px; --y-position: <?= $teamMemberColorElementYPosition; ?>px;">
                        <?php if($teamMemberImage != null):?>
                        <div class="team-member-image">
                            <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($teamMemberImage, 'large'); ?>" alt="<?= esc_attr(get_post_meta($teamMemberImage, '_wp_attachment_image_alt', true)); ?>">
                        </div>
                        <?php endif;?>
                        <div class="team-member-information">
                            <?php if($teamMemberName != null):?><h3><?= $teamMemberName;?></h3><?php endif;?>
                            <?php if($teamMemberRole != null):?><h4><?= $teamMemberRole;?></h4><?php endif;?>
                            <?php if($teamMemberText != null):?><span><?= $teamMemberText;?></span><?php endif;?>
                        </div>
                    </div>
                <?php endwhile;?>
            </div>
        <?php endif;?>
    </div>
</section>