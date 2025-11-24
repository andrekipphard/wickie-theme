<?php
    $headline = get_sub_field('headline');
    $highlightText = get_sub_field('highlight_text');
    $mediaType = get_sub_field('media_type');
    $video = get_sub_field('video');
    $youtube = get_sub_field('youtube');
    $lottie = get_sub_field('lottie');
    $image = get_sub_field('image');
    $labelNameField = get_sub_field('label_name_field');
    $placeholderNameField = get_sub_field('placeholder_name_field');
    $labelFullAddressField = get_sub_field('label_full_address_field');
    $placeholderFullAddressField = get_sub_field('placeholder_full_address_field');
    $labelPhoneField = get_sub_field('label_phone_field');
    $placeholderPhoneField = get_sub_field('placeholder_phone_field');
    $labelYoutubeLinkField = get_sub_field('label_youtube_link_field');
    $placeholderYoutubeLinkField = get_sub_field('placeholder_youtube_link_field');
    $labelInstagramLinkField = get_sub_field('label_instagram_link_field');
    $placeholderInstagramLinkField = get_sub_field('placeholder_instagram_link_field');
    $labelTikTokLinkField = get_sub_field('label_tiktok_link_field');
    $placeholderTikTokLinkField = get_sub_field('placeholder_tiktok_link_field');
    $labelTermsField = get_sub_field('label_terms_field');
    $labelEmailField = get_sub_field('label_email_field');
    $placeholderEmailField = get_sub_field('placeholder_email_field');
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
    $anchorTag = get_sub_field('anchor_tag');
