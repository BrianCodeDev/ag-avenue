<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bootstrap_version = get_theme_mod( 'understrap_bootstrap_version', 'bootstrap4' );
$navbar_type       = get_theme_mod( 'understrap_navbar_type', 'collapse' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">
<div class="notification">
  <div class="container">
    <div class="left-notification">
      <p>Get more. Gift more. Shop December Deal Drops now. ></p>
    </div>
    <div class="right-notification">
      <a href="#!" class="left-side">Credit Center</a>
      <a href="#!" class="right-side">Order Status</a>
    </div>
  </div>
</div>
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <?php 
      // Check if a custom logo is set
      if (has_custom_logo()) {
          // Get custom width from the Customizer (default to 50px if not set)
          $logo_width = get_theme_mod('navbar_logo_width', '50px'); 
          
          // Get the logo markup and modify the width inline
          $custom_logo_id = get_theme_mod('custom_logo');
          $logo_url = wp_get_attachment_image_src($custom_logo_id, 'full')[0];
          echo '<img src="' . esc_url($logo_url) . '" alt="Logo" style="width:' . esc_attr($logo_width) . ';">';
      } else {
          // Fallback: Display the site name if no logo is set
          echo '<a class="navbar-brand" href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>';
      }
    ?>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <div class="location-box">
         <div class="display-location">
          <div class="location-time">
            <a href="#!"><i class="fa-solid fa-house"></i> Location <span class="time">9pm</span></a>
          </div>
          <div class="store-number">
            <a href="#!"><i class="fa-solid fa-truck"></i> <span class="number">1020</span></a>
          </div>
         </div>
        </div>
        <div class="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        </div>
      </ul>
      <form class="d-flex" role="search">
        <a href="#!">Sign In</a>
        <a href="#!">Shop Now</a>
      </form>
    </div>
  </div>
</nav>











 