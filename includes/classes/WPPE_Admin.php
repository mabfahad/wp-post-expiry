<?php
defined('ABSPATH') || exit;

class WPPE_Admin {
    private static $instance = null;

    private function __construct() {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('add_meta_boxes', [$this, 'add_meta_box']);
        add_action('save_post', [$this, 'save_expiry_date']);
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
        <div class="wrap">
            <h1>Post Expiry Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('wppe_settings_group');
                do_settings_sections('wppe-settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    public function enqueue_assets($hook) {
        if (in_array($hook, ['post-new.php', 'post.php'])) {
            wp_enqueue_style('jquery-ui-datepicker');
            wp_enqueue_style('wppe-admin-style', WPPE_PLUGIN_DIR . 'assets/css/admin.css', __FILE__);
            wp_enqueue_script('jquery-ui-datepicker');
            wp_enqueue_script('wppe-admin-script', WPPE_PLUGIN_DIR . 'assets/js/admin.js', __FILE__);
        }
    }

    public function add_meta_box() {
        $enabled_post_types = get_option('wppe_enabled_post_types', []);
        foreach ($enabled_post_types as $type) {
            add_meta_box(
                'wppe_expiry_box',
                'Post Expiry Date',
                [$this, 'render_meta_box'],
                $type,
                'side'
            );
        }
    }

    public function render_meta_box($post) {
        $expiry_date = get_post_meta($post->ID, '_wppe_expiry_date', true);
        wp_nonce_field('wppe_save_expiry', 'wppe_expiry_nonce');
        echo '<label for="wppe_expiry_date">Expiry Date:</label>';
        echo '<input type="text" id="wppe_expiry_date" name="wppe_expiry_date" class="wppe-input" value="' . esc_attr($expiry_date) . '" placeholder="YYYY-MM-DD" />';
    }

    public function save_expiry_date($post_id) {
        if (!isset($_POST['wppe_expiry_nonce']) || !wp_verify_nonce($_POST['wppe_expiry_nonce'], 'wppe_save_expiry')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        $date = sanitize_text_field($_POST['wppe_expiry_date']);
        if ($date) {
            update_post_meta($post_id, '_wppe_expiry_date', $date);
        } else {
            delete_post_meta($post_id, '_wppe_expiry_date');
        }
    }
}
