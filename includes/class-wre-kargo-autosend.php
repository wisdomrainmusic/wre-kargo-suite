<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class WRE_Kargo_AutoSend {

    public function __construct() {
        add_action( 'woocommerce_order_status_processing', [ $this, 'auto_send' ] );
    }

    public function auto_send( $order_id ) {
        $opts = get_option( 'wre_kargo_options' );
        $bk   = $opts['basitkargo'] ?? [];

        if ( ( $bk['auto_send'] ?? 'yes' ) !== 'yes' ) {
            return;
        }

        $provider = new WRE_Provider_BasitKargo();
        $result   = $provider->send_order( $order_id );

        if ( $result ) {
            update_post_meta( $order_id, '_wre_basitkargo_order_id', $result['id'] ?? '' );
        }
    }
}
