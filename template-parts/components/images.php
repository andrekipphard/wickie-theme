<?php
    $backgroundColor = get_sub_field('background_color');
    $fullHeight = get_sub_field('full_height');
?>
<?php if(have_rows('image')):?>
<div class="row me-0<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>"  style="<?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>">
    <div class="col">
        <div class="swiper mySwiper py-4 py-lg-5">
            <div class="swiper-wrapper">
                <?php while(have_rows('image')): the_row();
                    $image = get_sub_field('image');?>
                    <div class="swiper-slide shadow rounded py-5 px-4 p-lg-5"><img src="<?= wp_get_attachment_image_url($image, 'full');?>" alt="<?= esc_attr(get_post_meta($image, '_wp_attachment_image_alt', true)); ?>" class="img-fluid"></div>
                <?php endwhile;?>
            </div>
        </div>
    </div>
</div>
<?php endif;?>

<script>
jQuery(document).ready(function() {
    // Initialize Swiper
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 6,
        spaceBetween: 60,
        loop: true,
        speed: 5000,
        autoplay: {
            delay: 0,
            disableOnInteraction: false,
            reverseDirection: true,
        },
        allowTouchMove: false, // Prevent touch interactions
        simulateTouch: false,  // Prevent simulation of touch interactions
        grabCursor: false,     // Disable cursor change on hover
    });

    // Toggle between different configurations for desktop and mobile
    function toggleSwiper() {
        if (window.innerWidth <= 767) {
            swiper.params.slidesPerView = 2; // Anzahl der Slides für Handys
            swiper.params.spaceBetween = 20;  // Abstand für Handys
        } else if (window.innerWidth <= 1400) {
            swiper.params.slidesPerView = 4; // Anzahl der Slides für Tablets
            swiper.params.spaceBetween = 40;  // Abstand für Tablets
        } else {
            swiper.params.slidesPerView = 6; // Anzahl der Slides für Desktops
            swiper.params.spaceBetween = 60;  // Abstand für Desktops
        }
        swiper.update(); // Update swiper with new params
    }

    // Initial toggle on page load
    toggleSwiper();

    // Re-toggle whenever the window is resized
    window.addEventListener('resize', toggleSwiper);
});
</script>