<?php
if ( ! defined('ABSPATH') ) exit;

class WRE_Handler_DHL {

    public function __construct() {}

    public function send_order($order_id, $settings) {
        return [
            'success' => false,
            'message' => 'DHL API henüz uygulanmadı.'
        ];
    }
}
