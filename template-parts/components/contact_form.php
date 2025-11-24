<?php
    $headline = get_sub_field('headline');
    $highlightText = get_sub_field('highlight_text');
    $mediaType = get_sub_field('media_type');
    $video = get_sub_field('video');
    $youtube = get_sub_field('youtube');
    $lottie = get_sub_field('lottie');
    $image = get_sub_field('image');
    $labelNameField = get_sub_field('label_name_field');
    $labelEmailField = get_sub_field('label_email_field');
    $labelMessageField = get_sub_field('label_message_field');
    $labelButton = get_sub_field('label_button');
    $emailRecipient = get_sub_field('email_recipient');
    $successMessage = get_sub_field('success_message');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
    $subline = get_sub_field('subline');
    $text = get_sub_field('text');
    $imageWidth = get_sub_field('image_width');
    $imagePosition = get_sub_field('image_position');
?>
<section class="contact-form<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    ">
    <div class="container">
        <div class="contact-form-img"<?php if ($imageWidth || $imagePosition): ?> style="<?php if($imageWidth):?>--image-width: <?= $imageWidth; ?>;<?php endif;?><?php if($imagePosition):?>--image-position:<?php if($imagePosition === 'Top'):?> flex-start;<?php endif; ?><?php if($imagePosition === 'Center'):?> center;<?php endif; ?><?php if($imagePosition === 'Bottom'):?> flex-end;<?php endif; ?><?php endif;?>"<?php endif; ?>>
            <?php if($mediaType === 'Image'):?>
                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large'); ?>" alt="<?= esc_attr(get_post_meta($image, '_wp_attachment_image_alt', true)); ?>">
            <?php endif;?>
            <?php if($mediaType === 'Video'):?>
                <video controls autoplay muted preload="metadata" class="video">
                    <source src="<?= $video; ?>" type="video/mp4">
                </video>
            <?php endif;?>
            <?php if($mediaType === 'Youtube'):?>
                <div class="iframe-container">
                    <iframe src="<?= $youtube; ?>?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            <?php endif;?>
            <?php if($mediaType === 'Lottie'):?>
                <?= $lottie; ?>
            <?php endif;?>
        </div>
        <div class="contact-form-form">
        <?php if ($highlightText): ?><span class="highlight"><?= $highlightText; ?></span><?php endif; ?>
            <h2><?= $headline; ?></h2>
            <?php if ($subline): ?>
                <h3>
                    <?= $subline; ?>
                </h3>
            <?php endif; ?>
            <?php if ($text): ?>  
                <span>
                    <?= $text; ?>
                </span>
            <?php endif; ?>
            <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" class="contact-form-container">
                <div class="form-group">
                    <label for="cf-name"><?= $labelNameField; ?></label>
                    <input type="text" id="cf-name" name="cf-name" required>
                </div>
                <div class="form-group">
                    <label for="cf-email"><?= $labelEmailField; ?></label>
                    <input type="email" id="cf-email" name="cf-email" required>
                </div>
                <div class="form-group">
                    <label for="cf-message"><?= $labelMessageField; ?></label>
                    <textarea id="cf-message" name="cf-message" rows="5" required></textarea>
                </div>
                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                <div class="form-group">
                    <input type="submit" name="cf-submitted" value="<?= $labelButton; ?>" class="btn btn-primary">
                </div>
            </form>
            <?php
                if (isset($_POST['cf-submitted'])) {
                    // reCAPTCHA v3 Überprüfung
                    $recaptcha_secret = '6Leoh40qAAAAAKA6KFGhe9VYym7d7Eutvpdl1Y4c';
                    $recaptcha_response = sanitize_text_field($_POST['g-recaptcha-response']);
                    
                    $response = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', [
                        'body' => [
                            'secret' => $recaptcha_secret,
                            'response' => $recaptcha_response,
                        ],
                    ]);

                    $response_body = wp_remote_retrieve_body($response);
                    $result = json_decode($response_body, true);

                    // Mindestsicherheitswert festlegen (z.B. 0.5)
                    if (!$result['success'] || $result['score'] < 0.5) {
                        echo '<div class="error-message">Failed reCAPTCHA verification. Please try again.</div>';
                        return;
                    }

                    // Eingaben bereinigen
                    $name = sanitize_text_field($_POST['cf-name']);
                    $email = sanitize_email($_POST['cf-email']);
                    $message = esc_textarea($_POST['cf-message']);

                    // Admin-E-Mail konfigurieren
                    $to = $emailRecipient; // Admin-E-Mail-Adresse
                    $subject = 'Contact Form Submission from ' . $name;
                    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
                    $headers = array(
                        'Content-Type: text/plain; charset=UTF-8',
                        'From: ' . $name . ' <' . $email . '>', // Standard-Absender
                        'Reply-To: ' . $email, // Kunde als Antwortadresse
                    );

                    // E-Mail an Admin senden
                    wp_mail($to, $subject, $body, $headers);

                    // Erfolgsmeldung anzeigen
                    echo '<div class="success-message">' . $successMessage . '</div>';
                }
            ?>
        </div>
    </div>
</section>
<script src="https://www.google.com/recaptcha/api.js?render=6Leoh40qAAAAANkcI0yWKx4Pg1oxiISQ9t6Rs-me"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('6Leoh40qAAAAANkcI0yWKx4Pg1oxiISQ9t6Rs-me', { action: 'submit' }).then(function (token) {
            document.getElementById('g-recaptcha-response').value = token;
        });
    });
</script>
