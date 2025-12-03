<?php
/**
 * Order helper responsible for triggering shipment routines.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WRE_Kargo_Order {
    /** @var WRE_Kargo_Logger */
    protected $logger;

    public function __construct( WRE_Kargo_Logger $logger ) {
        $this->logger = $logger;
    }

    /**
     * Record shipment meta against an order.
     *
     * @param int    $order_id WooCommerce order ID.
     * @param string $carrier  Carrier key.
     * @param string $tracking Tracking number.
     * @return void
     */
    public function add_tracking( $order_id, $carrier, $tracking ) {
        if ( ! $order_id || ! $tracking ) {
            return;
        }

        update_post_meta( $order_id, '_wre_kargo_carrier', $carrier );
        update_post_meta( $order_id, '_wre_kargo_tracking', $tracking );

        $this->logger->log( 'Tracking attached to order', array(
            'order_id' => $order_id,
            'carrier'  => $carrier,
            'tracking' => $tracking,
        ) );
    }
}
