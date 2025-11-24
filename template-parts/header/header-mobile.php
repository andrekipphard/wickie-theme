<?php
    $headerLogoMobile = get_field('header_logo', 'options');
    $headerLogoTransparentBackground = get_field('header_logo_transparent_background', 'options');
    $mobileModalImage = get_field('mobile_modal_image', 'options');
    $mobileModalAppName = get_field('mobile_modal_app_name', 'options');
    $mobileModalAppRating = get_field('mobile_modal_app_rating', 'options');
    $mobileModalButtonText = get_field('mobile_modal_button_text', 'options');
    $mobileModalButtonUrlAndroid = get_field('mobile_modal_button_url_android', 'options');
    $mobileModalButtonUrlApple = get_field('mobile_modal_button_url_apple', 'options');

    // Funktion zum Generieren der Sterne basierend auf dem Rating
    function generate_stars($rating) {
        $output = '';
        $fullStars = floor($rating); // Ganze Sterne
        $halfStar = $rating - $fullStars >= 0.5 ? true : false; // Halber Stern wenn notwendig
        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // Leere Sterne

        // Ganze Sterne hinzufügen
        for ($i = 0; $i < $fullStars; $i++) {
            $output .= '<span class="star filled">&#9733;</span>';
        }

        // Halben Stern hinzufügen wenn notwendig
        if ($halfStar) {
            $output .= '<span class="star half">&#9733;</span>';
        }

        return $output;
    }

    // Funktion zum Überprüfen des Betriebssystems
    function get_device_os() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/android/i', $user_agent)) {
            return 'android';
        } elseif (preg_match('/iphone|ipad|ipod/i', $user_agent)) {
            return 'ios';
        } else {
            return 'other';
        }
    }

    // Je nach Gerät den richtigen URL festlegen
    $device_os = get_device_os();
    $app_url = ($device_os === 'android') ? $mobileModalButtonUrlAndroid : $mobileModalButtonUrlApple;

?>
<!-- Banner Modal -->
<div id="getApp" class="app-banner-modal">
    <div class="app-modal-content">
        <div class="app-infos">
            <button type="button" class="btn-close app-modal-close" aria-label="Close">X</button>
            <img class="app-modal-logo" src="<?= wp_get_attachment_image_url($mobileModalImage, 'medium'); ?>" alt="<?= esc_attr(get_post_meta($mobileModalImage, '_wp_attachment_image_alt', true)); ?>" />
            <div class="review-section">
                <h2 class="app-name"><?= $mobileModalAppName; ?></h2>
                <div class="reviews">
                    <div class="stars">
                        <?= generate_stars($mobileModalAppRating); ?>
                    </div>
                    <span class="rating-number"><?= $mobileModalAppRating; ?></span>
                </div>
            </div>
        </div>
        <a href="<?= $app_url; ?>" class="btn btn-white download-btn"><?= $mobileModalButtonText; ?></a>
    </div>
