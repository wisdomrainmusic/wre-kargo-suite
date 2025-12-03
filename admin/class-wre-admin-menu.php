<?php
defined('ABSPATH') || exit;

class WRE_Kargo_Admin_Menu {

    public function __construct() {
        add_action('admin_menu', [$this, 'register_menu']);
    }

    public function register_menu() {

        // Ana Menü
        add_menu_page(
            'WRE Kargo Suite',
            'WRE Kargo Suite',
            'manage_options',
            'wre-kargo-suite',
            [$this, 'render_placeholder'],
            'dashicons-admin-site'
        );

        // Aras
        add_submenu_page(
            'wre-kargo-suite',
            'Aras Kargo Ayarları',
            'Aras Kargo',
            'manage_options',
            'wre-kargo-aras',
            ['WRE_Page_Aras', 'render']
        );

        // Sürat
        add_submenu_page(
            'wre-kargo-suite',
            'Sürat Kargo Ayarları',
            'Sürat Kargo',
            'manage_options',
            'wre-kargo-surat',
            ['WRE_Page_Surat', 'render']
        );

        // Yurtiçi
        add_submenu_page(
            'wre-kargo-suite',
            'Yurtiçi Kargo Ayarları',
            'Yurtiçi Kargo',
            'manage_options',
            'wre-kargo-yurtici',
            ['WRE_Page_Yurtici', 'render']
        );

        // PTT
        add_submenu_page(
            'wre-kargo-suite',
            'PTT Kargo Ayarları',
            'PTT Kargo',
            'manage_options',
            'wre-kargo-ptt',
            ['WRE_Page_PTT', 'render']
        );

        // DHL / Hepsijet
        add_submenu_page(
            'wre-kargo-suite',
            'DHL / HepsiJET Ayarları',
            'DHL / HepsiJET',
            'manage_options',
            'wre-kargo-dhl',
            ['WRE_Page_DHL', 'render']
        );
    }

    // Ana placeholder sayfası
    public function render_placeholder() {
        echo '<h1>WRE Kargo Suite – Ayarlar</h1>';
        echo '<p>Lütfen sol menüden bir kargo firması seçin.</p>';
    }
}
