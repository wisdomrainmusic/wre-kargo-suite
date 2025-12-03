<?php
if ( ! defined('ABSPATH') ) exit;

class WRE_Handler_Aras {

    public function __construct() {}

    public function send_order($order_id, $settings) {
        return [
            'success' => false,
            'message' => 'ARAS API henüz uygulanmadı.'
        ];
    }
}
