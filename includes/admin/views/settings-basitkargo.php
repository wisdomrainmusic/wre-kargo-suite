<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$options = get_option( 'wre_kargo_options' );
$bk = $options['basitkargo'] ?? [];
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
                           value="<?php echo esc_attr( $bk['token'] ?? '' ); ?>" class="regular-text">
                </td>
            </tr>

            <tr>
                <th scope="row">Gönderici Profil ID</th>
                <td>
                    <input type="text" name="wre_kargo_options[basitkargo][profile_id]"
                           value="<?php echo esc_attr( $bk['profile_id'] ?? '' ); ?>" class="regular-text">
                </td>
            </tr>

            <tr>
                <th scope="row">Adres ID</th>
                <td>
                    <input type="text" name="wre_kargo_options[basitkargo][address_id]"
                           value="<?php echo esc_attr( $bk['address_id'] ?? '' ); ?>" class="regular-text">
                </td>
            </tr>
        </table>


        <h2 class="title">Varsayılan Gönderim Ayarları</h2>
        <table class="form-table">

            <tr>
                <th scope="row">Varsayılan Kargo Firması (handlerCode)</th>
                <td>
                    <select name="wre_kargo_options[basitkargo][handler_code]">
                        <option value="ECONOMIC" <?php selected( $bk['handler_code'], 'ECONOMIC' ); ?>>En Ekonomik</option>
                        <option value="FAST" <?php selected( $bk['handler_code'], 'FAST' ); ?>>En Hızlı</option>
                        <option value="PTT">PTT</option>
                        <option value="YURTICI">Yurtiçi</option>
                        <option value="ARAS">Aras</option>
                        <option value="MNG">MNG</option>
                        <option value="SURAT">Sürat</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th scope="row">Varsayılan Ödeme Yöntemi (paymentMethod)</th>
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
                        <option value="yes" <?php selected( $bk['auto_send'], 'yes' ); ?>>Açık (processing)</option>
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
                           value="<?php echo esc_attr( $bk['package']['height'] ?? 10 ); ?>"></td>
            </tr>

            <tr>
                <th scope="row">Genişlik (cm)</th>
                <td><input type="number" step="0.1"
                           name="wre_kargo_options[basitkargo][package][width]"
                           value="<?php echo esc_attr( $bk['package']['width'] ?? 10 ); ?>"></td>
            </tr>

            <tr>
                <th scope="row">Derinlik (cm)</th>
                <td><input type="number" step="0.1"
                           name="wre_kargo_options[basitkargo][package][depth]"
                           value="<?php echo esc_attr( $bk['package']['depth'] ?? 10 ); ?>"></td>
            </tr>

            <tr>
                <th scope="row">Ağırlık (kg)</th>
                <td><input type="number" step="0.1"
                           name="wre_kargo_options[basitkargo][package][weight]"
                           value="<?php echo esc_attr( $bk['package']['weight'] ?? 1 ); ?>"></td>
            </tr>

        </table>

        <?php submit_button(); ?>
    </form>
</div>
