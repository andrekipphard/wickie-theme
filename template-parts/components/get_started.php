<?php
    $headline = get_sub_field('headline');
    $leftIcon = get_sub_field('left_icon');
    $leftHeadline = get_sub_field('left_headline');
    $leftButtonText = get_sub_field('left_button_text');
    $leftButtonUrl = get_sub_field('left_button_url');
    $rightIcon = get_sub_field('right_icon');
    $rightHeadline = get_sub_field('right_headline');
    $rightButtonText = get_sub_field('right_button_text');
    $rightButtonUrl = get_sub_field('right_button_url');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
?>
<section class="get-started<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    ">
    <div class="container">
        <h2><?= $headline; ?></h2>
        <div class="get-started-wrapper">
        <a class="left-box" href="<?=$leftButtonUrl;?>">
            <i class="left-box-icon bi bi-<?= $leftIcon; ?>"></i>
            <h3><?= $leftHeadline; ?></h3>
            <span class="btn btn-primary">
                <?= $leftButtonText; ?>
                <i class="bi bi-arrow-right"></i>
            </span>
        </a>
        <a class="right-box" href="<?=$rightButtonUrl;?>">
            <i class="right-box-icon bi bi-<?= $rightIcon; ?>"></i>
            <h3><?= $rightHeadline; ?></h3>
            <span class="btn btn-white">
                <?= $rightButtonText; ?>
                <i class="bi bi-arrow-right"></i>
            </span>
        </a>
    </div>
    </div>
    
</section>