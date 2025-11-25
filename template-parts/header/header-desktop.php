<?php
    $headerLogo = get_field('header_logo', 'options');
    $headerLogoTransparentBackground = get_field('header_logo_transparent_background', 'options');
?>

<div class="header-desktop">
    <div class="left">
        <div class="logo">
            <?php if (is_front_page()): ?>
                <a href="/">
                    <?php if($headerLogoTransparentBackground):?><img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($headerLogoTransparentBackground, 'large'); ?>" alt="<?= esc_attr(get_post_meta($headerLogoTransparentBackground, '_wp_attachment_image_alt', true)); ?>"><?php endif;?>
                </a>
            <?php else: ?>
                <a href="/">
                <?php if($headerLogo):?><img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($headerLogo, 'large'); ?>" alt="<?= esc_attr(get_post_meta($headerLogo, '_wp_attachment_image_alt', true)); ?>"><?php endif;?>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="middle">
        <div class="navigation">
            <?php if (have_rows('menu_item', 'options')): ?>
                <ul class="nav">
                    <?php
                    $menuItemIndex = 0; // Initialize the index variable
                    while (have_rows('menu_item', 'options')): the_row();
                        $menuItemName = get_sub_field('menu_item_name');
                        $menuItemUrl = get_sub_field('menu_item_url');
                        $menuItemIcon = get_sub_field('menu_item_icon');
                        $megaMenu = get_sub_field('mega_menu');
                    ?>
                        <li class="nav-item <?php if (have_rows('sub_menu_item')): ?>dropdown<?php endif; ?><?php if ($megaMenu == 'Yes' && have_rows('sub_menu_item')): ?> mega-menu-dropdown<?php endif; ?>">
                            <div class="nav-link<?php if (have_rows('sub_menu_item')): ?><?php endif; ?>"<?php if (have_rows('sub_menu_item')): ?> id="menuItem<?= $menuItemIndex; ?>Dropdown" role="button" aria-label="Open Main Navigation"<?php endif; ?>>
                                <i class="bi bi-<?= $menuItemIcon; ?>"></i><?= $menuItemName; ?>
                            </div>
                            <?php if (have_rows('sub_menu_item')): ?>
                                <div class="dropdown-menu" aria-labelledby="menuItem<?= $menuItemIndex; ?>Dropdown">
                                    <div class="row<?php if ($megaMenu == 'Yes'): ?> mega-menu<?php endif; ?><?php if ($megaMenu == 'No'): ?> normal-menu<?php endif; ?>">
                                        <div class="col d-flex justify-content-center">
                                            <?php if ($megaMenu == 'Yes' && have_rows('sub_menu_item')): ?>
                                                <div class="row container">
                                                    <?php while (have_rows('sub_menu_item')): the_row();
                                                        $subMenuItemName = get_sub_field('sub_menu_item_name');
                                                        $subMenuItemUrl = get_sub_field('sub_menu_item_url');
                                                        $subMenuItemIcon = get_sub_field('sub_menu_item_icon');
                                                    ?>
                                                        <div class="col-lg-3 mega-menu-col">
                                                            <a href="<?= $subMenuItemUrl; ?>">
                                                                <h6><?php if ($subMenuItemIcon): ?><i class="bi bi-<?= $subMenuItemIcon; ?>"></i><?php endif; ?><?= $subMenuItemName; ?></h6>
                                                            </a>
                                                            <?php if (have_rows('sub_sub_menu_item')): ?>
                                                                <ul>
                                                                <?php while (have_rows('sub_sub_menu_item')): the_row(); // Correct loop and function
                                                                    $subSubMenuItemName = get_sub_field('sub_sub_menu_item_name');
                                                                    $subSubMenuItemUrl = get_sub_field('sub_sub_menu_item_url');
                                                                    $subSubMenuItemComingSoon = get_sub_field('sub_sub_menu_item_coming_soon');
                                                                    $subSubMenuItemNewTab = get_sub_field('sub_sub_menu_item_new_tab');
                                                                    $subSubMenuItemInfoWickieGame = get_sub_field('sub_sub_menu_item_info_wickie_game');
                                                                    $info_wickie_game_text = get_field('info_wickie_game_text', 'options');
                                                                ?>
                                                                    <?php if ($subSubMenuItemComingSoon === 'Nein'): ?><li><a class="dropdown-item" href="<?= $subSubMenuItemUrl; ?>" <?php if ($subSubMenuItemNewTab === 'Ja'): ?> target="_blank"<?php endif;?>><?= $subSubMenuItemName; ?><?php if ($subSubMenuItemComingSoon === 'Ja'): ?>
                                                                        <span class="coming-soon">
                                                                            <span class="badge">
                                                                                <i class="bi bi-flag"></i>COMING SOON
                                                                            </span>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                    <?php if ($subSubMenuItemInfoWickieGame === 'Ja' && $info_wickie_game_text): ?>
                                                                        <span class="footer-info-tooltip" tabindex="0" style="display:inline-flex;align-items:center;cursor:pointer;position:relative;">
                                                                            <span style="margin-bottom:0px;background:#93E100;border-radius:50%;width:22px;height:22px;display:flex;align-items:center;justify-content:center;margin-left:2px;">
                                                                                <i class="bi bi-info-lg" style="color:#1D1D1D;font-size:14px;margin-right:0;"></i>
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
                                                                </a></li><?php endif;?>
                                                                <?php endwhile; ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endwhile; ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($megaMenu == 'No' && have_rows('sub_menu_item')): ?>
                                                <ul>
                                                    <?php while (have_rows('sub_menu_item')): the_row();
                                                        $subMenuItemName = get_sub_field('sub_menu_item_name');
                                                        $subMenuItemUrl = get_sub_field('sub_menu_item_url');
                                                    ?>
                                                        <li><a class="dropdown-item" href="<?= $subMenuItemUrl; ?>"><?= $subMenuItemName; ?></a></li>
                                                    <?php endwhile; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php
                    $menuItemIndex++;
                    endwhile;
                    ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="right">
        <button type="button" class="btn btn-link weglot-button-indicator">
            <div id="weglot_here"></div>
        </button>

        <?php if (have_rows('header_cta', 'options')): ?>
            <?php while (have_rows('header_cta', 'options')): the_row();
                $headerButtonUrl = get_sub_field('header_button_url');
                $headerButtonIcon = get_sub_field('header_button_icon');
                $headerButtonText = get_sub_field('header_button_text');
            ?>
                <a href="<?= $headerButtonUrl; ?>" class="btn btn-link weglot-button">
                    <i class="bi bi-<?= $headerButtonIcon; ?>"></i>
                    <?= $headerButtonText; ?>
                </a>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var header = document.querySelector('.header-desktop');
    var logo = document.querySelector('.header-desktop .logo img');
    var overlay = document.querySelector('.overlay');
    var navItems = document.querySelectorAll('.nav-item.dropdown');
    var body = document.body; // Access the body element to check the page type
    var buttons = document.querySelectorAll('.header-desktop .right .btn');

    // Logo sources
    var lightLogoSrc = "<?= wp_get_attachment_image_url($headerLogoTransparentBackground, 'large'); ?>";
    var darkLogoSrc = "<?= wp_get_attachment_image_url($headerLogo, 'large'); ?>";

    var scrollOffset = 100; // Adjust when the header becomes sticky

    function updateHeaderState() {
        var isSticky = window.scrollY > scrollOffset;
        var isFrontPage = body.classList.contains('home'); // WordPress adds 'home' class for the front page
        var isPage2189 = body.classList.contains('page-id-2189');

        // Determine logo source based on page type and sticky state
        if (isSticky) {
            header.classList.add('sticky');
            header.style.backgroundColor = '#FFFFFF';
            logo.src = darkLogoSrc; // Dark logo for sticky header
        } else {
            header.classList.remove('sticky');
            header.style.backgroundColor = 'transparent';
            logo.src = (isFrontPage || isPage2189) ? lightLogoSrc : darkLogoSrc; // Light logo for front page, dark for others
        }
    }

    // Scroll event listener to handle sticky header
    window.addEventListener('scroll', updateHeaderState);

    // Navbar dropdown hover events
    navItems.forEach(function(navItem) {
        navItem.addEventListener('mouseenter', function() {
            header.style.backgroundColor = '#002A3F'; // Change header to blue
            logo.src = lightLogoSrc; // Use light logo when hovering
            overlay.style.opacity = '1'; // Show overlay
            overlay.style.visibility = 'visible'; // Ensure it's visible

            // Add class to change button text and icon color to white
            buttons.forEach(function(button) {
                button.classList.add('white-text');
            });
        });

        navItem.addEventListener('mouseleave', function() {
            overlay.style.opacity = '0'; // Hide overlay
            overlay.style.visibility = 'hidden'; // Ensure it's hidden

            // Restore header state based on scroll position
            updateHeaderState();

            // Remove class to restore button text and icon color
            buttons.forEach(function(button) {
                button.classList.remove('white-text');
            });
        });
    });

    // Initialize header state on page load
    updateHeaderState();
});
</script>