</div>
<div class="header-mobile">
    <div class="mobile-header">
        <div class="mobile-logo">
            <a href="/">
                <img src="<?php if (is_front_page()): ?><?= wp_get_attachment_image_url($headerLogoTransparentBackground, 'medium'); ?><?php else:?><?= wp_get_attachment_image_url($headerLogoMobile, 'medium'); ?><?php endif;?>" alt="Logo" />
            </a>
        </div>
        <div class="mobile-burger-menu">
            <button type="button" class="burger-icon" id="mobileMenuToggle" aria-label="Open main navigation">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </div>

    <div class="mobile-nav-menu" id="mobileNavMenu">
        <div class="mobile-nav-menu-header">
            <div class="nav-logo">
                <a href="/">
                    <img src="<?= wp_get_attachment_image_url($headerLogoTransparentBackground, 'medium'); ?>" alt="Transparent Logo" />
                </a>
            </div>
            <button type="button" class="close-menu" id="mobileMenuClose" aria-label="Close main navigation">
                <i class="bi bi-x"></i>
            </button>
        </div>
        <div class="mobile-nav-menu-body">
        <ul class="mobile-menu-items">
            <?php if (have_rows('menu_item', 'options')): ?>
                <?php while (have_rows('menu_item', 'options')): the_row(); ?>
                    <?php if (have_rows('sub_menu_item')): ?>
                        <?php while (have_rows('sub_menu_item')): the_row();
                            $subMenuItemName = get_sub_field('sub_menu_item_name');
                            $subMenuItemUrl = get_sub_field('sub_menu_item_url');
                            $subMenuItemIcon = get_sub_field('sub_menu_item_icon');
                        ?>
                            <li class="mobile-menu-item">
                                <a href="<?= $subMenuItemUrl; ?>" class="menu-toggle">
                                    <?php if ($subMenuItemIcon): ?>
                                        <i class="bi bi-<?= $subMenuItemIcon; ?>"></i>
                                    <?php endif; ?>
                                    <?= $subMenuItemName; ?>
                                </a>

                                <?php if (have_rows('sub_sub_menu_item')): ?>
                                    <span class="chevron-toggle">
                                        <i class="bi bi-chevron-down"></i>
                                    </span>
                                    <ul class="mobile-sub-menu" style="display: none;">
                                        <?php while (have_rows('sub_sub_menu_item')): the_row();
                                            $subSubMenuItemName = get_sub_field('sub_sub_menu_item_name');
                                            $subSubMenuItemUrl = get_sub_field('sub_sub_menu_item_url');
                                            $subSubMenuItemComingSoon = get_sub_field('sub_sub_menu_item_coming_soon');
                                            $subSubMenuItemNewTab = get_sub_field('sub_sub_menu_item_new_tab');
                                        ?>
                                            <?php if ($subSubMenuItemComingSoon === 'Nein'): ?><li>
                                                <a href="<?= $subSubMenuItemUrl; ?>" <?php if ($subSubMenuItemNewTab === 'Ja'): ?> target="_blank"<?php endif; ?>>
                                                    <?= $subSubMenuItemName; ?>
                                                    
                                                    <?php if ($subSubMenuItemComingSoon === 'Ja'): ?>
                                                        <span class="coming-soon">
                                                            <span class="badge">
                                                                <i class="bi bi-flag"></i>COMING SOON
                                                            </span>
                                                        </span>
                                                    <?php endif; ?>
                                                </a>
                                            </li><?php endif;?>
                                        <?php endwhile; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </ul>
        <ul class="mobile-menu-items cta">
            <?php if (have_rows('header_cta', 'options')): ?>
                <?php while (have_rows('header_cta', 'options')): the_row();
                    $headerButtonUrl = get_sub_field('header_button_url');
                    $headerButtonIcon = get_sub_field('header_button_icon');
                    $headerButtonText = get_sub_field('header_button_text');
                ?>
                    <li class="mobile-menu-item">
                        <a href="<?= $headerButtonUrl; ?>" class="btn btn-white">
                            <i class="bi bi-<?= $headerButtonIcon; ?>"></i>
                            <?= $headerButtonText; ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            <?php endif; ?>
            <li class="mobile-menu-item weglot">
                <button type="button" class="btn btn-link">
                    <div id="weglot_here"></div>
                </button>
            </li>
        </ul>
        </div>

    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var menuToggle = document.getElementById('mobileMenuToggle');
    var mobileNavMenu = document.getElementById('mobileNavMenu');
    var mobileMenuClose = document.getElementById('mobileMenuClose');
    var mobileMenuOverlay = document.createElement('div');
    mobileMenuOverlay.className = 'mobile-menu-overlay';
    document.body.appendChild(mobileMenuOverlay);

    // Menü öffnen
    menuToggle.addEventListener('click', function() {
        mobileNavMenu.classList.add('show');
        mobileMenuOverlay.classList.add('show');
    });

    // Menü schließen bei Klick auf Schließen-Button
    mobileMenuClose.addEventListener('click', function() {
        mobileNavMenu.classList.remove('show');
        mobileMenuOverlay.classList.remove('show');
    });

    // Menü schließen bei Klick auf das Overlay
    mobileMenuOverlay.addEventListener('click', function() {
        mobileNavMenu.classList.remove('show');
        mobileMenuOverlay.classList.remove('show');
    });

    // Sub-Sub-Menü öffnen/schließen beim Klick auf den Chevron
    document.querySelectorAll('.chevron-toggle').forEach(function(chevron) {
        chevron.addEventListener('click', function(event) {
            event.stopPropagation(); // Verhindert, dass das Menü geschlossen wird
            var menuItem = this.previousElementSibling;
            var subMenu = this.nextElementSibling; // Das Sub-Sub-Menü
            if (subMenu && subMenu.classList.contains('mobile-sub-menu')) {
                // Toggle display
                var isOpen = subMenu.style.display === 'block';
                subMenu.style.display = isOpen ? 'none' : 'block';

                // Chevron dreht sich nach oben/unten
                this.querySelector('i').classList.toggle('bi-chevron-down', isOpen);
                this.querySelector('i').classList.toggle('bi-chevron-up', !isOpen);
                
                // Hover-Klasse hinzufügen/entfernen
                if (!isOpen) {
                    menuItem.classList.add('hover'); // Füge die Hover-Klasse hinzu
                } else {
                    menuItem.classList.remove('hover'); // Entferne die Hover-Klasse
                }
            }
        });
    });

    // Klick auf Sub-Menü-Item (1. Klick öffnet Sub-Sub-Menü, 2. Klick leitet weiter)
    document.querySelectorAll('.menu-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function(event) {
            var chevronButton = this.nextElementSibling
            var subMenu = chevronButton.nextElementSibling; // Das Sub-Sub-Menü

            if (subMenu && subMenu.classList.contains('mobile-sub-menu')) {
                event.preventDefault(); // Verhindert die sofortige Weiterleitung

                if (subMenu.style.display !== 'block') {
                    // Öffnet das Sub-Sub-Menü beim ersten Klick
                    subMenu.style.display = 'block';
                    chevronButton.querySelector('i').classList.remove('bi-chevron-down');
                    chevronButton.querySelector('i').classList.add('bi-chevron-up');
                    subMenu.classList.add('hover'); // Füge die Hover-Klasse hinzu
                } else {
                    // Leitet beim zweiten Klick weiter
                    window.location.href = this.getAttribute('href');
                }
            } else {
                // Wenn kein Sub-Sub-Menü vorhanden ist, weiterleiten
                window.location.href = this.getAttribute('href');
            }
        });
    });

    document.querySelector('.mobile-nav-menu').addEventListener('click', function(event) {
        event.stopPropagation(); // Verhindert, dass das Klick-Event zum Overlay durchdringt
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const weglotDiv = document.querySelector('.country-selector'); // Wähle das Weglot-Div

    function updateWeglotDisplay() {
        if (weglotDiv) {
            
            if (window.innerWidth < 769) {
                // Mobile Ansicht: Inline-Flaggen
                weglotDiv.classList.remove('weglot-dropdown');
                weglotDiv.classList.add('weglot-inline');
                weglotDiv.setAttribute('aria-expanded', 'false'); // Setze aria-expanded auf false
            } else {
                // Desktop Ansicht: Dropdown
                weglotDiv.classList.remove('weglot-inline');
                weglotDiv.classList.add('weglot-dropdown');
                weglotDiv.setAttribute('aria-expanded', 'true'); // Setze aria-expanded auf true
            }
        }
    }

    // Aktualisiere die Anzeige bei Seitenaufruf
    updateWeglotDisplay();

    // Aktualisiere die Anzeige beim Resize
    window.addEventListener('resize', updateWeglotDisplay);

    // Aktualisiere die Anzeige nach dem Weglot-Plugin-Initialisierung
    setTimeout(updateWeglotDisplay, 1000); // Warte einen Moment, um sicherzustellen, dass Weglot geladen ist
});

