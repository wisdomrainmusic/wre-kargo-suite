<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class WRE_Provider_BasitKargo {

    /**
     * BasitKargo API base URL.
     */
    private $api_url = 'https://basitkargo.com/api';

    /**
     * @var array
     */
    private $settings;

    public function __construct() {
        $opts          = get_option( 'wre_kargo_options' );
        $this->settings = $opts['basitkargo'] ?? [];
    }

    /**
     * SEND ORDER TO BASIT KARGO
     */
    public function send_order( $order_id ) {
        $order = wc_get_order( $order_id );

        if ( ! $order ) {
            return [ 'success' => false, 'message' => __( 'Order not found', 'wre-kargo-suite' ) ];
        }

        $client = [
            'name'    => trim( $order->get_shipping_first_name() . ' ' . $order->get_shipping_last_name() ),
            'phone'   => preg_replace( '/\D/', '', $order->get_billing_phone() ),
            'city'    => $order->get_shipping_city(),
            'town'    => $order->get_shipping_state(),
            'address' => trim( $order->get_shipping_address_1() . ' ' . $order->get_shipping_address_2() ),
        ];

        // Collect (Kapıda ödeme)
        $payment_method = $order->get_payment_method();

        $collect      = 0;
        $collect_type = null;

        if ( 'cod' === $payment_method ) {
            $collect      = floatval( $order->get_total() );
            $collect_type = $this->settings['cod_type'] ?? 'CASH';
        }

        // Paket bilgisi (varsayılan)
        $package_settings = $this->settings['package'] ?? [];
        $package          = [
            [
                'height' => floatval( $package_settings['height'] ?? 0 ),
                'width'  => floatval( $package_settings['width'] ?? 0 ),
                'depth'  => floatval( $package_settings['depth'] ?? 0 ),
                'weight' => floatval( $package_settings['weight'] ?? 0 ),
            ],
        ];

        $payload = [
            'content' => [
                'name'     => 'WooCommerce Order #' . $order_id,
                'code'     => $order->get_order_number(),
                'packages' => $package,
            ],
            'client'  => $client,
        ];

        if ( $collect > 0 ) {
            $payload['collect']               = $collect;
            $payload['collectOnDeliveryType'] = $collect_type;
        }

        $response = $this->call_api( '/v2/order', $payload );

        if ( ! $response['success'] ) {
            return $response;
        }

        $body = $response['body'] ?? [];

        return [
            'success'      => true,
            'shipment_id'  => $body['data']['id'] ?? $body['data']['orderId'] ?? $body['orderId'] ?? null,
            'tracking_url' => $body['data']['trackingUrl'] ?? $body['trackingUrl'] ?? null,
            'message'      => $response['message'] ?? '',
            'body'         => $body,
        ];
    }


    /**
     * CORE API CALLER
     */
    private function call_api( $endpoint, $body ) {
        $token = $this->settings['token'] ?? '';

        $response = wp_remote_post(
            $this->api_url . $endpoint,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type'  => 'application/json',
                ],
                'body'    => wp_json_encode( $body ),
                'timeout' => 30,
            ]
        );

        if ( is_wp_error( $response ) ) {
            return [ 'success' => false, 'message' => $response->get_error_message(), 'body' => null ];
        }

        $code = wp_remote_retrieve_response_code( $response );
        $body = json_decode( wp_remote_retrieve_body( $response ), true );

        if ( $code >= 200 && $code < 300 ) {
            return [ 'success' => true, 'message' => $body['message'] ?? '', 'body' => $body ];
        }

        return [
            'success' => false,
            'message' => $body['message'] ?? __( 'Unknown API error', 'wre-kargo-suite' ),
            'body'    => $body,
        ];
    }
}
