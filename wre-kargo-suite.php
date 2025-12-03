<?php
/**
 * Plugin Name: WRE Kargo Suite
 * Description: Aras, Yurtiçi, Sürat, PTT ve DHL için profesyonel kargo entegrasyonu.
 * Version: 2.0.0
 * Author: Wisdom Rain
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'WRE_KARGO_VERSION', '2.0.0' );
define( 'WRE_KARGO_DIR', plugin_dir_path( __FILE__ ) );
define( 'WRE_KARGO_URL', plugin_dir_url( __FILE__ ) );

// Backward compatibility with earlier constant names used in the suite.
if ( ! defined( 'WRE_KARGO_SUITE_VERSION' ) ) {
    define( 'WRE_KARGO_SUITE_VERSION', WRE_KARGO_VERSION );
}

if ( ! defined( 'WRE_KARGO_SUITE_DIR' ) ) {
    define( 'WRE_KARGO_SUITE_DIR', WRE_KARGO_DIR );
}

if ( ! defined( 'WRE_KARGO_SUITE_URL' ) ) {
    define( 'WRE_KARGO_SUITE_URL', WRE_KARGO_URL );
}

require_once WRE_KARGO_DIR . 'includes/class-wre-kargo-manager.php';

add_action( 'plugins_loaded', array( 'WRE_Kargo_Manager', 'init' ) );
