<?php
    $image = get_sub_field('image');
    $highlightText = get_sub_field('highlight_text');
    $headline = get_sub_field('headline');
    $text = get_sub_field('text');
    $buttonText = get_sub_field('button_text');
    $buttonUrl = get_sub_field('button_url');
    $fullHeight = get_sub_field('full_height');
?>
<section class="credit-card<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>">
    <div class="container">
        <a class="content-wrapper"<?php if($buttonUrl):?> href="<?= $buttonUrl; ?>"<?php endif;?>>
            <?php if($image):?><div class="image" style="background-image: url('<?= wp_get_attachment_image_url($image, 'large');?>;">
            </div>
            <?php endif;?>
            <div class="overlay"></div>
            <div class="content"<?php if(!$image):?> style="flex:100%;"<?php endif;?>>
                <span class="highlight">
                    <?= $highlightText; ?>
                </span>
                <h2><?= $headline; ?></h2>
                <span><?= $text; ?></span>
                <?php if($buttonText):?>
                <span class="btn btn-white">
                    <?= $buttonText; ?>
                    <i class="bi bi-arrow-right"></i>
                </span>
                <?php endif;?>
            </div>
        </a>
    </div>
</section>