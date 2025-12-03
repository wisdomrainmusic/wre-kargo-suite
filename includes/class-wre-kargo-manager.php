<?php
/**
 * WRE Kargo Suite – Core Manager
 */

defined('ABSPATH') || exit;

class WRE_Kargo_Manager {

    public function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
    }

    public function init() {

        // ------------------------------------------------------
        // Define plugin constants
        // ------------------------------------------------------
        $this->define_constants();

        // ------------------------------------------------------
        // Load required files
        // ------------------------------------------------------
        $this->load_files();

        // ------------------------------------------------------
        // Initialize admin menu
        // ------------------------------------------------------
        if (is_admin()) {
            new WRE_Kargo_Admin_Menu();
        }
    }

    private function define_constants() {
        if (!defined('WRE_KARGO_SUITE_DIR')) {
            define('WRE_KARGO_SUITE_DIR', plugin_dir_path(__DIR__));
        }

        if (!defined('WRE_KARGO_SUITE_URL')) {
            define('WRE_KARGO_SUITE_URL', plugin_dir_url(__DIR__));
        }
    }

    private function load_files() {

        // ------------------------------------------------------
        // Admin Menu (Correct Path)
        // ------------------------------------------------------
        require_once WRE_KARGO_SUITE_DIR . 'admin/class-wre-admin-menu.php';

        // ------------------------------------------------------
        // Carrier Pages (Correct Paths)
        // ------------------------------------------------------
        require_once WRE_KARGO_SUITE_DIR . 'admin/pages/class-wre-page-aras.php';
        require_once WRE_KARGO_SUITE_DIR . 'admin/pages/class-wre-page-surat.php';
        require_once WRE_KARGO_SUITE_DIR . 'admin/pages/class-wre-page-yurtici.php';
        require_once WRE_KARGO_SUITE_DIR . 'admin/pages/class-wre-page-ptt.php';
        require_once WRE_KARGO_SUITE_DIR . 'admin/pages/class-wre-page-dhl.php';
    }
}
