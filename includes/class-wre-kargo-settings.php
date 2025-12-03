<?php
/**
 * Handles plugin settings for each carrier.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WRE_Kargo_Settings {
    /**
     * Option key prefix.
     *
     * @var string
     */
    protected $option_key = 'wre_kargo_suite_settings';

    /**
     * Retrieve plugin settings.
     *
     * @return array
     */
    public function get_settings() {
        $defaults = array(
            'aras'    => array(),
            'yurtici' => array(),
            'surat'   => array(),
            'ptt'     => array(),
            'dhl'     => array(),
        );

        $saved = get_option( $this->option_key, array() );

        return wp_parse_args( $saved, $defaults );
    }

    /**
     * Update settings.
     *
     * @param array $settings Settings array.
     * @return void
     */
    public function update_settings( array $settings ) {
        update_option( $this->option_key, $settings );
    }
}
