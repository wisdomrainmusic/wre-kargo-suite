<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WRE_Admin_Menu {

    /**
     * @var WRE_Kargo_Settings
     */
    protected $settings;

    /**
     * @var array<string, string>
     */
    protected $carriers = array(
        'aras'   => 'Aras Kargo',
        'surat'  => 'Sürat Kargo',
        'yurtici'=> 'Yurtiçi Kargo',
        'ptt'    => 'PTT Kargo',
        'dhl'    => 'DHL / HepsiJET',
    );

    public function __construct() {
        $this->settings = new WRE_Kargo_Settings();

        add_action( 'admin_menu', array( $this, 'register_menu' ) );
        add_action( 'admin_init', array( $this, 'handle_settings_save' ) );
    }

    public function register_menu() {

        // Ana Menü
        add_menu_page(
            'WRE Kargo Suite',
            'WRE Kargo Suite',
            'manage_options',
            'wre-kargo-suite',
            array( $this, 'render_main_page' ),
            'dashicons-admin-site-alt3',
            56
        );

        // Alt menüler (firma bazlı)
        foreach ( $this->carriers as $slug => $title ) {
            add_submenu_page(
                'wre-kargo-suite',
                $title . ' ' . __( 'Ayarları', 'wre-kargo-suite' ),
                $title,
                'manage_options',
                'wre-kargo-' . $slug,
                function() use ( $slug, $title ) {
                    $this->render_carrier_page( $slug, $title );
                }
            );
        }
    }

    public function render_main_page() {
        echo '<h1>WRE Kargo Suite – Ayarlar</h1>';
        echo '<p>Lütfen sol menüden bir kargo firması seçin.</p>';
    }

    public function render_carrier_page( $slug, $title ) {

        $view_file = WRE_KARGO_DIR . "admin/views/settings-{$slug}.php";

        $all_settings     = $this->settings->get_settings();
        $carrier_settings = isset( $all_settings[ $slug ] ) && is_array( $all_settings[ $slug ] ) ? $all_settings[ $slug ] : array();
        $fields           = $this->get_carrier_fields( $slug );

        echo '<div class="wrap">';
        settings_errors( 'wre_kargo_messages' );
        echo "<h1>{$title} Ayarları</h1>";

        if ( file_exists( $view_file ) ) {
            include $view_file;
        } else {
            echo "<p>Ayar dosyası bulunamadı: settings-{$slug}.php</p>";
        }

        echo '</div>';
    }

    public function handle_settings_save() {
        if ( ! isset( $_POST['wre_kargo_nonce'] ) ) {
            return;
        }

        if ( ! isset( $_POST['carrier'] ) || ! array_key_exists( sanitize_key( wp_unslash( $_POST['carrier'] ) ), $this->carriers ) ) {
            return;
        }

        $carrier = sanitize_key( wp_unslash( $_POST['carrier'] ) );

        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        if ( ! wp_verify_nonce( wp_unslash( $_POST['wre_kargo_nonce'] ), 'wre_kargo_save_settings' ) ) {
            return;
        }

        $settings = $this->settings->get_settings();
        $fields   = $this->get_carrier_fields( $carrier );

        $settings[ $carrier ] = array();

        foreach ( $fields as $field ) {
            $field_id = $field['id'];

            if ( 'checkbox' === $field['type'] ) {
                $settings[ $carrier ][ $field_id ] = isset( $_POST[ $field_id ] ) ? 'yes' : 'no';
                continue;
            }

            $value = isset( $_POST[ $field_id ] ) ? sanitize_text_field( wp_unslash( $_POST[ $field_id ] ) ) : '';
            $settings[ $carrier ][ $field_id ] = $value;
        }

        $this->settings->update_settings( $settings );

        add_settings_error( 'wre_kargo_messages', 'wre_kargo_saved', __( 'Ayarlar kaydedildi.', 'wre-kargo-suite' ), 'updated' );
    }

    protected function get_carrier_fields( $carrier ) {
        $default_fields = array(
            array(
                'id'    => 'api_url',
                'label' => __( 'API URL', 'wre-kargo-suite' ),
                'type'  => 'text',
                'desc'  => __( 'Servis uç noktası.', 'wre-kargo-suite' ),
            ),
            array(
                'id'    => 'api_username',
                'label' => __( 'API Kullanıcı Adı', 'wre-kargo-suite' ),
                'type'  => 'text',
                'desc'  => __( 'Entegrasyon kullanıcı adı.', 'wre-kargo-suite' ),
            ),
            array(
                'id'    => 'api_password',
                'label' => __( 'API Şifresi', 'wre-kargo-suite' ),
                'type'  => 'text',
                'desc'  => __( 'Entegrasyon şifresi.', 'wre-kargo-suite' ),
            ),
            array(
                'id'    => 'account_number',
                'label' => __( 'Müşteri/Üye Numarası', 'wre-kargo-suite' ),
                'type'  => 'text',
                'desc'  => __( 'Kargo firması müşteri numaranız.', 'wre-kargo-suite' ),
            ),
            array(
                'id'    => 'test_mode',
                'label' => __( 'Test Modu', 'wre-kargo-suite' ),
                'type'  => 'checkbox',
                'desc'  => __( 'Test modunu aktif et.', 'wre-kargo-suite' ),
            ),
        );

        return apply_filters( 'wre_kargo_carrier_fields', $default_fields, $carrier );
    }
}

new WRE_Admin_Menu();
