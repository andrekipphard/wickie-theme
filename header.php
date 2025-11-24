<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wickie
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <script src="https://web.cmp.usercentrics.eu/modules/autoblocker.js"></script>
    <script id="usercentrics-cmp" src="https://web.cmp.usercentrics.eu/ui/loader.js" data-settings-id="2tP1VOmydvVOPT" async></script>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-TN4NJKG5');</script>
	<!-- End Google Tag Manager -->
	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="google-site-verification" content="jLMA3zv8POOyE_E7eQr5B6NWrOM932RIPzwD06jpdZE" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Proxima+Nova:wght@300;400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Proxima+Nova:wght@300;400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
	<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
	<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.js"></script>

	<?php if (is_page(5390)) : ?>
		<meta property="og:title" content="New brand ambassador for wickie.io Formula E star Maximilian Günther">
		<meta property="og:description" content="wickie.io, the smart crypto investment platform based in Vilnius, proudly announces its partnership with top German Formula E driver Maximilian Günther.">
		<meta property="og:image" content="https://wickie.io/wp-content/uploads/2025/06/ceabc6e7-5e74-4ac8-999a-5ab5acf80fce-scaled.jpg">
		<meta property="og:url" content="https://wickie.io/news-press/formula-e-star-maximilian-gunther-becomes-brand-ambassador-for-wickie-io/">
		<meta property="og:type" content="website">
		<meta property="og:site_name" content="Wickie">

	<?php elseif (is_page(5529)) : ?>
		<meta property="og:title" content="Driven by Purpose and Performance – Maximilian Günther and Wickie.io">
		<meta property="og:description" content="Formula E driver Maximilian Günther on racing, resilience, and the future of digital investing with Wickie.io.">
		<meta property="og:image" content="https://wickie.io/wp-content/uploads/2025/08/Max-Blogpost-1.jpeg">
		<meta property="og:url" content="https://wickie.io/news-press/full-throttle-for-the-future-formula-e-driver-maximilian-gunther-on-racing-mental-strength-and-his-role-as-wickie-io-ambassador/">
		<meta property="og:type" content="article">
		<meta property="og:site_name" content="Wickie">
	<?php elseif (is_page(5569)) : ?>
		<meta property="og:title" content="Join the Wickie Reel Challenge 2025. Win up to 2.500€ in Bitcoin!">
		<meta property="og:description" content="Tell your story, show your creativity, and compete for the best prizes in BTC and much more.">
		<meta property="og:image" content="https://wickie.io/wp-content/uploads/2025/09/vitaly-gariev-XO_JvlNPtto-unsplash-scaled.jpg">
		<meta property="og:url" content="https://wickie.io/news-press/maximilian-gunther-the-future-of-racing-and-digital-investment/">
		<meta property="og:type" content="website">
		<meta property="og:site_name" content="Wickie">
	<?php else : ?>
		<meta property="og:title" content="Wickie – Crypto trading made safe and easy - for beginners and advanced users!">
		<meta property="og:description" content="Easy deposits and withdrawals with seamless transitions between digital and traditional assets.">
		<meta property="og:image" content="https://wickie.io/wp-content/uploads/2025/06/wickie-website.webp">
		<meta property="og:url" content="https://wickie.io/reel-challenge/">
		<meta property="og:type" content="website">
		<meta property="og:site_name" content="Wickie">
	<?php endif; ?>
	<?php wp_head(); ?>
	<meta name="facebook-domain-verification" content="hur62pgxjlzx8tpfd5lbvilp9ety0j" />
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wickie' ); ?></a>

	<header id="masthead" class="site-header">
		<?php get_template_part( 'template-parts/header/header-desktop' );?>
		<?php get_template_part( 'template-parts/header/header-mobile' );?>
	</header><!-- #masthead -->

