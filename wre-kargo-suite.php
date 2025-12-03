<?php
/**
 * Plugin Name: WRE Kargo Suite
 * Description: Multi-carrier shipping integration suite for WooCommerce (Sürat, Aras, Yurtiçi, PTT, DHL, Basit Kargo).
 * Version: 0.1.0
 * Author: Wisdom Rain
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'WRE_KARGO_SUITE_VERSION', '0.1.0' );
define( 'WRE_KARGO_SUITE_DIR', plugin_dir_path( __FILE__ ) );
define( 'WRE_KARGO_SUITE_URL', plugin_dir_url( __FILE__ ) );

// Loader
require_once WRE_KARGO_SUITE_DIR . 'includes/class-wre-kargo-loader.php';

// Init plugin
add_action( 'plugins_loaded', function() {
    new WRE_Kargo_Loader();
});
