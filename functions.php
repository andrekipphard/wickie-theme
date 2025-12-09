<?php
/**
 * wickie functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wickie
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wickie_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on wickie, use a find and replace
		* to change 'wickie' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wickie', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'wickie' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'wickie_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'wickie_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wickie_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wickie_content_width', 640 );
}
add_action( 'after_setup_theme', 'wickie_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wickie_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wickie' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wickie' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wickie_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wickie_scripts() {
	wp_enqueue_style( 'wickie-style', get_template_directory_uri(). '/assets/css/main.css', array(), _S_VERSION );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri(). '/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', array('jquery'), _S_VERSION );

    // Enqueue comment-reply script if applicable
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'wickie_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

require_once get_template_directory() . '/inc/acf.php';

add_filter('acfe/flexible/thumbnail', 'dynamic_acf_layout_thumbnail', 10, 3);
function dynamic_acf_layout_thumbnail($thumbnail, $field, $layout) {
    
    // Get the layout name (slug)
    $layout_slug = $layout['name'];
    
    // Build the relative image path based on the layout name (e.g., 'hero_section' becomes '/wp-content/uploads/2024/09/hero_section.png')
    $image_path = '/wp-content/uploads/2024/09/' . $layout_slug . '.png';
    
    // Construct the full image URL using home_url() and the relative path
    $image_url = home_url() . $image_path;
    
    // Return the image URL
    return $image_url;
}

/**
 * @param array $sizes    An associative array of image sizes.
 * @param array $metadata An associative array of image metadata: width, height, file.
 */
function remove_image_sizes( $sizes, $metadata ) {
    return [];
}
add_filter( 'intermediate_image_sizes_advanced', 'remove_image_sizes', 10, 2 );

add_filter( 'woocommerce_package_rates', 'custom_hide_shipping_when_free_is_available', 100 );

function custom_hide_shipping_when_free_is_available( $rates ) {
    $free = [];

    foreach ( $rates as $rate_id => $rate ) {
        if ( 'free_shipping' === $rate->method_id ) {
            $free[ $rate_id ] = $rate;
            break;
        }
    }

    return ! empty( $free ) ? $free : $rates;
}

add_filter('woocommerce_get_order_item_totals', 'replace_lithuania_vat_label', 10, 3);
function replace_lithuania_vat_label($total_rows, $order, $tax_display) {
    foreach ($total_rows as $key => $row) {
        if (strpos($row['label'], 'Lithuania VAT') !== false) {
            $total_rows[$key]['label'] = str_replace('Lithuania VAT', '21% VAT', $row['label']);
        }
    }
    return $total_rows;
}

add_filter( 'intercom_settings', 'add_card_preregistered_to_intercom', 10, 1 );

function add_card_preregistered_to_intercom( $settings ) {
    if ( is_page( 5520 ) ) {
        $settings['card_preregistered'] = true;
    }
    return $settings;
}

