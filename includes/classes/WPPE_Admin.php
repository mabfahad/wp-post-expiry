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
        add_menu_page(
            'WP Post Expiry Settings',
            'WP Post Expiry',
            'manage_options',
            'wppe-settings',
            [$this, 'render_settings_page']
        );
    }

    public function render_settings_page() {
        ?>
        <?php
        $selected = get_option('wppe_enabled_post_types', []);
        $post_types = get_post_types(['public' => true], 'objects');

        echo '<div id="wppe-settings">';
            echo '<h2>WP Post Expiry Settings</h2>';
            foreach ($post_types as $type) {
                $checked = is_array($selected) && in_array($type->name, $selected) ? 'checked' : '';
                echo '<label style="display: block;margin-bottom: 10px;">';
                echo '<input type="checkbox" name="wppe_enabled_post_types[]" value="' . esc_attr($type->name) . '" ' . $checked . '> ';
                echo esc_html($type->labels->singular_name) . ' (' . $type->name . ')';
                echo '</label>';
            }
        echo '</div>';
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
