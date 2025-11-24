<?php
    // Get the headline and text
    $headline = get_sub_field('headline');
    $text = get_sub_field('text');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $backgroundImage = get_sub_field('background_image');
    $backgroundImageSize = get_sub_field('background_image_size');
    $backgroundImagePosition = get_sub_field('background_image_position');
    $backgroundImageRepeat = get_sub_field('background_image_repeat');
    $fullHeight = get_sub_field('full_height');
    $paddingBottom = get_sub_field('padding_bottom');

    // Convert headline to a valid ID for the section
    $headlineId = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $headline), '-'));

    // Add a unique index or random number to ensure uniqueness
    $uniqueId = uniqid(); // This generates a unique identifier

    // Get the URL of the background image
    $backgroundImageUrl = $backgroundImage ? wp_get_attachment_image_url($backgroundImage, 'large') : '';
?>
<section class="downloads-section<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" id="faq-<?= $headlineId; ?>-<?= $uniqueId; ?>" style="
    <?php if ($textColor): ?>
        color: <?= $textColor; ?>;
    <?php endif; ?>
    <?php if ($backgroundColor): ?>
        background: <?= $backgroundColor; ?>;
    <?php endif; ?>
    <?php if ($backgroundImageUrl): ?>
        background-image: url('<?= $backgroundImageUrl; ?>');
        background-size: <?= $backgroundImageSize ? $backgroundImageSize : 'cover'; ?>;
        background-repeat: <?= $backgroundImageRepeat ? $backgroundImageRepeat : 'no-repeat'; ?>;
        background-position: <?= $backgroundImagePosition ? $backgroundImagePosition : 'center center'; ?>;
    <?php endif; ?>
    <?php if($paddingBottom === 'No'):?>
        padding-bottom: 0;
    <?php endif;?>>
">
    <div class="container">
        <div class="title">
            <h2><?= $headline; ?></h2>
            <span><?= $text; ?></span>
        </div>
        <div class="downloads">
            <?php if (have_rows('download_category')): ?>
                <?php while (have_rows('download_category')): the_row();
                    $downloadCategoryHeadline = get_sub_field('download_category_headline');
                    $downloadCategorySubline = get_sub_field('download_category_subline');
                ?>
                    <div class="downloads-category">
                        <h3><?= $downloadCategoryHeadline; ?></h3>
                        <?php if($downloadCategorySubline):?><span class="downloads-subline"><?= $downloadCategorySubline; ?></span><?php endif;?>
                        <?php if (have_rows('download_category_item')): ?>
                            <div class="downloads-items">
                                <?php while (have_rows('download_category_item')): the_row();
                                    $downloadCategoryItemHeadline = get_sub_field('download_category_item_headline');
                                    $downloadCategoryItemSubline = get_sub_field('download_category_item_subline');
                                    $downloadCategoryItemUrl = get_sub_field('download_category_item_url');
                                    $downloadCategoryItemIcon = get_sub_field('download_category_item_icon');
                                ?>
                                    <a href="<?= $downloadCategoryItemUrl; ?>" target="_blank">
                                        <div class="downloads-category-item-icon downloads-category-item-icon-bg">
                                            <i class="bi bi-file-earmark"></i>
                                        </div>
                                        <div class="downloads-item-information">
                                            <h4><?= $downloadCategoryItemHeadline; ?></h4>
                                            <span><?= $downloadCategoryItemSubline; ?></span>
                                        </div>
                                        <div class="downloads-category-item-icon">
                                            <?php if($downloadCategoryItemIcon): ?><i class="bi bi-<?= $downloadCategoryItemIcon; ?>"></i>
                                            <?php else:?><i class="bi bi-download"></i><?php endif;?>
                                        </div>
                                    </a>
                                <?php endwhile;?>
                            </div>
                        <?php endif;?>
                    </div>
                <?php endwhile;?>
            <?php endif;?>
        </div>
    </div>
</section>
