<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class WC_Shipping_WRE_Basit extends WRE_Kargo_Shipping_Method_Base {

    public function __construct( $instance_id = 0 ) {
        $this->id                 = 'wre_basit_kargo';
        $this->instance_id        = absint( $instance_id );
        $this->method_title       = 'WRE – Basit Kargo';
        $this->method_description = 'Flat-rate shipping method for testing WRE Kargo Suite.';
        $this->supports           = [ 'settings' ];

        $this->init();
    }

    public function init() {
        $this->init_form_fields();
        $this->init_settings();

        $this->enabled = $this->get_option( 'enabled' );
        $this->title   = $this->get_option( 'title' );

        add_action(
            'woocommerce_update_options_shipping_' . $this->id,
            [ $this, 'process_admin_options' ]
        );
    }
}