add_action('acf/init', function() {

    if( !function_exists('update_field') ) return;

    $supported_countries = [
        ["country_name"=>"Andorra","country_code"=>"AD"],
        ["country_name"=>"Argentina","country_code"=>"AR"],
        ["country_name"=>"Armenia","country_code"=>"AM"],
        ["country_name"=>"Aruba","country_code"=>"AW"],
        ["country_name"=>"Azerbaijan","country_code"=>"AZ"],
        ["country_name"=>"Australia","country_code"=>"AU"],
        ["country_name"=>"Bahamas","country_code"=>"BS"],
        ["country_name"=>"Bahrain","country_code"=>"BH"],
        ["country_name"=>"Bangladesh","country_code"=>"BD"],
        ["country_name"=>"Barbados","country_code"=>"BB"],
        ["country_name"=>"Belgium","country_code"=>"BE"],
        ["country_name"=>"Belize","country_code"=>"BZ"],
        ["country_name"=>"Benin","country_code"=>"BJ"],
        ["country_name"=>"Bermuda","country_code"=>"BM"],
        ["country_name"=>"Bhutan","country_code"=>"BT"],
        ["country_name"=>"Bosnia and Herzegovina","country_code"=>"BA"],
        ["country_name"=>"Botswana","country_code"=>"BW"],
        ["country_name"=>"Brazil","country_code"=>"BR"],
        ["country_name"=>"Brunei","country_code"=>"BN"],
        ["country_name"=>"Burundi","country_code"=>"BI"],
        ["country_name"=>"Chile","country_code"=>"CL"],
        ["country_name"=>"Cook Islands","country_code"=>"CK"],
        ["country_name"=>"Costa Rica","country_code"=>"CR"],
        ["country_name"=>"Germany","country_code"=>"DE"],
        ["country_name"=>"Micronesia","country_code"=>"FM"],
        ["country_name"=>"Dominica","country_code"=>"DM"],
        ["country_name"=>"Dominican Republic","country_code"=>"DO"],
        ["country_name"=>"Djibouti","country_code"=>"DJ"],
        ["country_name"=>"Denmark","country_code"=>"DK"],
        ["country_name"=>"Ecuador","country_code"=>"EC"],
        ["country_name"=>"El Salvador","country_code"=>"SV"],
        ["country_name"=>"Estonia","country_code"=>"EE"],
        ["country_name"=>"Fiji","country_code"=>"FJ"],
        ["country_name"=>"Finland","country_code"=>"FI"],
        ["country_name"=>"France","country_code"=>"FR"],
        ["country_name"=>"Gambia","country_code"=>"GM"],
        ["country_name"=>"Georgia","country_code"=>"GE"],
        ["country_name"=>"Ghana","country_code"=>"GH"],
        ["country_name"=>"Grenada","country_code"=>"GD"],
        ["country_name"=>"Greece","country_code"=>"GR"],
        ["country_name"=>"Guam","country_code"=>"GU"],
        ["country_name"=>"Guatemala","country_code"=>"GT"],
        ["country_name"=>"Guinea","country_code"=>"GN"],
        ["country_name"=>"Guinea-Bissau","country_code"=>"GW"],
        ["country_name"=>"Guyana","country_code"=>"GY"],
        ["country_name"=>"Netherlands","country_code"=>"NL"],
        ["country_name"=>"Honduras","country_code"=>"HN"],
        ["country_name"=>"India","country_code"=>"IN"],
        ["country_name"=>"Indonesia","country_code"=>"ID"],
        ["country_name"=>"Ireland","country_code"=>"IE"],
        ["country_name"=>"Iceland","country_code"=>"IS"],
        ["country_name"=>"Israel","country_code"=>"IL"],
        ["country_name"=>"Italy","country_code"=>"IT"],
        ["country_name"=>"Jamaica","country_code"=>"JM"],
        ["country_name"=>"Japan","country_code"=>"JP"],
        ["country_name"=>"Jordan","country_code"=>"JO"],
        ["country_name"=>"Cambodia","country_code"=>"KH"],
        ["country_name"=>"Canada","country_code"=>"CA"],
        ["country_name"=>"Cape Verde","country_code"=>"CV"],
        ["country_name"=>"Kazakhstan","country_code"=>"KZ"],
        ["country_name"=>"Qatar","country_code"=>"QA"],
        ["country_name"=>"Kyrgyzstan","country_code"=>"KG"],
        ["country_name"=>"Kiribati","country_code"=>"KI"],
        ["country_name"=>"Colombia","country_code"=>"CO"],
        ["country_name"=>"Comoros","country_code"=>"KM"],
        ["country_name"=>"Congo","country_code"=>"CG"],
        ["country_name"=>"Croatia","country_code"=>"HR"],
        ["country_name"=>"Kuwait","country_code"=>"KW"],
        ["country_name"=>"Latvia","country_code"=>"LV"],
        ["country_name"=>"Liberia","country_code"=>"LR"],
        ["country_name"=>"Liechtenstein","country_code"=>"LI"],
        ["country_name"=>"Lithuania","country_code"=>"LT"],
        ["country_name"=>"Luxembourg","country_code"=>"LU"],
        ["country_name"=>"Macao","country_code"=>"MO"],
        ["country_name"=>"Madagascar","country_code"=>"MG"],
        ["country_name"=>"Malawi","country_code"=>"MW"],
        ["country_name"=>"Malaysia","country_code"=>"MY"],
        ["country_name"=>"Maldives","country_code"=>"MV"],
        ["country_name"=>"Malta","country_code"=>"MT"],
        ["country_name"=>"Morocco","country_code"=>"MA"],
        ["country_name"=>"Mauritania","country_code"=>"MR"],
        ["country_name"=>"Mauritius","country_code"=>"MU"],
        ["country_name"=>"North Macedonia","country_code"=>"MK"],
        ["country_name"=>"Mexico","country_code"=>"MX"],
        ["country_name"=>"Moldova","country_code"=>"MD"],
        ["country_name"=>"Mongolia","country_code"=>"MN"],
        ["country_name"=>"Montenegro","country_code"=>"ME"],
        ["country_name"=>"Nepal","country_code"=>"NP"],
        ["country_name"=>"New Zealand","country_code"=>"NZ"],
        ["country_name"=>"Niger","country_code"=>"NE"],
        ["country_name"=>"Norway","country_code"=>"NO"],
        ["country_name"=>"Timor-Leste","country_code"=>"TL"],
        ["country_name"=>"Palestine","country_code"=>"PS"],
        ["country_name"=>"Papua New Guinea","country_code"=>"PG"],
        ["country_name"=>"Paraguay","country_code"=>"PY"],
        ["country_name"=>"Peru","country_code"=>"PE"],
        ["country_name"=>"Philippines","country_code"=>"PH"],
        ["country_name"=>"Poland","country_code"=>"PL"],
        ["country_name"=>"Portugal","country_code"=>"PT"],
        ["country_name"=>"Puerto Rico","country_code"=>"PR"],
        ["country_name"=>"Rwanda","country_code"=>"RW"],
        ["country_name"=>"Romania","country_code"=>"RO"],
        ["country_name"=>"Solomon Islands","country_code"=>"SB"],
        ["country_name"=>"Samoa","country_code"=>"WS"],
        ["country_name"=>"San Marino","country_code"=>"SM"],
        ["country_name"=>"Saudi Arabia","country_code"=>"SA"],
        ["country_name"=>"Sweden","country_code"=>"SE"],
        ["country_name"=>"Switzerland","country_code"=>"CH"],
        ["country_name"=>"Serbia","country_code"=>"RS"],
        ["country_name"=>"Seychelles","country_code"=>"SC"],
        ["country_name"=>"Sierra Leone","country_code"=>"SL"],
        ["country_name"=>"Singapore","country_code"=>"SG"],
        ["country_name"=>"Slovakia","country_code"=>"SK"],
        ["country_name"=>"Slovenia","country_code"=>"SI"],
        ["country_name"=>"Somalia","country_code"=>"SO"],
        ["country_name"=>"Hong Kong","country_code"=>"HK"],
        ["country_name"=>"Spain","country_code"=>"ES"],
        ["country_name"=>"Sri Lanka","country_code"=>"LK"],
        ["country_name"=>"Saint Kitts and Nevis","country_code"=>"KN"],
        ["country_name"=>"Saint Lucia","country_code"=>"LC"],
        ["country_name"=>"Saint Vincent and the Grenadines","country_code"=>"VC"],
        ["country_name"=>"South Africa","country_code"=>"ZA"],
        ["country_name"=>"South Korea","country_code"=>"KR"],
        ["country_name"=>"Tajikistan","country_code"=>"TJ"],
        ["country_name"=>"Taiwan","country_code"=>"TW"],
        ["country_name"=>"Thailand","country_code"=>"TH"],
        ["country_name"=>"Togo","country_code"=>"TG"],
        ["country_name"=>"Chad","country_code"=>"TD"],
        ["country_name"=>"Czech Republic","country_code"=>"CZ"],
        ["country_name"=>"Tunisia","country_code"=>"TN"],
        ["country_name"=>"Turks and Caicos Islands","country_code"=>"TC"],
        ["country_name"=>"Turkey","country_code"=>"TR"],
        ["country_name"=>"Hungary","country_code"=>"HU"],
        ["country_name"=>"Uruguay","country_code"=>"UY"],
        ["country_name"=>"Uzbekistan","country_code"=>"UZ"],
        ["country_name"=>"United Arab Emirates","country_code"=>"AE"],
        ["country_name"=>"United Kingdom","country_code"=>"GB"],
        ["country_name"=>"Cyprus","country_code"=>"CY"],
        ["country_name"=>"Egypt","country_code"=>"EG"],
        ["country_name"=>"Equatorial Guinea","country_code"=>"GQ"],
        ["country_name"=>"Ethiopia","country_code"=>"ET"],
        ["country_name"=>"Austria","country_code"=>"AT"]
    ];

    // Feld "supported_country" auf Options Page füllen
    update_field('supported_country', $supported_countries, 'option');
});

