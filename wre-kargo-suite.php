<?php
/**
 * Plugin Name: WRE Kargo Suite
 * Description: Unified multi–carrier shipping integration (Aras, Sürat, Yurtiçi, PTT, DHL).
 * Version: 1.0.0
 * Author: Wisdomrain
 */

defined('ABSPATH') || exit;

// ------------------------------------------------------
// Load Core Manager
// ------------------------------------------------------
require_once plugin_dir_path(__FILE__) . 'includes/class-wre-kargo-manager.php';

// ------------------------------------------------------
// Bootstrap
// ------------------------------------------------------
new WRE_Kargo_Manager();

// ✔ Hata sebebi olan static çağrı tamamen kaldırıldı.
// ✔ Eklenti artık WP açıldığında otomatik ve temiz şekilde yüklenir.
