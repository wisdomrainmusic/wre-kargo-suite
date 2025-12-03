<?php
/**
 * Lightweight logger wrapper for the suite.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WRE_Kargo_Logger {
    /**
     * Log a message to the PHP error log.
     *
     * @param string $message Log message.
     * @param array  $context Additional context.
     * @return void
     */
    public function log( $message, array $context = array() ) {
        $formatted = '[WRE Kargo] ' . $message;

        if ( ! empty( $context ) ) {
            $formatted .= ' ' . wp_json_encode( $context );
        }

        error_log( $formatted );
    }
}
