<?php
/**
 * Central bootstrap for WRE Kargo Suite v2.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WRE_Kargo_Manager {
    /** @var WRE_Kargo_Settings */
    protected $settings;

    /** @var WRE_Kargo_Logger */
    protected $logger;

    /** @var WRE_Kargo_Order */
    protected $order;

    /** @var array<string,object> */
    protected $handlers = array();

    /** @var WRE_Kargo_Manager|null */
    protected static $instance = null;

    public static function init() {
        if ( null !== self::$instance ) {
            return self::$instance;
        }

        self::load_core_classes();
        self::load_handlers();
        require_once WRE_KARGO_DIR . 'admin/class-wre-admin-menu.php';

        self::$instance = new self();

        return self::$instance;
    }

    public function __construct() {
        $this->settings = new WRE_Kargo_Settings();
        $this->logger   = new WRE_Kargo_Logger();
        $this->order    = new WRE_Kargo_Order( $this->logger );

        $this->init_handlers();
        $this->init_admin();
    }

    protected function init_handlers() {
        $this->handlers['aras']    = new WRE_Handler_Aras( $this->settings, $this->logger );
        $this->handlers['yurtici'] = new WRE_Handler_Yurtici( $this->settings, $this->logger );
        $this->handlers['surat']   = new WRE_Handler_Surat( $this->settings, $this->logger );
        $this->handlers['ptt']     = new WRE_Handler_Ptt( $this->settings, $this->logger );
        $this->handlers['dhl']     = new WRE_Handler_DHL( $this->settings, $this->logger );
    }

    protected function init_admin() {
        if ( is_admin() ) {
            new WRE_Admin_Menu();
        }
    }

    /**
     * Retrieve a handler by carrier key.
     *
     * @param string $carrier Carrier key.
     * @return object|null
     */
    public function get_handler( $carrier ) {
        return isset( $this->handlers[ $carrier ] ) ? $this->handlers[ $carrier ] : null;
    }

    private static function load_handlers() {
        $handlers = array( 'aras', 'yurtici', 'surat', 'ptt', 'dhl' );

        foreach ( $handlers as $handler ) {
            $file = WRE_KARGO_DIR . "includes/handlers/{$handler}/class-handler-{$handler}.php";
            if ( file_exists( $file ) ) {
                require_once $file;
            }
        }
    }

    private static function load_core_classes() {
        require_once WRE_KARGO_DIR . 'includes/class-wre-kargo-settings.php';
        require_once WRE_KARGO_DIR . 'includes/class-wre-kargo-logger.php';
        require_once WRE_KARGO_DIR . 'includes/class-wre-kargo-order.php';
    }
}
