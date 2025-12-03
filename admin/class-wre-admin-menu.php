<?php
if ( ! defined('ABSPATH') ) exit;

class WRE_Admin_Menu {

    public function __construct() {
        add_action('admin_menu', [$this, 'register_menu']);
    }

    public function register_menu() {
        add_menu_page(
            'WRE Kargo Suite',
            'WRE Kargo',
            'manage_options',
            'wre-kargo-suite',
            [$this, 'render_main_page'],
            'dashicons-admin-site-alt3',
            56
        );
    }

    public function render_main_page() {
        echo '<h1>WRE Kargo Suite – Ayarlar</h1>';
        echo '<p>Lütfen sol menüden bir kargo firması seçin.</p>';
    }
}

new WRE_Admin_Menu();
