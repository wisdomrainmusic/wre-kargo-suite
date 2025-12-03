<?php
if ( ! defined( 'ABSPATH' ) ) exit;

abstract class WRE_Kargo_Shipping_Method_Base extends WC_Shipping_Method {

    public function init_form_fields() {

        $this->form_fields = [
            'enabled' => [
                'title'       => 'Enable/Disable',
                'type'        => 'checkbox',
                'label'       => 'Enable this shipping method',
                'default'     => 'yes'
            ],

            'title' => [
                'title'       => 'Method Title',
                'type'        => 'text',
                'description' => 'Title shown to customers during checkout.',
                'default'     => $this->method_title,
                'desc_tip'    => true,
            ],

            'cost' => [
                'title'       => 'Shipping Cost',
                'type'        => 'price',
                'description' => 'Flat shipping fee.',
                'default'     => '0',
                'desc_tip'    => true,
            ],

            'free_shipping_min' => [
                'title'       => 'Free Shipping Min Amount',
                'type'        => 'price',
                'description' => 'If cart total exceeds this amount, shipping is free. Leave empty to disable.',
                'default'     => '',
                'desc_tip'    => true,
            ],
        ];
    }

    public function calculate_shipping( $package = [] ) {
        $cost     = $this->get_option( 'cost', 0 );
        $free_min = $this->get_option( 'free_shipping_min', '' );

        $cart_total = WC()->cart->get_displayed_subtotal();

        if ( $free_min !== '' && $cart_total >= floatval( $free_min ) ) {
            $cost = 0;
        }

        $this->add_rate([
            'id'    => $this->id,
            'label' => $this->title,
            'cost'  => $cost,
        ]);
    }
}
