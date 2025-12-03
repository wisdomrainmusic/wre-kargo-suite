<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class WRE_Kargo_Admin_Menu {

    private $settings;

    public function __construct() {
        $this->settings = new WRE_Kargo_Admin_Settings();

        add_action( 'admin_menu', [ $this, 'register_menu' ] );
    }

    public function register_menu() {
        add_menu_page(
            'WRE Kargo Suite',
            'WRE Kargo Suite',
            'manage_options',
            'wre-kargo-suite',
            [ $this, 'render_settings_page' ],
            'dashicons-admin-site',
            58
        );
    }

    public function render_settings_page() {
        $settings      = $this->settings->get_settings();
        $option_group  = $this->settings->get_option_group();
        $option_key    = $this->settings->get_option_key();

        include WRE_KARGO_SUITE_DIR . 'includes/admin/views/settings-basitkargo.php';
    }
}
