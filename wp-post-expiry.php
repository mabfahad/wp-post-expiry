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
require_once plugin_dir_path(__FILE__) . 'includes/classes/WPPE_Settings.php';

function wppe_run_plugin() {
    WPPE_Admin::get_instance();
    WPPE_Expirer::get_instance();
    WPPE_Settings::get_instance();
}
add_action('plugins_loaded', 'wppe_run_plugin');

// Cron setup
register_activation_hook(__FILE__, function () {
    if (!wp_next_scheduled('wppe_cron_event')) {
        wp_schedule_event(time(), 'hourly', 'wppe_cron_event');
    }
});
register_deactivation_hook(__FILE__, function () {
    wp_clear_scheduled_hook('wppe_cron_event');
});