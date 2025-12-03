<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Default Options
 */
$options = get_option('wre_kargo_options', []);

$bk = $options['basitkargo'] ?? [
    'token'         => '',
    'profile_id'    => '',
    'address_id'    => '',
    'handler_code'  => 'ECONOMIC',
    'payment_method'=> 'ADVANCE',
    'cod_type'      => 'CASH',
    'auto_send'     => 'yes',
    'package'       => [
        'height' => 10,
        'width'  => 10,
        'depth'  => 10,
        'weight' => 1,
    ],
];

?>

<div class="wrap">
    <h1>WRE Kargo Suite – Basit Kargo Ayarları</h1>

    <form method="post" action="options.php">
        <?php settings_fields( 'wre_kargo_group' ); ?>

        <h2 class="title">API Bilgileri</h2>
        <table class="form-table">
            <tr>
                <th scope="row">API Token</th>
                <td>
                    <input type="text" name="wre_kargo_options[basitkargo][token]"
                           value="<?php echo esc_attr( $bk['token'] ); ?>" class="regular-text">
                </td>
            </tr>

            <tr>
                <th scope="row">Gönderici Profil ID</th>
                <td>
                    <input type="text" name="wre_kargo_options[basitkargo][profile_id]"
                           value="<?php echo esc_attr( $bk['profile_id'] ); ?>" class="regular-text">
                </td>
            </tr>

            <tr>
                <th scope="row">Adres ID</th>
                <td>
                    <input type="text" name="wre_kargo_options[basitkargo][address_id]"
                           value="<?php echo esc_attr( $bk['address_id'] ); ?>" class="regular-text">
                </td>
            </tr>
        </table>


        <h2 class="title">Varsayılan Gönderim Ayarları</h2>
        <table class="form-table">

            <tr>
                <th scope="row">Varsayılan Kargo Firması (handlerCode)</th>
                <td>
                    <select name="wre_kargo_options[basitkargo][handler_code]">

                        <option value="ECONOMIC" <?php selected( $bk['handler_code'], 'ECONOMIC' ); ?>>
                            En Ekonomik (Otomatik)
                        </option>

                        <option value="FAST" <?php selected( $bk['handler_code'], 'FAST' ); ?>>
                            En Hızlı (Otomatik)
                        </option>

                        <optgroup label="Basit Kargo Anlaşmalı Firmalar">
                            <option value="HEPSIJET" <?php selected( $bk['handler_code'], 'HEPSIJET' ); ?>>HepsiJET</option>
                            <option value="SURAT" <?php selected( $bk['handler_code'], 'SURAT' ); ?>>Sürat</option>
                            <option value="PTT" <?php selected( $bk['handler_code'], 'PTT' ); ?>>PTT</option>
                            <option value="KOLAYGELSIN" <?php selected( $bk['handler_code'], 'KOLAYGELSIN' ); ?>>KolayGelsin</option>
                            <option value="ARAS" <?php selected( $bk['handler_code'], 'ARAS' ); ?>>Aras</option>
                            <option value="YURTICI" <?php selected( $bk['handler_code'], 'YURTICI' ); ?>>Yurtiçi</option>
                            <option value="MNG" <?php selected( $bk['handler_code'], 'MNG' ); ?>>MNG</option>
                        </optgroup>

                        <optgroup label="Kendi Anlaşmaların (SELF)">
                            <option value="SELF_HEPSIJET" <?php selected( $bk['handler_code'], 'SELF_HEPSIJET' ); ?>>HepsiJET (Kendi)</option>
                            <option value="SELF_SURAT" <?php selected( $bk['handler_code'], 'SELF_SURAT' ); ?>>Sürat (Kendi)</option>
                            <option value="SELF_PTT" <?php selected( $bk['handler_code'], 'SELF_PTT' ); ?>>PTT (Kendi)</option>
                            <option value="SELF_ARAS" <?php selected( $bk['handler_code'], 'SELF_ARAS' ); ?>>Aras (Kendi)</option>
                            <option value="SELF_YURTICI" <?php selected( $bk['handler_code'], 'SELF_YURTICI' ); ?>>Yurtiçi (Kendi)</option>
                            <option value="SELF_MNG" <?php selected( $bk['handler_code'], 'SELF_MNG' ); ?>>MNG (Kendi)</option>
                        </optgroup>

                    </select>
                </td>
            </tr>

            <tr>
                <th scope="row">Varsayılan Ödeme Yöntemi</th>
                <td>
                    <select name="wre_kargo_options[basitkargo][payment_method]">
                        <option value="ADVANCE" <?php selected( $bk['payment_method'], 'ADVANCE' ); ?>>Bakiye ile Öde</option>
                        <option value="CASH" <?php selected( $bk['payment_method'], 'CASH' ); ?>>Nakit</option>
                        <option value="RECIPIENT" <?php selected( $bk['payment_method'], 'RECIPIENT' ); ?>>Alıcı Öder</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th scope="row">Kapıda Ödeme Türü</th>
                <td>
                    <select name="wre_kargo_options[basitkargo][cod_type]">
                        <option value="CASH" <?php selected( $bk['cod_type'], 'CASH' ); ?>>Nakit</option>
                        <option value="CREDIT_CARD" <?php selected( $bk['cod_type'], 'CREDIT_CARD' ); ?>>Kredi Kartı</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th scope="row">Otomatik Sipariş Gönderimi</th>
                <td>
                    <select name="wre_kargo_options[basitkargo][auto_send]">
                        <option value="yes" <?php selected( $bk['auto_send'], 'yes' ); ?>>Açık (Processing)</option>
                        <option value="no" <?php selected( $bk['auto_send'], 'no' ); ?>>Kapalı</option>
                    </select>
                </td>
            </tr>

        </table>


        <h2 class="title">Varsayılan Paket Ölçüleri</h2>
        <table class="form-table">

            <tr>
                <th scope="row">Yükseklik (cm)</th>
                <td><input type="number" step="0.1"
                           name="wre_kargo_options[basitkargo][package][height]"
                           value="<?php echo esc_attr( $bk['package']['height'] ); ?>"></td>
            </tr>

            <tr>
                <th scope="row">Genişlik (cm)</th>
                <td><input type="number" step="0.1"
                           name="wre_kargo_options[basitkargo][package][width]"
                           value="<?php echo esc_attr( $bk['package']['width'] ); ?>"></td>
            </tr>

            <tr>
                <th scope="row">Derinlik (cm)</th>
                <td><input type="number" step="0.1"
                           name="wre_kargo_options[basitkargo][package][depth]"
                           value="<?php echo esc_attr( $bk['package']['depth'] ); ?>"></td>
            </tr>

            <tr>
                <th scope="row">Ağırlık (kg)</th>
                <td><input type="number" step="0.1"
                           name="wre_kargo_options[basitkargo][package][weight]"
                           value="<?php echo esc_attr( $bk['package']['weight'] ); ?>"></td>
            </tr>

        </table>

        <?php submit_button(); ?>
    </form>
</div>