?>
<section id="<?php if($anchorTag) echo esc_attr($anchorTag); ?>" class="contact-form<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
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
            <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" class="contact-form-container reel-form-container" enctype="multipart/form-data">
                <div class="form-group-inline">
                    <div class="form-group form-group-name">
                        <label for="cf-name"><?= $labelNameField; ?></label>
                        <input type="text" id="cf-name" name="cf-name" placeholder="<?= $placeholderNameField; ?>" required>
                    </div>
                    <div class="form-group form-group-full-address">
                        <label for="cf-full-address"><?= $labelFullAddressField; ?></label>
                        <input type="text" id="cf-full-address" name="full_address" placeholder="<?= $placeholderFullAddressField; ?>" required>
                    </div>
                </div>
                <div class="form-group-inline">
                    <div class="form-group form-group-email">
                        <label for="cf-email"><?= $labelEmailField; ?></label>
                        <input type="email" id="cf-email" name="cf-email" placeholder="<?= $placeholderEmailField; ?>" required>
                    </div>
                    <div class="form-group form-group-phone">
                        <label for="cf-phone"><?= $labelPhoneField; ?></label>
                        <input type="tel" id="cf-phone" name="phone" placeholder="<?= $placeholderPhoneField; ?>" required>
                    </div>
                </div>
                <div class="form-group form-group-youtube-link">
                    <label for="cf-youtube-link"><?= $labelYoutubeLinkField; ?></label>
                    <input type="url" id="cf-youtube-link" name="youtube_link" placeholder="<?= $placeholderYoutubeLinkField; ?>">
                </div>
                <div class="form-group form-group-tiktok-link">
                    <label for="cf-tiktok-link"><?= $labelTikTokLinkField; ?></label>
                    <input type="url" id="cf-tiktok-link" name="tiktok_link" placeholder="<?= $placeholderTikTokLinkField; ?>">
                </div>
                <div class="form-group form-group-instagram-link">
                    <label for="cf-instagram-link"><?= $labelInstagramLinkField; ?></label>
                    <input type="url" id="cf-instagram-link" name="instagram_link" placeholder="<?= $placeholderInstagramLinkField; ?>">
                </div>
                <div class="form-group checkbox form-group-terms">
                    <label for="cf-terms">
                        <input type="checkbox" id="cf-terms" name="terms" required>
                        <?= $labelTermsField; ?>
                    </label>
                </div>
                <!-- reCAPTCHA v2 Checkbox -->
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6LfCOdErAAAAACopmMHldK_RU3CPQCllgu7EzyvQ"></div>
                </div>
                <input type="hidden" name="browser_lang" id="browser_lang">
                <div class="form-group form-group-submit">
                    <input type="submit" name="cf-submitted" value="<?= $labelButton; ?>" class="btn btn-primary">
                </div>
            </form>
            <?php
                $show_error = false;
                $error_message = '';
                $form_submitted = isset($_POST['cf-submitted']);
                
                if ($form_submitted) {
                    // reCAPTCHA v2 Überprüfung
                    $recaptcha_secret = '6LfCOdErAAAAACteXThpE9QOKll2TPsy03IzuLjR';
                    $recaptcha_response = sanitize_text_field($_POST['g-recaptcha-response']);
                    
                    if (empty($recaptcha_response)) {
                        $show_error = true;
                        $error_message = 'Please complete the reCAPTCHA.';
                    } else {
                        $response = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', [
                            'body' => [
                                'secret' => $recaptcha_secret,
                                'response' => $recaptcha_response,
                            ],
                        ]);

                        $response_body = wp_remote_retrieve_body($response);
                        $result = json_decode($response_body, true);

                        // reCAPTCHA v2 - nur success prüfen (kein Score)
                        if (!$result['success']) {
                            $show_error = true;
                            $error_message = 'reCAPTCHA verification failed. Please try again.';
                        } else {
                            // Eingaben bereinigen
                            $name = sanitize_text_field($_POST['cf-name']);
                            $full_address = sanitize_text_field($_POST['full_address']);
                            $email = sanitize_email($_POST['cf-email']);
                            $phone = sanitize_text_field($_POST['phone']);
                            $youtube_link = esc_url_raw($_POST['youtube_link']);
                            $tiktok_link = esc_url_raw($_POST['tiktok_link']);
                            $instagram_link = esc_url_raw($_POST['instagram_link']);
                            
                            // At least one link must be filled
                            if (empty($youtube_link) && empty($tiktok_link) && empty($instagram_link)) {
                                $show_error = true;
                                $error_message = 'Please provide at least one link to YouTube, TikTok, or Instagram.';
                            } else {
                                $terms = isset($_POST['terms']) ? 'Ja' : 'Nein';

                                // Get the "From Email" from WP Mail SMTP settings with fallback
                                $from_email = get_option('wp_mail_smtp_mail_from');
                                if (empty($from_email)) {
                                    // Fallback to WordPress default or your custom fallback
                                    $from_email = get_option('admin_email'); // WordPress admin email
                                    if (empty($from_email)) {
                                        $from_email = 'support@wickie.io'; // Your hardcoded fallback
                                    }
                                }

                                // Get the "From Name" from WP Mail SMTP settings with fallback
                                $from_name = get_option('wp_mail_smtp_mail_from_name');
                                if (empty($from_name)) {
                                    $from_name = get_bloginfo('name'); // Site name as fallback
                                    if (empty($from_name)) {
                                        $from_name = 'Wickie.io'; // Your hardcoded fallback
                                    }
                                }

                                // Admin-E-Mail konfigurieren
                                $to = $emailRecipient;
                                $subject = 'Reel Contest Submission from ' . $name;
                                $body = "Name: $name\n" .
                                    "Adresse: $full_address\n" .
                                    "E-Mail: $email\n" .
                                    "Telefon: $phone\n" .
                                    "YouTube Link: $youtube_link\n" .
                                    "TikTok Link: $tiktok_link\n" .
                                    "Instagram Link: $instagram_link\n" .
                                    "Zustimmung zu Teilnahmebedingungen: $terms\n";
                                $headers = array(
                                    'Content-Type: text/plain; charset=UTF-8',
                                    'From: ' . $from_name . ' <' . $from_email . '>',
                                    'Reply-To: ' . $email,
                                );

                                wp_mail($to, $subject, $body, $headers);

                                // Bestätigungs-E-Mail an den Kunden senden
                                $lang = isset($_POST['browser_lang']) ? $_POST['browser_lang'] : get_bloginfo('language');
                                if ( strpos($lang, 'de') === 0 ) {
                                    $customer_subject = 'Danke für deine Teilnahme am Reel Contest!';
                                    $customer_body = "Hallo $name,\n\nvielen Dank für das Ausfüllen des Formulars und deine Teilnahme am Reel Contest!\n\nViel Glück beim Gewinnspiel!\n\nBeste Grüße,\nDas Wickie Team";
                                } else {
                                    $customer_subject = 'Thank you for your Reel Contest submission!';
                                    $customer_body = "Hi $name,\n\n Thank you for filling out the form and participating in our Reel Contest!\n\nGood luck on winning!\n\nBest regards,\nThe Wickie Team";
                                }
                                $customer_headers = array(
                                    'Content-Type: text/plain; charset=UTF-8',
                                    'From: ' . $from_name . ' <' . $from_email . '>',
                                );

                                wp_mail($email, $customer_subject, $customer_body, $customer_headers);
                            }
                        }
                    }
                }
                
                // Show messages with specific IDs for scrolling
                if ($form_submitted && $show_error) {
                    echo '<div id="form-message" class="error-message">' . $error_message . '</div>';
                } elseif ($form_submitted && !$show_error) {
                    echo '<div id="form-message" class="success-message">' . $successMessage . '</div>';
                }
                
                // Scroll directly to the message
                if ($form_submitted) {
                    echo '<script>
                        window.addEventListener("load", function() {
                            setTimeout(function() {
                                // Reset reCAPTCHA if there was an error
                                if (' . ($show_error ? 'true' : 'false') . ' && typeof grecaptcha !== "undefined") {
                                    grecaptcha.reset();
                                }
                                
                                // Scroll to the message instead of the section
                                var messageElement = document.getElementById("form-message");
                                if (messageElement) {
                                    messageElement.scrollIntoView({
                                        behavior: "smooth",
                                        block: "center"
                                    });
                                }
                            }, 300);
                            
                            // Additional timeout for mobile devices
                            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                                setTimeout(function() {
                                    var messageElement = document.getElementById("form-message");
                                    if (messageElement) {
                                        messageElement.scrollIntoView({
                                            behavior: "smooth",
                                            block: "center"
                                        });
                                    }
                                }, 800);
                            }
                        });
                    </script>';
                }
            ?>
        </div>
    </div>
</section>
<!-- reCAPTCHA v2 Script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var fileInput = document.getElementById('cf-file');
    var fileSelected = document.getElementById('file-selected');
    if(fileInput) {
        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                fileSelected.textContent = fileInput.files[0].name;
            } else {
                fileSelected.textContent = '';
            }
        });
    }
});

document.getElementById('browser_lang').value = navigator.language || navigator.userLanguage;
</script>
