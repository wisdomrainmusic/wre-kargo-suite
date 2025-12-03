<?php
if (!defined('ABSPATH')) exit;

class WRE_Kargo_Admin_Menu {

    public function __construct() {
        add_action('admin_menu', [$this, 'register_menu']);
    }

    public function register_menu() {

        // ANA MENÜ
        add_menu_page(
            'WRE Kargo Suite',
            'WRE Kargo Suite',
            'manage_options',
            'wre-kargo-suite',
            [$this, 'render_main_page'],
            'dashicons-admin-site',
            56
        );

        // ---- ALT MENÜLER ---- //

        // 1) ARAS
        add_submenu_page(
            'wre-kargo-suite',
            'Aras Kargo Ayarları',
            'Aras Kargo',
            'manage_options',
            'wre-kargo-aras',
            [$this, 'render_aras']
        );

        // 2) SÜRAT
        add_submenu_page(
            'wre-kargo-suite',
            'Sürat Kargo Ayarları',
            'Sürat Kargo',
            'manage_options',
            'wre-kargo-surat',
            [$this, 'render_surat']
        );

        // 3) YURTİÇİ
        add_submenu_page(
            'wre-kargo-suite',
            'Yurtiçi Kargo Ayarları',
            'Yurtiçi Kargo',
            'manage_options',
            'wre-kargo-yurtici',
            [$this, 'render_yurtici']
        );

        // 4) PTT
        add_submenu_page(
            'wre-kargo-suite',
            'PTT Kargo Ayarları',
            'PTT Kargo',
            'manage_options',
            'wre-kargo-ptt',
            [$this, 'render_ptt']
        );

        // 5) DHL
        add_submenu_page(
            'wre-kargo-suite',
            'DHL Kargo Ayarları',
            'DHL Kargo',
            'manage_options',
            'wre-kargo-dhl',
            [$this, 'render_dhl']
        );

        // 6) HEPSİJET
        add_submenu_page(
            'wre-kargo-suite',
            'HepsiJET Ayarları',
            'HepsiJET',
            'manage_options',
            'wre-kargo-hepsijet',
            [$this, 'render_hepsijet']
        );
    }

    // ---- SAYFA RENDER FONKSİYONLARI ---- //

    public function render_main_page() {
        echo '<div class="wrap"><h1>WRE Kargo Suite – Ayarlar</h1><p>Lütfen sol menüden bir kargo firması seçin.</p></div>';
    }

    public function render_aras() {
        echo '<div class="wrap"><h1>Aras Kargo Ayarları</h1><p>Aras Kargo API ayarları buraya gelecek.</p></div>';
    }

    public function render_surat() {
        echo '<div class="wrap"><h1>Sürat Kargo Ayarları</h1><p>Sürat Kargo API ayarları buraya gelecek.</p></div>';
    }

    public function render_yurtici() {
        echo '<div class="wrap"><h1>Yurtiçi Kargo Ayarları</h1><p>Yurtiçi Kargo API ayarları buraya gelecek.</p></div>';
    }

    public function render_ptt() {
        echo '<div class="wrap"><h1>PTT Kargo Ayarları</h1><p>PTT Kargo API ayarları buraya gelecek.</p></div>';
    }

    public function render_dhl() {
        echo '<div class="wrap"><h1>DHL Kargo Ayarları</h1><p>DHL Kargo API ayarları buraya gelecek.</p></div>';
    }

    public function render_hepsijet() {
        echo '<div class="wrap"><h1>HepsiJET Ayarları</h1><p>HepsiJET API ayarları buraya gelecek.</p></div>';
    }
}

new WRE_Kargo_Admin_Menu();
