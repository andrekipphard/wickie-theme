<?php
// Shortcode: Money Transfer Calculator
add_shortcode('money_transfer_calculator', function() {
    if (!function_exists('get_field')) return '';
    $countries = get_field('supported_country', 'option');
    $non_supported = get_field('non_supported_country', 'option');
    if (!$countries || !is_array($countries)) return '';
    // Build a set of non-supported country codes for fast lookup
    $non_supported_codes = array();
    if ($non_supported && is_array($non_supported)) {
        foreach ($non_supported as $c) {
            if (!empty($c['country_code'])) {
                $non_supported_codes[$c['country_code']] = true;
            }
        }
    }
    // Filter out any country in non_supported_country
    $countries = array_filter($countries, function($c) use ($non_supported_codes) {
        return empty($non_supported_codes[$c['country_code'] ?? '']);
    });

    // Static mapping: country_code => currency_code
    // Mapping: country_code => currency_code (ECB supported)
    $country_currency = [
        'DE' => 'EUR', 'GB' => 'GBP', 'FR' => 'EUR', 'US' => 'USD', 'IN' => 'INR', 'IT' => 'EUR', 'ES' => 'EUR', 'NL' => 'EUR', 'PL' => 'PLN', 'SE' => 'SEK', 'CH' => 'CHF', 'AT' => 'EUR', 'IE' => 'EUR', 'PT' => 'EUR', 'BE' => 'EUR', 'FI' => 'EUR', 'GR' => 'EUR', 'CZ' => 'CZK', 'DK' => 'DKK', 'NO' => 'NOK', 'HU' => 'HUF', 'RO' => 'RON', 'BG' => 'BGN', 'HR' => 'EUR', 'LT' => 'EUR', 'LU' => 'EUR', 'SK' => 'EUR', 'SI' => 'EUR', 'EE' => 'EUR', 'LV' => 'EUR', 'CY' => 'EUR', 'MT' => 'EUR', 'CA' => 'CAD', 'AU' => 'AUD', 'NZ' => 'NZD', 'ZA' => 'ZAR', 'JP' => 'JPY', 'KR' => 'KRW', 'HK' => 'HKD', 'SG' => 'SGD', 'BR' => 'BRL', 'MX' => 'MXN', 'MY' => 'MYR', 'ID' => 'IDR', 'PH' => 'PHP', 'TH' => 'THB', 'TRY' => 'TRY'
    ];
    // Fallback: if a country is not mapped, use USD
    foreach ($countries as $country) {
        $code = $country['country_code'] ?? '';
        if ($code && !isset($country_currency[$code])) {
            $country_currency[$code] = 'USD';
        }
    }

    // Build dropdowns

    $options_from = '';
    $options_to = '';
    foreach ($countries as $country) {
        $code = $country['country_code'] ?? '';
        $name = $country['country_name'] ?? '';
        $currency = $country_currency[$code] ?? '';
        $flag = strtolower($code);
        if ($code && $name && $currency) {
            $selected_from = ($code === 'DE') ? ' selected' : '';
            $selected_to = ($code === 'GB') ? ' selected' : '';
            $options_from .= '<option value="' . esc_attr($code) . '" data-currency="' . esc_attr($currency) . '" data-flag="' . esc_attr($flag) . '"' . $selected_from . '>' . esc_html($name) . ' (' . esc_html($currency) . ')</option>';
            $options_to .= '<option value="' . esc_attr($code) . '" data-currency="' . esc_attr($currency) . '" data-flag="' . esc_attr($flag) . '"' . $selected_to . '>' . esc_html($name) . ' (' . esc_html($currency) . ')</option>';
        }
    }

    ob_start();
    ?>
    <div id="money-transfer-calculator" class="money-transfer-calculator">
        <form onsubmit="return false;">
            <div class="mtc-row mtc-amount-row">
                <div class="mtc-amount-input-group">
                    <label for="mtc-amount" class="mtc-floating-label">You send</label>
                    <input type="number" id="mtc-amount" name="amount" min="1" value="100" step="1" autocomplete="off" inputmode="numeric">
                    <div class="mtc-custom-select" id="mtc-from-custom"></div>
                    <select id="mtc-from" name="from" style="display:none;">
                        <?= $options_from ?>
                    </select>
                </div>
            </div>
            <div class="mtc-row mtc-receive-row">
                <div class="mtc-amount-input-group">
                    <label for="mtc-receive" class="mtc-floating-label">Recipient receives</label>
                    <input id="mtc-receive" name="receive" type="text" readonly tabindex="-1">
                    <div class="mtc-custom-select" id="mtc-to-custom"></div>
                    <select id="mtc-to" name="to" style="display:none;">
                        <?= $options_to ?>
                    </select>
                </div>
            </div>
            <div class="mtc-row mtc-result" style="display:none;">
                <div id="mtc-error" style="color:#c00;display:none;"></div>
                <div id="mtc-loader" class="mtc-loader" style="display:none;"></div>
                <div id="mtc-result-content">
                    <div class="mtc-result-row"><span class="mtc-label">Fee (3.5%):</span><span class="mtc-leader"></span><span id="mtc-fee"></span></div>
                    <div class="mtc-result-row"><span class="mtc-label">Today's Rate:</span><span class="mtc-leader"></span><span id="mtc-rate"></span></div>
                    <div class="mtc-result-row"><span class="mtc-label">Should arrive:</span><span class="mtc-leader"></span><span id="mtc-info">In a few minutes</span></div>
                </div>
            </div>
        </form>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Helper to get flag URL
        function getFlagUrl(code) {
            return 'https://flagcdn.com/24x18/' + code.toLowerCase() + '.png';
        }

        function buildCustomSelect(selectId, customId) {
            const select = document.getElementById(selectId);
            const custom = document.getElementById(customId);
            if (!select || !custom) return;
            // Build custom select HTML
            let selectedIdx = select.selectedIndex;
            function renderSelected() {
                const opt = select.options[selectedIdx];
                const flag = opt.getAttribute('data-flag');
                const currency = opt.getAttribute('data-currency');
                custom.innerHTML = `<a href="#" class="mtc-custom-selected" tabindex="0"><img src="${getFlagUrl(flag)}" alt="${flag}" class="mtc-flag-img"> <span class="mtc-currency">${currency}</span> <span class="mtc-chevron">&#9662;</span></a>`;
            }
            function renderDropdown() {
                let html = '<div class="mtc-custom-dropdown">';
                for (let i = 0; i < select.options.length; i++) {
                    const opt = select.options[i];
                    const flag = opt.getAttribute('data-flag');
                    const name = opt.textContent.replace(/ \(.+\)$/, '');
                    const currency = opt.getAttribute('data-currency');
                    html += `<div class="mtc-custom-option" data-idx="${i}"><img src="${getFlagUrl(flag)}" alt="${flag}" class="mtc-flag-img"> <span class="mtc-country">${name}</span> <span class="mtc-currency">${currency}</span></div>`;
                }
                html += '</div>';
                custom.insertAdjacentHTML('beforeend', html);
            }
            function openDropdown() {
                closeDropdown();
                renderDropdown();
                const dropdown = custom.querySelector('.mtc-custom-dropdown');
                dropdown.addEventListener('mousedown', function(e) {
                    if (e.target.closest('.mtc-custom-option')) {
                        const idx = e.target.closest('.mtc-custom-option').getAttribute('data-idx');
                        select.selectedIndex = idx;
                        selectedIdx = idx;
                        select.dispatchEvent(new Event('change'));
                        renderSelected();
                        closeDropdown();
                    }
                });
                document.addEventListener('mousedown', closeDropdownOnClick);
            }
            function closeDropdown() {
                const dd = custom.querySelector('.mtc-custom-dropdown');
                if (dd) dd.remove();
                document.removeEventListener('mousedown', closeDropdownOnClick);
            }
            function closeDropdownOnClick(e) {
                if (!custom.contains(e.target)) closeDropdown();
            }
            custom.onclick = function(e) {
                e.preventDefault();
                if (custom.querySelector('.mtc-custom-dropdown')) {
                    closeDropdown();
                } else {
                    openDropdown();
                }
            };
            custom.onkeydown = function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    openDropdown();
                }
            };
            select.addEventListener('change', function() {
                selectedIdx = select.selectedIndex;
                renderSelected();
            });
            renderSelected();
        }

        buildCustomSelect('mtc-from', 'mtc-from-custom');
        buildCustomSelect('mtc-to', 'mtc-to-custom');

        const from = document.getElementById('mtc-from');
        const to = document.getElementById('mtc-to');
        const amount = document.getElementById('mtc-amount');
        const feeEl = document.getElementById('mtc-fee');
        const rateEl = document.getElementById('mtc-rate');
        const receiveInput = document.getElementById('mtc-receive');
        const result = document.querySelector('.mtc-result');
        const errorEl = document.getElementById('mtc-error');
        const loader = document.getElementById('mtc-loader');
        const resultContent = document.getElementById('mtc-result-content');

        function showLoader() {
            if (result) result.style.display = 'block';
            if (loader) loader.style.display = 'flex';
            if (resultContent) resultContent.style.display = 'none';
        }
        function hideLoader() {
            if (loader) loader.style.display = 'none';
            if (resultContent) resultContent.style.display = '';
        }

        function calculate() {
            const fromCur = from.options[from.selectedIndex].dataset.currency;
            const toCur = to.options[to.selectedIndex].dataset.currency;
            const amt = parseFloat(amount.value);
            errorEl.style.display = 'none';
            if (!fromCur || !toCur || isNaN(amt) || amt <= 0) {
                if (result) result.style.display = 'none';
                receiveInput.value = '';
                return;
            }
            showLoader();
            // Use ECB rates endpoint (server-side, cached)
            const ajaxUrl = (window.ajaxurl || '/wp-admin/admin-ajax.php') + `?action=mtc_get_ecb_rate&from=${encodeURIComponent(fromCur)}&to=${encodeURIComponent(toCur)}`;
            fetch(ajaxUrl)
                .then(res => res.json())
                .then(data => {
                    let rate = null;
                    if (data && data.success && data.data && typeof data.data.rate !== 'undefined') {
                        rate = data.data.rate;
                    }
                    if (rate === null) {
                        rateEl.textContent = 'Rate unavailable';
                        receiveInput.value = '';
                        feeEl.textContent = '-';
                    } else {
                        const fee = +(amt * 0.035).toFixed(2);
                        const receive = +((amt - fee) * rate).toFixed(2);
                        feeEl.textContent = fee + ' ' + fromCur;
                        rateEl.textContent = '1 ' + fromCur + ' = ' + rate + ' ' + toCur;
                        receiveInput.value = receive;
                    }
                    if (result) result.style.display = 'block';
                    hideLoader();
                })
                .catch(err => {
                    rateEl.textContent = 'API error';
                    receiveInput.value = '';
                    feeEl.textContent = '-';
                    if (result) result.style.display = 'block';
                    hideLoader();
                });
        }

        // Calculate on page load
        setTimeout(calculate, 0);

        // Calculate on dropdown or amount change
        from.addEventListener('change', calculate);
        to.addEventListener('change', calculate);
        amount.addEventListener('input', calculate);
    });
    </script>
    <style>
    .mtc-receive-row {
        z-index: 1;
    }
    .money-transfer-calculator .mtc-amount-row, .money-transfer-calculator .mtc-receive-row {
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        justify-content: stretch;
    }
    .mtc-amount-input-group {
        display: flex;
        align-items: center;
        gap: 0;
        width: 100%;
        position: relative;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 1px 4px 0 rgba(46,67,117,0.04);
        border: 1.5px solid #e0e7ef;
        padding: 0 0 0 0;
    }
    .mtc-amount-input-group input[type="number"],
    .mtc-amount-input-group input[readonly] {
        border: none;
        background: transparent;
        font-size: 1.18em;
        font-weight: 600;
        padding: 18px 12px 10px 18px;
        border-radius: 10px 0 0 10px;
        width: 100%;
        outline: none;
        color: #212529;
        min-width: 0;
        box-shadow: none;
    }
    .mtc-custom-select {
        display: flex;
        align-items: center;
        min-width: 90px;
        max-width: 120px;
        position: static;
        margin-left: 0;
        margin-right: 0;
        z-index: 2;
        cursor: pointer;
    }
    .mtc-custom-selected {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 1.08em;
        font-weight: 600;
        color: #212529;
        background: transparent;
        border: none;
        outline: none;
        padding: 0 8px 0 0;
        border-radius: 0 10px 10px 0;
        min-width: 90px;
        max-width: 120px;
        height: 40px;
        text-align: left;
    }
    .mtc-custom-dropdown {

    }
    .mtc-row .mtc-amount-input-group .mtc-custom-select .mtc-custom-selected .mtc-flag-img,
    .mtc-amount-input-group .mtc-custom-select .mtc-custom-dropdown .mtc-custom-option .mtc-flag-img {
        width: 24px;
        height: 18px;
        border-radius: 3px;
        object-fit: cover;
        margin-right: 4px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.04);
        border-radius: 0px;
    }
    .mtc-currency {
        font-size: 1em;
        font-weight: 600;
        color: #212529;
        margin-left: 2px;
    }
    .mtc-chevron {
        font-size: 1.1em;
        color: #adb5bd;
        margin-left: 4px;
    }
    .mtc-custom-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        width: 100%;
        min-width: unset;
        background: #fff;
        border: 1px solid #e0e7ef;
        border-radius: 8px;
        box-shadow: 0 4px 16px 0 rgba(46,67,117,0.10);
        z-index: 10;
        margin-top: 2px;
        max-height: 260px;
        overflow-y: auto;
    }
    .mtc-custom-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        padding: 8px 14px 8px 10px;
        cursor: pointer;
        font-size: 1em;
        color: #212529;
        transition: background 0.13s;
    }
    .mtc-custom-option:hover {
        background: #f3f6fa;
    }
    .mtc-country {
        font-size: 1em;
        color: #212529;
        margin-right: 4px;
        flex: 0 1 auto;
    }
    .mtc-currency {
        margin-left: auto;
        font-size: 1em;
        font-weight: 600;
        color: #212529;
        flex: 0 0 auto;
    }
    .mtc-amount-input-group:focus-within {
        border-color: #93E100;
        box-shadow: 0 0 0 2px #e6f8c7;
    }
    .mtc-floating-label {
        padding-inline: 10px;
        position: absolute;
        left: 1rem;
        top: -1rem;
        font-size: 0.98em;
        color: #495057;
        font-weight: 500;
        pointer-events: none;
        z-index: 2;
        background: #fff;
    }
    .mtc-amount-input-group input:focus + select,
    .mtc-amount-input-group select:focus {
        outline: none;
    }
    .mtc-amount-input-group input[readonly] {
        color: #212529;
        background: transparent;
        font-weight: 600;
    }
    /* ...existing modern calculator styles... */
    .money-transfer-calculator {
        background: #fff;
        padding: 30px 30px 10px 30px;
        border-radius: 20px;
        max-width: 100%;
        margin: 0 auto;
        box-shadow: 0px 0px 40px -15px rgba(46, 67, 117, 0.5);
    }
    .money-transfer-calculator .mtc-row {
        margin-bottom: 20px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        flex-direction: column;
        position: relative;
    }
    .money-transfer-calculator label {
        min-width: 60px;
        font-weight: 500;
    }
    .money-transfer-calculator select, .money-transfer-calculator input {
        flex: 1;
        padding: 6px 8px;
        border: none;
        max-width: 100%;
        box-sizing: border-box;
        min-width: 0;
    }
    .money-transfer-calculator select {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
    .money-transfer-calculator option {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        max-width: 350px;
    }
    .money-transfer-calculator .mtc-result {
        background: #fff;
        border-radius: 14px;
        padding: 18px 18px 14px 18px;
        position: relative;
        min-height: 80px;
        margin-top: 8px;
        margin-bottom: 0;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .mtc-loader {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 60px;
    }
    .mtc-loader:after {
        content: '';
        display: block;
        width: 32px;
        height: 32px;
        border: 4px solid #fff;
        border-top: 4px solid #333;
        border-radius: 50%;
        animation: mtc-spin 1s linear infinite;
    }
    @keyframes mtc-spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .mtc-result-row {
        display: flex;
        align-items: center;
        width: 100%;
        font-variant-numeric: tabular-nums;
        margin-bottom: 10px;
        font-size: 1rem;
        color: #212529;
        flex-wrap: wrap;
        row-gap: 2px;
        transition: all 0.2s;
    }
    .mtc-result-row > span {
        min-width: 0;
        word-break: break-word;
    }
    @media (max-width: 480px) {
        .mtc-result-row {
            flex-direction: column;
            align-items: flex-start;
            font-size: 0.97em;
            margin-bottom: 14px;
            gap: 0;
        }
        .mtc-result-row > span {
            font-size: 1em;
            min-width: 0;
            max-width: 100%;
            display: block;
            text-align: left;
        }
        .mtc-result-row .mtc-leader {
            display: none;
        }
        .mtc-result-row span:last-child {
            min-width: 0;
            max-width: 100%;
            text-align: left;
            margin-top: 2px;
            font-weight: 600;
        }
    }
    .mtc-label {
        flex: 0 0 auto;
        white-space: nowrap;
        font-weight: 500;
        color: #495057;
    }
    .mtc-leader {
        flex: 1 1 auto;
        border-bottom: 2px dotted #333;
        margin: 0 8px;
        height: 0.5em;
        min-width: 10px;
        max-width: 100%;
        position: relative;
        top: 0.1em;
        /* Dots effect */
        content: '';
    }
    .mtc-result-row span:last-child {
        flex: 0 0 auto;
        white-space: nowrap;
        text-align: right;
        min-width: 60px;
        font-weight: 600;
        color: #212529;
    }
    </style>
    <?php
    return ob_get_clean();
});