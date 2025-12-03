<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="wre-kargo-settings">
    <h2><?php echo esc_html( ucfirst( 'surat' ) ); ?> <?php esc_html_e( 'Ayarları', 'wre-kargo-suite' ); ?></h2>
    <form method="post" action="<?php echo esc_url( admin_url( 'admin.php?page=wre-kargo-suite&carrier=surat' ) ); ?>">
        <?php wp_nonce_field( 'wre_kargo_save_settings', 'wre_kargo_nonce' ); ?>
        <input type="hidden" name="carrier" value="surat" />
        <table class="form-table">
            <tbody>
            <?php foreach ( $fields as $field ) :
                $value = isset( $carrier_settings[ $field['id'] ] ) ? $carrier_settings[ $field['id'] ] : '';
                ?>
                <tr>
                    <th scope="row">
                        <label for="<?php echo esc_attr( $field['id'] ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
                    </th>
                    <td>
                        <?php if ( 'checkbox' === $field['type'] ) : ?>
                            <label>
                                <input type="checkbox" id="<?php echo esc_attr( $field['id'] ); ?>" name="<?php echo esc_attr( $field['id'] ); ?>" <?php checked( 'yes', $value ); ?> />
                                <?php echo esc_html( $field['desc'] ); ?>
                            </label>
                        <?php else : ?>
                            <input type="text" class="regular-text" id="<?php echo esc_attr( $field['id'] ); ?>" name="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $value ); ?>" />
                            <?php if ( ! empty( $field['desc'] ) ) : ?>
                                <p class="description"><?php echo esc_html( $field['desc'] ); ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <p class="submit">
            <button type="submit" class="button button-primary"><?php esc_html_e( 'Ayarları Kaydet', 'wre-kargo-suite' ); ?></button>
        </p>
    </form>
</div>