add_action('acf/init', function() {

    if( !function_exists('update_field') ) return;

    $non_supported_countries = [
        ["country_name"=>"Afghanistan","country_code"=>"AFG"],
        ["country_name"=>"Angola","country_code"=>"AGO"],
        ["country_name"=>"Albania","country_code"=>"AL"],
        ["country_name"=>"Algeria","country_code"=>"DZA"],
        ["country_name"=>"Belarus","country_code"=>"BLR"],
        ["country_name"=>"Bolivia","country_code"=>"BO"],
        ["country_name"=>"Bulgaria","country_code"=>"BGR"],
        ["country_name"=>"Burkina Faso","country_code"=>"BF"],
        ["country_name"=>"Cameroon","country_code"=>"CM"],
        ["country_name"=>"Cayman Islands","country_code"=>"KY"],
        ["country_name"=>"China","country_code"=>"CN"],
        ["country_name"=>"Cuba","country_code"=>"CUB"],
        ["country_name"=>"Côte d’Ivoire","country_code"=>"CIV"],
        ["country_name"=>"Democratic Republic of Congo","country_code"=>"COD"],
        ["country_name"=>"Haiti","country_code"=>"HTI"],
        ["country_name"=>"Iran","country_code"=>"IRN"],
        ["country_name"=>"Iraq","country_code"=>"IRQ"],
        ["country_name"=>"Kenya","country_code"=>"KEN"],
        ["country_name"=>"Kosovo","country_code"=>"XKX"],
        ["country_name"=>"Lebanon","country_code"=>"LBN"],
        ["country_name"=>"Libya","country_code"=>"LY"],
        ["country_name"=>"Mali","country_code"=>"ML"],
        ["country_name"=>"Mozambique","country_code"=>"MZ"],
        ["country_name"=>"Myanmar","country_code"=>"MMR"],
        ["country_name"=>"Namibia","country_code"=>"NAM"],
        ["country_name"=>"Nicaragua","country_code"=>"NIC"],
        ["country_name"=>"Nigeria","country_code"=>"NG"],
        ["country_name"=>"North Korea","country_code"=>"PRK"],
        ["country_name"=>"Oman","country_code"=>"OMN"],
        ["country_name"=>"Pakistan","country_code"=>"PAK"],
        ["country_name"=>"Panama","country_code"=>"PAN"],
        ["country_name"=>"Tanzania","country_code"=>"TZ"],
        ["country_name"=>"Russia","country_code"=>"RU"],
        ["country_name"=>"Senegal","country_code"=>"SN"],
        ["country_name"=>"South Sudan","country_code"=>"SS"],
        ["country_name"=>"Sudan","country_code"=>"SDN"],
        ["country_name"=>"Syria","country_code"=>"SYR"],
        ["country_name"=>"Trinidad and Tobago","country_code"=>"TT"],
        ["country_name"=>"Uganda","country_code"=>"UG"],
        ["country_name"=>"Ukraine","country_code"=>"UKR"],
        ["country_name"=>"United States of America","country_code"=>"USA"],
        ["country_name"=>"Vanuatu","country_code"=>"VAN"],
        ["country_name"=>"Vietnam","country_code"=>"VN"],
        ["country_name"=>"Venezuela","country_code"=>"VEN"],
        ["country_name"=>"Western Sahara","country_code"=>"ESH"],
        ["country_name"=>"Yemen","country_code"=>"YEM"]
    ];

    // Feld "non_supported_country" auf Options Page füllen
    update_field('non_supported_country', $non_supported_countries, 'option');
});