document.addEventListener('DOMContentLoaded', function () {
    var closeButton = document.querySelector('.app-modal-close');
    var bannerModal = document.getElementById('getApp');
    var pageContainer = document.getElementById('page'); // Select the #page element

    // Function to check if the banner has already been closed in this session
    function isBannerClosed() {
        return sessionStorage.getItem('bannerClosed') === 'true';
    }

    // Function to check if the device is a tablet or mobile (width less than 1024px)
    function isMobileOrTablet() {
        return window.innerWidth < 1024;
    }

    // Only show the banner if it hasn't been closed and the screen width is < 1024px
    if (!isBannerClosed() && isMobileOrTablet()) {
        bannerModal.style.display = 'block'; // Show the modal

        // Scroll the page to the top upon loading
        window.scrollTo({
            top: 0,
            behavior: 'auto' // Instantly scroll to the top without animation
        });

        // Add padding to the #page element to prevent header overlap
        if (pageContainer) {
            pageContainer.style.paddingTop = bannerModal.offsetHeight + 'px';
        }
    } else {
        bannerModal.style.display = 'none'; // Hide the modal
    }

    // Close the modal when clicking on the close button
    closeButton.addEventListener('click', function() {
        bannerModal.style.display = 'none';
        
        // Remove the extra padding from the #page element
        if (pageContainer) {
            pageContainer.style.paddingTop = '0';
        }
        
        sessionStorage.setItem('bannerClosed', 'true'); // Set the status indicating the banner was closed
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var headerMobile = document.querySelector('.header-mobile');
    var lightLogoSrc = "<?= wp_get_attachment_image_url($headerLogoTransparentBackground, 'large'); ?>";
    var darkLogoSrc = "<?= wp_get_attachment_image_url($headerLogoMobile, 'large'); ?>";
    var logo = document.querySelector('.header-mobile .mobile-logo img');
    var body = document.body; // Access the body element to check the page type
    var isFrontPage = body.classList.contains('home'); // WordPress adds 'home' class for the front page
    var isPage2189 = body.classList.contains('page-id-2189');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            headerMobile.classList.add('sticky');
            logo.src = darkLogoSrc;
        } else {
            headerMobile.classList.remove('sticky');
            logo.src = (isFrontPage || isPage2189) ? lightLogoSrc : darkLogoSrc; // Light logo for front page, dark for others
        }
    });
});



</script>