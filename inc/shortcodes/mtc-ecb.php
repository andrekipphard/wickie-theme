<?php
// ECB FX rates fetch and cache logic
// Fetches daily rates from ECB, caches in wp-content/uploads/ecb_rates.json
// Provides AJAX endpoint for calculator

add_action('init', 'mtc_schedule_ecb_rates_fetch');
function mtc_schedule_ecb_rates_fetch() {
    if (!wp_next_scheduled('mtc_fetch_ecb_rates_daily')) {
        wp_schedule_event(time(), 'daily', 'mtc_fetch_ecb_rates_daily');
    }
}
add_action('mtc_fetch_ecb_rates_daily', 'mtc_fetch_and_cache_ecb_rates');

function mtc_fetch_and_cache_ecb_rates() {
    $url = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';
    $response = wp_remote_get($url, ['timeout' => 10]);
    if (is_wp_error($response)) return;
    $body = wp_remote_retrieve_body($response);
    if (!$body) return;
    $xml = simplexml_load_string($body);
    if (!$xml) return;
    $rates = ['EUR' => 1.0];
    foreach ($xml->Cube->Cube->Cube as $cube) {
        $currency = (string)$cube['currency'];
        $rate = (float)$cube['rate'];
        $rates[$currency] = $rate;
    }
    $upload_dir = wp_upload_dir();
    $file = trailingslashit($upload_dir['basedir']) . 'ecb_rates.json';
    file_put_contents($file, json_encode($rates));
}

add_action('wp_ajax_mtc_get_ecb_rate', 'mtc_get_ecb_rate_ajax');
add_action('wp_ajax_nopriv_mtc_get_ecb_rate', 'mtc_get_ecb_rate_ajax');
function mtc_get_ecb_rate_ajax() {
    $from = isset($_GET['from']) ? sanitize_text_field($_GET['from']) : '';
    $to = isset($_GET['to']) ? sanitize_text_field($_GET['to']) : '';
    if (!$from || !$to) {
        wp_send_json_error(['error' => 'Missing parameters.']);
    }
    $upload_dir = wp_upload_dir();
    $file = trailingslashit($upload_dir['basedir']) . 'ecb_rates.json';
    if (!file_exists($file)) {
        mtc_fetch_and_cache_ecb_rates(); // Try to fetch if missing
    }
    if (!file_exists($file)) {
        wp_send_json_error(['error' => 'Rates unavailable.']);
    }
    $rates = json_decode(file_get_contents($file), true);
    if (!$rates || !isset($rates[$from]) || !isset($rates[$to])) {
        wp_send_json_error(['error' => 'Rate unavailable.']);
    }
    // Convert via EUR as base
    $rate = $rates[$to] / $rates[$from];
    wp_send_json_success(['rate' => $rate, 'from' => $from, 'to' => $to]);
}
