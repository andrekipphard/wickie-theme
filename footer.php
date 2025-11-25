<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wickie
 */
?>

<?php
    // Retrieve ACF fields
    $logo = get_field('footer_logo', 'options');
    $companyInformation = get_field('footer_company_information', 'options');
    $copyright_template = get_field('footer_copyright', 'options');
    $infoText = get_field('footer_info_text', 'options');
    $modalHeadline = get_field('modal_headline', 'options');
    $modalText = get_field('modal_text', 'options');
    $modalButtonText = get_field('modal_button_text', 'options');

    // Get the current year
    $current_year = date('Y');

    // Replace the {year} placeholder with the current year
    $copyright = str_replace('{year}', $current_year, $copyright_template);
    $backgroundImage = get_field('background_image', 'options');
    $backgroundImageSize = get_field('background_image_size', 'options');
    $backgroundImagePosition = get_field('background_image_position', 'options');
    $backgroundImageRepeat = get_field('background_image_repeat', 'options');
    $backgroundImageUrl = $backgroundImage ? wp_get_attachment_image_url($backgroundImage, 'large') : '';
?>

<footer id="colophon" class="site-footer" style="
    <?php if ($backgroundImageUrl): ?>
        background-image: url('<?= $backgroundImageUrl; ?>');
        background-size: <?= $backgroundImageSize ? $backgroundImageSize : 'cover'; ?>;
        background-repeat: <?= $backgroundImageRepeat ? $backgroundImageRepeat : 'no-repeat'; ?>;
        background-position: <?= $backgroundImagePosition ? $backgroundImagePosition : 'center center'; ?>;
    <?php endif; ?>">
    <div class="container">
        <div class="footer">
            <div class="company-info">
                <?php if ($logo): ?>
                    <img loading="lazy" decoding="async" src="<?= esc_url(wp_get_attachment_image_url($logo, 'large')); ?>" alt="Company Logo">
                <?php endif; ?>

                <?php if ($companyInformation): ?>
                    <span><?= esc_html($companyInformation); ?></span>
                <?php endif; ?>

                <?php if (have_rows('footer_social_icon', 'options')): ?>
                    <div class="social-icons">
                        <?php while (have_rows('footer_social_icon', 'options')): the_row(); 
                            $socialIconUrl = get_sub_field('footer_social_icon_url');
                            $socialIcon = get_sub_field('footer_social_icon');
                        ?>
                            <?php if ($socialIconUrl && $socialIcon): ?>
                                <a href="<?= esc_url($socialIconUrl); ?>" target="_blank" aria-label="Go to <?= $socialIcon; ?>">
                                    <i class="bi bi-<?= esc_attr($socialIcon); ?>"></i>
                                </a>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <?php if (have_rows('footer_app_link', 'options')): ?>
                    <div class="app-links">
                        <?php while (have_rows('footer_app_link', 'options')): the_row(); 
                            $appLinkUrl = get_sub_field('footer_app_link_url');
                            $appLinkImage = get_sub_field('footer_app_link_image');
                        ?>
                            <?php if ($appLinkUrl && $appLinkImage): ?>
                                <a href="<?= esc_url($appLinkUrl); ?>">
                                    <img loading="lazy" decoding="async" src="<?= esc_url(wp_get_attachment_image_url($appLinkImage, 'large')); ?>" alt="App Link">
                                </a>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="navigation-links">
                <?php if (have_rows('footer_menu', 'options')): ?>
                    <div class="navigation-links-menu">
                        <ul class="navigation-group navigation-links-menu-ul">
                            <?php while (have_rows('footer_menu', 'options')): the_row(); 
                                $footerMenuName = get_sub_field('footer_menu_name');
                                $footerMenuUrl = get_sub_field('footer_menu_url');
                            ?>
                                <li class="navigation-item navigation-links-menu-ul-li">
                                    <?php if ($footerMenuName && $footerMenuUrl): ?>
                                        <a href="<?= esc_url($footerMenuUrl); ?>">
                                            <span><?= esc_html($footerMenuName); ?></span>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (have_rows('footer_menu_item')): ?>
                                        <ul class="navigation-group">
                                            <?php while (have_rows('footer_menu_item')): the_row(); 
                                                $footerMenuItemName = get_sub_field('footer_menu_item_name');
                                                $footerMenuItemUrl = get_sub_field('footer_menu_item_url');
                                                $footerMenuItemComingSoon = get_sub_field('footer_menu_item_coming_soon');
                                                $footerMenuItemNewTab = get_sub_field('footer_menu_item_new_tab');
                                                $footerMenuItemInfoWickieGame = get_sub_field('footer_menu_item_info_wickie_game');
                                                $info_wickie_game_text = get_field('info_wickie_game_text', 'options');
                                            ?>
                                                <?php if ($footerMenuItemName && $footerMenuItemUrl): ?>
                                                    <?php if ($footerMenuItemComingSoon === 'Nein'): ?><li class="navigation-item" style="display: flex; align-items: center; gap: 6px;">
                                                        <a href="<?= esc_url($footerMenuItemUrl); ?>"<?php if ($footerMenuItemNewTab === 'Ja'): ?> target="_blank"<?php endif;?>>
                                                            <span><?= esc_html($footerMenuItemName); ?></span>
                                                            <?php if ($footerMenuItemComingSoon === 'Ja'): ?>
                                                                <span class="coming-soon">
                                                                    <span class="badge">
                                                                        <i class="bi bi-flag"></i>COMING SOON
                                                                    </span>
                                                                </span>
                                                            <?php endif; ?>
                                                        </a>
                                                        <?php if ($footerMenuItemInfoWickieGame === 'Ja' && $info_wickie_game_text): ?>
                                                            <span class="footer-info-tooltip" tabindex="0" style="display:inline-flex;align-items:center;cursor:pointer;position:relative;">
                                                                <span style="margin-bottom:0px;background:#93E100;border-radius:50%;width:22px;height:22px;display:flex;align-items:center;justify-content:center;margin-left:2px;">
                                                                    <i class="bi bi-info-lg" style="color:#1D1D1D;font-size:14px;"></i>
                                                                </span>
                                                                <span class="footer-info-tooltip-text" style="visibility:hidden;opacity:0;transition:opacity 0.2s;position:absolute;left:50%;bottom:120%;transform:translateX(-50%);background:#1D1D1D;color:#fff;padding:7px 12px;border-radius:8px;white-space:nowrap;z-index:10;font-size:13px;pointer-events:none;">Every 100th customer gets the Wickie game for free!</span>
                                                            </span>
                                                            <script>
                                                                document.addEventListener('DOMContentLoaded', function() {
                                                                    document.querySelectorAll('.footer-info-tooltip').forEach(function(tooltip) {
                                                                        var text = tooltip.querySelector('.footer-info-tooltip-text');
                                                                        if(text) {
                                                                            tooltip.addEventListener('mouseenter', function() {
                                                                                text.style.visibility = 'visible';
                                                                                text.style.opacity = '1';
                                                                            });
                                                                            tooltip.addEventListener('mouseleave', function() {
                                                                                text.style.visibility = 'hidden';
                                                                                text.style.opacity = '0';
                                                                            });
                                                                            tooltip.addEventListener('focus', function() {
                                                                                text.style.visibility = 'visible';
                                                                                text.style.opacity = '1';
                                                                            });
                                                                            tooltip.addEventListener('blur', function() {
                                                                                text.style.visibility = 'hidden';
                                                                                text.style.opacity = '0';
                                                                            });
                                                                        }
                                                                    });
                                                                });
                                                            </script>
                                                        <?php endif; ?>
                                                    </li><?php endif;?>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>	
        </div>
        <span class="info-text"><?= esc_html($infoText); ?></span>

        <?php if (isset($copyright) && !empty($copyright)): ?>
            <div class="copyright">
                <?= esc_html($copyright); ?>
            </div>
        <?php endif; ?>
    </div>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
