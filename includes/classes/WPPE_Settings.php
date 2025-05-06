<?php
defined('ABSPATH') || exit;

class WPPE_Settings {
    private static $instance = null;

    private function __construct() {
        add_action('admin_init', [$this, 'register_settings']);
    }

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function register_settings() {
        register_setting('wppe_settings_group', 'wppe_enabled_post_types');
        register_setting('wppe_settings_group', 'wppe_expiry_action');

        add_settings_section('wppe_main', 'Post Expiry Settings', null, 'wppe-settings');

        add_settings_field(
            'wppe_enabled_post_types',
            'Enable Expiry For Post Types:',
            [$this, 'render_post_type_checkboxes'],
            'wppe-settings',
            'wppe_main'
        );

        add_settings_field(
            'wppe_expiry_action',
            'Expiry Action:',
            [$this, 'render_expiry_action_field'],
            'wppe-settings',
            'wppe_main'
        );
    }

    public function render_expiry_action_field() {
        $selected = get_option('wppe_expiry_action', 'draft');
        $options = [
            'draft'   => 'Set to Draft',
            'trash'   => 'Move to Trash',
            'delete'  => 'Delete Permanently',
        ];

        echo '<select name="wppe_expiry_action">';
        foreach ($options as $value => $label) {
            $is_selected = selected($selected, $value, false);
            echo "<option value='$value' $is_selected>$label</option>";
        }
        echo '</select>';
    }
    public function render_post_type_checkboxes() {
        $selected = get_option('wppe_enabled_post_types', []);
        $post_types = get_post_types(['public' => true], 'objects');

        foreach ($post_types as $type) {
            $checked = in_array($type->name, $selected) ? 'checked' : '';
            echo '<label><input type="checkbox" name="wppe_enabled_post_types[]" value="' . esc_attr($type->name) . '" ' . $checked . '> ' . esc_html($type->labels->singular_name) . '</label><br>';
        }
    }
}
