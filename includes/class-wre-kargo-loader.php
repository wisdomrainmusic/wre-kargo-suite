<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class WRE_Kargo_Loader {

    public function __construct() {
        error_log("WRE Kargo Suite: Loader initialized");

        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_assets' ] );

        // WooCommerce Shipping Methods
        add_filter( 'woocommerce_shipping_methods', [ $this, 'register_shipping_methods' ] );
    }

    public function register_shipping_methods( $methods ) {

        require_once WRE_KARGO_SUITE_DIR . 'includes/class-wre-kargo-shipping-method-base.php';
        require_once WRE_KARGO_SUITE_DIR . 'includes/shipping-methods/class-wc-shipping-wre-basit.php';

        $methods['wre_basit_kargo'] = 'WC_Shipping_WRE_Basit';

        return $methods;
    }

    public function enqueue_admin_assets() {
        wp_enqueue_style(
            'wre-kargo-admin',
            WRE_KARGO_SUITE_URL . 'assets/css/admin.css',
            [],
            WRE_KARGO_SUITE_VERSION
        );

        wp_enqueue_script(
            'wre-kargo-admin',
            WRE_KARGO_SUITE_URL . 'assets/js/admin.js',
            ['jquery'],
            WRE_KARGO_SUITE_VERSION,
            true
        );
    }
}