<div class="overlay"></div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel"><?= esc_html($modalHeadline); ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?= esc_html($modalText); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-bs-dismiss="modal"><?= esc_html($modalButtonText); ?></button>
      </div>
    </div>
  </div>
</div>

<script>
window.addEventListener('load', function () {
    if (!localStorage.getItem('modalShown')) {
        var exampleModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
            backdrop: 'static',
            keyboard: false
        });
        exampleModal.show();
        localStorage.setItem('modalShown', 'true');
    }
});
</script>

<script>
(function() {
    // Configuration
    const REFERRAL_PARAM = 'ref'; // Parameter name in your URL
    const STORAGE_KEY = 'wickie_referral_code';
    const STORAGE_DAYS = 30; // How long to store the referral code
    const EXTERNAL_DOMAIN = 'client.wickie.io';
    const EXTERNAL_PARAM = 'referral_code';
    
    // Function to get URL parameters
    function getUrlParameter(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }
    
    // Function to set cookie
    function setCookie(name, value, days) {
        const expires = new Date();
        expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = name + '=' + value + ';expires=' + expires.toUTCString() + ';path=/';
    }
    
    // Function to get cookie
    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
    
    // Store referral code if present in URL
    const refCode = getUrlParameter(REFERRAL_PARAM);
    if (refCode) {
        setCookie(STORAGE_KEY, refCode, STORAGE_DAYS);
        
        // Optional: Also store in localStorage as backup
        if (typeof(Storage) !== "undefined") {
            localStorage.setItem(STORAGE_KEY, refCode);
        }
    }
    
    // Get stored referral code
    function getStoredReferralCode() {
        let code = getCookie(STORAGE_KEY);
        if (!code && typeof(Storage) !== "undefined") {
            code = localStorage.getItem(STORAGE_KEY);
        }
        return code;
    }
    
    // Update external links with referral code
    function updateExternalLinks() {
        const referralCode = getStoredReferralCode();
        if (!referralCode) return;
        
        // Find all links to the external domain
        const links = document.querySelectorAll('a[href*="' + EXTERNAL_DOMAIN + '"]');
        
        links.forEach(function(link) {
            const url = new URL(link.href);
            // Only add if not already present
            if (!url.searchParams.has(EXTERNAL_PARAM)) {
                url.searchParams.set(EXTERNAL_PARAM, referralCode);
                link.href = url.toString();
            }
        });
    }
    
    // Run when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', updateExternalLinks);
    } else {
        updateExternalLinks();
    }
    
    // Also update links that might be added dynamically
    // Re-run every second for dynamically added content
    setInterval(updateExternalLinks, 1000);
})();
</script>

<?php if (is_page(5520)) : ?>
    <script>
    window.addEventListener('load', function () {
        if (window.Intercom) {
            window.Intercom('update', {
                card_preregistered: true
            });
        }
    });
    </script>
<?php endif; ?>

</body>
</html>
