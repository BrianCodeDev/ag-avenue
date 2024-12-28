<?php
/**
 * UnderStrap functions and definitions
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = 'inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once get_theme_file_path( $understrap_inc_dir . $file );
}
function custom_theme_enqueue_styles() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', [], '5.3.3', 'all');
    wp_enqueue_style('theme-style', get_stylesheet_uri(), ['bootstrap-css'], filemtime(get_template_directory() . '/style.css'), 'all');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', [], '5.3.3', true);
    wp_enqueue_script('fontawesome-js', 'https://kit.fontawesome.com/31778849f3.js', [], '5.3.3', true);

}
add_action('wp_enqueue_scripts', 'custom_theme_enqueue_styles');
function ag_avenue_add_admin_menu() {
    add_theme_page(
        'AG Avenue Theme Info',
        'Theme Info',
        'manage_options',
        'ag-avenue-info',
        'ag_avenue_theme_info_page'
    );
}
add_action('admin_menu', 'ag_avenue_add_admin_menu');

function ag_avenue_theme_info_page() {
    ?>
    <div class="wrap">
        <h1>AG Avenue Theme Information</h1>
        <p>This theme is designed by Brian Kelley for modern and responsive hardware stores.</p>
        <p><strong>Figma Design Link:</strong> <a href="https://www.figma.com/proto/EWT7253P88gYSkY6ZXhL2u/AG-Avenue-%7C-Made-by-Brian-Kelley?node-id=176-56&p=f&t=qquzoXPkcNm3yon4-1&scaling=min-zoom&content-scaling=fixed&page-id=0%3A1&starting-point-node-id=176%3A56&hotspot-hints=0" target="_blank">View the Figma Design</a></p>
    </div>
    <?php
}

function register_custom_menus() {
    register_nav_menus([
        'primary_menu' => __('Primary Menu', 'your-theme-textdomain'),
    ]);
}
add_action('after_setup_theme', 'register_custom_menus');

if (!function_exists('theme_customize_register')) {
    function theme_customize_register($wp_customize) {
        // Logo Setting
        $wp_customize->add_setting('navbar_show_logo', [
            'default' => true,
            'sanitize_callback' => 'wp_validate_boolean',
        ]);

        // Title Setting
        $wp_customize->add_setting('navbar_show_title', [
            'default' => false,
            'sanitize_callback' => 'wp_validate_boolean',
        ]);

        // Logo URL Setting
        $wp_customize->add_setting('navbar_logo_url', [
            'default' => get_template_directory_uri() . '/assets/logo.png',
            'sanitize_callback' => 'esc_url_raw',
        ]);

        // Logo Width Setting
        $wp_customize->add_setting('navbar_logo_width', [
            'default' => '50px', // Default width
            'sanitize_callback' => 'sanitize_text_field',
        ]);

        // Navbar Section
        $wp_customize->add_section('navbar_settings', [
            'title' => __('Navbar Settings', 'your-theme-textdomain'),
            'priority' => 30,
        ]);

        // Logo Control
        $wp_customize->add_control('navbar_show_logo', [
            'label' => __('Show Logo', 'your-theme-textdomain'),
            'section' => 'navbar_settings',
            'type' => 'checkbox',
        ]);

        // Title Control
        $wp_customize->add_control('navbar_show_title', [
            'label' => __('Show Site Title', 'your-theme-textdomain'),
            'section' => 'navbar_settings',
            'type' => 'checkbox',
        ]);

        // Logo URL Control
        $wp_customize->add_control('navbar_logo_url', [
            'label' => __('Logo URL', 'your-theme-textdomain'),
            'section' => 'navbar_settings',
            'type' => 'url',
        ]);

        // Logo Width Control
        $wp_customize->add_control('navbar_logo_width', [
            'label' => __('Logo Width (e.g., 50px or 10%)', 'your-theme-textdomain'),
            'section' => 'navbar_settings',
            'type' => 'text',
        ]);
    }
    add_action('customize_register', 'theme_customize_register');
}

// Display the Logo and Title in the Navbar
function custom_navbar_logo_and_title() {
    // Check if the logo is enabled
    if (get_theme_mod('navbar_show_logo', true)) {
        $logo_url = get_theme_mod('navbar_logo_url', get_template_directory_uri() . '/assets/logo.png');
        $logo_width = get_theme_mod('navbar_logo_width', '50px');
        echo '<img src="' . esc_url($logo_url) . '" alt="Logo" style="width:' . esc_attr($logo_width) . ';">';
    }

    // Check if the site title is enabled
    if (get_theme_mod('navbar_show_title', false)) {
        echo '<a class="navbar-brand" href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>';
    }
}

