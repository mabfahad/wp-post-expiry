<?php
/**
 * Plugin Name: WP Post Expiry
 * Description: Set expiry dates for posts and unpublish them automatically.
 * Version: 1.0.0
 * Author: Md Abdullah Al Fahad
 * Text Domain: wp-post-expiry
 */

defined('ABSPATH') || exit;

require_once plugin_dir_path(__FILE__) . 'includes/classes/WPPE_Admin.php';
require_once plugin_dir_path(__FILE__) . 'includes/classes/WPPE_Expirer.php';

function wppe_run_plugin() {
    WPPE_Admin::get_instance();
    WPPE_Expirer::get_instance();
}
add_action('plugins_loaded', 'wppe_run_plugin');
