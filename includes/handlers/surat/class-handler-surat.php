<?php
if ( ! defined('ABSPATH') ) exit;

class WRE_Handler_Surat {

    public function __construct() {}

    public function send_order($order_id, $settings) {
        return [
            'success' => false,
            'message' => 'SÜRAT API henüz uygulanmadı.'
        ];
    }
}
