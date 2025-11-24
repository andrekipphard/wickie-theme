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

    // Convert headline to a valid ID for the section
    $headlineId = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $headline), '-'));

    // Add a unique index or random number to ensure uniqueness
    $uniqueId = uniqid(); // This generates a unique identifier

    // Get the URL of the background image
    $backgroundImageUrl = $backgroundImage ? wp_get_attachment_image_url($backgroundImage, 'large') : '';
?>
<section class="faq<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" id="faq-<?= $headlineId; ?>-<?= $uniqueId; ?>" style="
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
">
    <div class="container">
        <div class="title">
            <h2><?= $headline; ?></h2>
            <span><?= $text; ?></span>
        </div>
        <?php if (have_rows('faq_item')): ?>
            <div class="accordion" id="accordion-<?= $headlineId; ?>-<?= $uniqueId; ?>">
                <?php 
                while (have_rows('faq_item')): the_row();
                    $faqItemQuestion = get_sub_field('faq_item_question');
                    $faqItemAnswer = get_sub_field('faq_item_answer');

                    // Convert FAQ question to a valid ID
                    $faqItemId = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $faqItemQuestion), '-'));
                ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="heading-<?= $faqItemId; ?>-<?= $uniqueId; ?>">
                            <button style="<?php if($textColor):?>color: <?= $textColor; ?>;<?php endif;?>" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $faqItemId; ?>-<?= $uniqueId; ?>" aria-expanded="false" aria-controls="collapse-<?= $faqItemId; ?>-<?= $uniqueId; ?>">
                                <?= $faqItemQuestion; ?>
                            </button>
                        </h3>
                        <div style="<?php if($textColor):?>color: <?= $textColor; ?>;<?php endif;?>" id="collapse-<?= $faqItemId; ?>-<?= $uniqueId; ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?= $faqItemId; ?>-<?= $uniqueId; ?>" data-bs-parent="#accordion-<?= $headlineId; ?>-<?= $uniqueId; ?>">
                            <div class="accordion-body">
                                <?= $faqItemAnswer; ?>
                            </div>
                        </div>
                    </div>
                <?php 
                endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
