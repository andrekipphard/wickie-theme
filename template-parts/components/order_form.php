<?php
if (!defined('ABSPATH')) {
    exit;
}

$product_id = get_sub_field('product_id');
$headline = get_sub_field('headline');
$highlightText = get_sub_field('highlight_text');
$backgroundColor = get_sub_field('background_color');
$textColor = get_sub_field('text_color');
$fullHeight = get_sub_field('full_height');
$subline = get_sub_field('subline');
$text = get_sub_field('text');
$imageWidth = get_sub_field('image_width');
$imagePosition = get_sub_field('image_position');
$mediaType = get_sub_field('media_type');
$video = get_sub_field('video');
$youtube = get_sub_field('youtube');
$lottie = get_sub_field('lottie');
$image = get_sub_field('image');
$successMessage = 'Your order was successful. You will receive the invoice via E-Mail. After payment we will send the game.';

?>

<section class="contact-form order-form<?php if ($fullHeight === 'Yes'): ?> full-height<?php endif; ?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    ">
    <div class="container">
        <div class="contact-form-img"<?php if ($imageWidth || $imagePosition): ?> style="<?php if ($imageWidth): ?>--image-width: <?= $imageWidth; ?>;<?php endif; ?><?php if ($imagePosition): ?>--image-position:<?php if ($imagePosition === 'Top'): ?> flex-start;<?php endif; ?><?php if ($imagePosition === 'Center'): ?> center;<?php endif; ?><?php if ($imagePosition === 'Bottom'): ?> flex-end;<?php endif; ?><?php endif; ?>"<?php endif; ?>>
            <?php if ($mediaType === 'Image'): ?>
                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large'); ?>" alt="<?= esc_attr(get_post_meta($image, '_wp_attachment_image_alt', true)); ?>">
            <?php endif; ?>
            <?php if ($mediaType === 'Video'): ?>
                <video controls autoplay muted preload="metadata" class="video">
                    <source src="<?= $video; ?>" type="video/mp4">
                </video>
            <?php endif; ?>
            <?php if ($mediaType === 'Youtube'): ?>
                <div class="iframe-container">
                    <iframe src="<?= $youtube; ?>?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            <?php endif; ?>
            <?php if ($mediaType === 'Lottie'): ?>
                <?= $lottie; ?>
            <?php endif; ?>
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
            <form method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" class="contact-form-container">
                <div class="form-group-inline">
                    <div class="form-group">
                        <label for="customer_first_name">First Name:</label>
                        <input type="text" id="customer_first_name" name="customer_first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="customer_last_name">Last Name:</label>
                        <input type="text" id="customer_last_name" name="customer_last_name" required>
                    </div>
                </div>
                <div class="form-group-inline">
                    <div class="form-group">
                        <label for="customer_email">E-Mail:</label>
                        <input type="email" id="customer_email" name="customer_email" required>
                    </div>
                    <div class="form-group">
                        <label for="customer_phone">Phone:</label>
                        <input type="text" id="customer_phone" name="customer_phone" required>
                    </div>
                </div>
                <div class="form-group-inline">
                    <div class="form-group">
                        <label for="customer_address">Address:</label>
                        <input type="text" id="customer_address" name="customer_address" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <select id="country" name="country" required>
                            <option value="" disabled selected>Select your country</option>
                            <?php foreach (WC()->countries->get_countries() as $code => $name): ?>
                                <option value="<?= esc_attr($code); ?>"><?= esc_html($name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group-inline">
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="state">State:</label>
                        <input type="text" id="state" name="state" required>
                    </div>
                </div>
                <div class="form-group-inline">
                    <div class="form-group">
                        <label for="postcode">Postcode:</label>
                        <input type="text" id="postcode" name="postcode" required>
                    </div>
                </div>
                <div class="form-group">
                    <!-- reCAPTCHA v2 Checkbox -->
                    <div class="g-recaptcha" data-sitekey="6LfCOdErAAAAACopmMHldK_RU3CPQCllgu7EzyvQ"></div>
                    <button type="submit" name="submit_order" class="btn btn-primary">Submit order</button>
                </div>
            </form>
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_order'])) {
                // reCAPTCHA v2 verification
                $recaptcha_secret = '6LfCOdErAAAAACteXThpE9QOKll2TPsy03IzuLjR';
                $recaptcha_response = sanitize_text_field($_POST['g-recaptcha-response']);

                if (empty($recaptcha_response)) {
                    echo '<div id="form-message" class="error-message">Please complete the reCAPTCHA.</div>';
                    // Scroll to error message
                    echo '<script>
                        window.addEventListener("load", function() {
                            setTimeout(function() {
                                var messageElement = document.getElementById("form-message");
                                if (messageElement) {
                                    messageElement.scrollIntoView({
                                        behavior: "smooth",
                                        block: "center"
                                    });
                                }
                            }, 300);
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
                    return;
                } else {
                    $response = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', [
                        'body' => [
                            'secret' => $recaptcha_secret,
                            'response' => $recaptcha_response,
                        ],
                    ]);
                    $response_body = wp_remote_retrieve_body($response);
                    $result = json_decode($response_body, true);

                    if (!$result['success']) {
                        echo '<div id="form-message" class="error-message">reCAPTCHA verification failed. Please try again.</div>';
                        // Scroll to error message
                        echo '<script>
                            window.addEventListener("load", function() {
                                setTimeout(function() {
                                    var messageElement = document.getElementById("form-message");
                                    if (messageElement) {
                                        messageElement.scrollIntoView({
                                            behavior: "smooth",
                                            block: "center"
                                        });
                                    }
                                }, 300);
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
                        return;
                    }
                }

                if (!function_exists('wc_get_product')) {
                    return;
                }

                // Sanitize form inputs
                $customer_first_name = sanitize_text_field($_POST['customer_first_name']);
                $customer_last_name = sanitize_text_field($_POST['customer_last_name']);
                $customer_email = sanitize_email($_POST['customer_email']);
                $customer_phone = sanitize_text_field($_POST['customer_phone']);
                $customer_address = sanitize_text_field($_POST['customer_address']);
                $state = sanitize_text_field($_POST['state']);
                $city = sanitize_text_field($_POST['city']);
                $postcode = sanitize_text_field($_POST['postcode']);
                $country = sanitize_text_field($_POST['country']); // This is your custom select field

                // Create WooCommerce order
                $order = wc_create_order();
                $order->add_product(wc_get_product($product_id), 1);

                $billing_address = [
                    'first_name' => $customer_first_name,
                    'last_name'  => $customer_last_name,
                    'email'      => $customer_email,
                    'phone'      => $customer_phone,
                    'address_1'  => $customer_address,
                    'state'      => $state,
                    'city'       => $city,
                    'postcode'   => $postcode,
                    'country'    => $country, // Map the country field to WooCommerce's billing_country
                ];

                $order->set_address($billing_address, 'billing');
                $order->set_address($billing_address, 'shipping');

                // Determine shipping cost based on country
                $shipping_cost_incl_vat = 0;
                $vat_rate = 0;

                // Get the VAT rate for the customer's country
                $tax_rates = WC_Tax::find_rates([
                    'country'  => $country,
                    'state'    => $state,
                    'postcode' => $postcode,
                    'city'     => $city,
                ]);
                error_log("Tax rates for country $country: " . print_r($tax_rates, true));

                if (!empty($tax_rates)) {
                    $vat_rate = reset($tax_rates)['rate']; // Get the first tax rate (percentage)
                    $vat_rate = $vat_rate / 100; // Convert percentage to decimal
                } else {
                    // Fallback for Germany
                    if ($country === 'DE') {
                        $vat_rate = 0.19; // Default to 19% VAT
                        error_log("Fallback VAT rate applied for country: $country");
                    } else {
                        error_log("No VAT rate found for country: $country");
                    }
                }

                // Ensure VAT rate is set correctly
                if ($vat_rate === 0) {
                    error_log("VAT rate is 0 for country: $country. Defaulting to 0%.");
                }

                // Set shipping cost inclusive of VAT
                if ($country === 'DE') {
                    // Germany: Flat rate €9.99 incl. VAT
                    $shipping_cost_incl_vat = 3.95;
                } elseif (in_array($country, ['AT', 'BE', 'BG', 'CY', 'CZ', 'DK', 'EE', 'ES', 'FI', 'FR', 'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PL', 'PT', 'RO', 'SE', 'SI', 'SK'])) {
                    // EU (excluding Germany): Flat rate €9.99 incl. VAT
                    $shipping_cost_incl_vat = 9.99;
                } else {
                    // Rest of the World: Flat rate €14.99 incl. VAT
                    $shipping_cost_incl_vat = 14.99;
                }

                $shipping_cost_excl_vat = $shipping_cost_incl_vat / (1 + 0.21);

                // Debugging: Log the calculated values
                error_log("Country: $country, VAT Rate: $vat_rate, Shipping Cost (Incl. VAT): $shipping_cost_incl_vat, Shipping Cost (Excl. VAT): $shipping_cost_excl_vat");

                // Set shipping method
                $shipping_methods = WC()->shipping->get_shipping_methods();
                $chosen_shipping_method = 'flat_rate'; // Replace with your shipping method ID
                $shipping_item = new WC_Order_Item_Shipping();
                $shipping_item->set_method_id($chosen_shipping_method);
                $shipping_item->set_method_title($shipping_methods[$chosen_shipping_method]->get_title());
                $shipping_item->set_total($shipping_cost_excl_vat); // Set the base cost (excl. VAT)
                $shipping_item->set_tax_status('taxable'); // Mark as taxable
                $shipping_item->set_taxes([
                    'total' => [$vat_rate * $shipping_cost_excl_vat], // Add VAT to the shipping cost
                ]);
                $order->add_item($shipping_item);

                // Calculate taxes
                $taxes = WC_Tax::calc_tax($order->get_subtotal(), WC_Tax::get_rates($billing_address['country']), false);
                foreach ($taxes as $rate_id => $tax_amount) {
                    $tax_item = new WC_Order_Item_Tax();
                    $tax_item->set_rate_id($rate_id);
                    $tax_item->set_tax_total($tax_amount);
                    $order->add_item($tax_item);
                }

                // Calculate totals
                $order->calculate_totals();

                // Set payment method
                $order->set_payment_method('bacs');

                // Update order status
                $order->update_status('on-hold', 'Order created via user-defined form.');

                echo '<div id="form-message" class="success-message">' . $successMessage . '</div>';
                // Scroll to success message
                echo '<script>
                    window.addEventListener("load", function() {
                        setTimeout(function() {
                            var messageElement = document.getElementById("form-message");
                            if (messageElement) {
                                messageElement.scrollIntoView({
                                    behavior: "smooth",
                                    block: "center"
                                });
                            }
                        }, 300);
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
