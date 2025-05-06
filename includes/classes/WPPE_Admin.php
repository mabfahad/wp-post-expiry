<?php
defined('ABSPATH') || exit;

class WPPE_Admin {
    private static $instance = null;

    private function __construct() {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function add_settings_page() {
        add_options_page(
            'WP Post Expiry Settings',
            'WP Post Expiry',
            'manage_options',
            'wppe-settings',
            [$this, 'render_settings_page']
        );
    }

    public function render_settings_page() {
        ?>
        <h2>WP Post Expiry Settings</h2>
        <?php
    }

    public function enqueue_assets($hook) {
        if (in_array($hook, ['post-new.php', 'post.php'])) {
            wp_enqueue_style('jquery-ui-datepicker');
            wp_enqueue_style('wppe-admin-style', plugins_url('../assets/css/admin.css', __FILE__));
            wp_enqueue_script('jquery-ui-datepicker');
            wp_enqueue_script('wppe-admin-script', plugins_url('../assets/js/admin.js', __FILE__), ['jquery'], null, true);
        }
    }
}
