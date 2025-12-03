<?php
if ( ! defined('ABSPATH') ) exit;

class WRE_Handler_Yurtici {

    public function __construct() {}

    public function send_order($order_id, $settings) {
        return [
            'success' => false,
            'message' => 'YURTİÇİ API henüz uygulanmadı.'
        ];
    }
}
