<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class WRE_Kargo_Loader {

    public function __construct() {
        error_log("WRE Kargo Suite: Loader initialized");

        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_assets' ] );
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
