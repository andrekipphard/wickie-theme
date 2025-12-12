<?php
// Shortcode to display supported countries as a table
add_shortcode('supported_countries_table', function() {
    if (!function_exists('get_field')) return '';
    $countries = get_field('supported_country', 'option');
    if (!$countries || !is_array($countries)) return '';
    ob_start();
    ?>
    <div class="legal-table" tabindex="0" role="region">
    <table>
        <thead>
            <tr>
                <th>Country Code</th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($countries as $country): ?>
            <tr>
                <td><?= esc_html($country['country_code'] ?? '') ?></td>
                <td><?= esc_html($country['country_name'] ?? '') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php
    return ob_get_clean();
});