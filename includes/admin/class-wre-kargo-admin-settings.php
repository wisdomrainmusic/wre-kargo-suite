<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class WRE_Kargo_Admin_Settings {

    private $option_group = 'wre_kargo_group';
    private $option_key   = 'wre_kargo_options';

    public function __construct() {
        add_action( 'admin_init', [ $this, 'register_settings' ] );
    }

    public function get_option_group() {
        return $this->option_group;
    }

    public function get_option_key() {
        return $this->option_key;
    }

    public function get_settings() {
        $defaults = [
            'basitkargo' => [
                'token'         => '',
                'profile_id'    => '',
                'address_id'    => '',
                'handler_code'  => 'ECONOMIC',
                'payment_method'=> 'ADVANCE',
                'cod_type'      => 'CASH',
                'auto_send'     => 'yes',
                'package'       => [
                    'height' => 10.0,
                    'width'  => 10.0,
                    'depth'  => 10.0,
                    'weight' => 1.0,
                ],
            ],
        ];

        $options = get_option( $this->option_key, [] );

        return wp_parse_args( $options, $defaults );
    }

    public function register_settings() {
        register_setting(
            $this->option_group,
            $this->option_key,
            [ 'sanitize_callback' => [ $this, 'sanitize' ] ]
        );
    }

    public function sanitize( $input ) {
        $output = [];

        $output['basitkargo'] = [
            'token'         => sanitize_text_field( $input['basitkargo']['token'] ?? '' ),
            'profile_id'    => sanitize_text_field( $input['basitkargo']['profile_id'] ?? '' ),
            'address_id'    => sanitize_text_field( $input['basitkargo']['address_id'] ?? '' ),
            'handler_code'  => sanitize_text_field( $input['basitkargo']['handler_code'] ?? 'ECONOMIC' ),
            'payment_method'=> sanitize_text_field( $input['basitkargo']['payment_method'] ?? 'ADVANCE' ),
            'cod_type'      => sanitize_text_field( $input['basitkargo']['cod_type'] ?? 'CASH' ),
            'auto_send'     => sanitize_text_field( $input['basitkargo']['auto_send'] ?? 'yes' ),
            'package'       => [
                'height' => floatval( $input['basitkargo']['package']['height'] ?? 10 ),
                'width'  => floatval( $input['basitkargo']['package']['width'] ?? 10 ),
                'depth'  => floatval( $input['basitkargo']['package']['depth'] ?? 10 ),
                'weight' => floatval( $input['basitkargo']['package']['weight'] ?? 1 ),
            ],
        ];

        return $output;
    }
}
