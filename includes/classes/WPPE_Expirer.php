<?php
defined('ABSPATH') || exit;

class WPPE_Expirer {
    private static $instance = null;

    private function __construct() {
        add_action('wppe_cron_event', [$this, 'expire_posts']);
    }

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function expire_post($post_id) {
        $action = get_option('wppe_expiry_action', 'draft');

        switch ($action) {
            case 'trash':
                wp_trash_post($post_id);
                break;

            case 'delete':
                wp_delete_post($post_id, true);
                break;

            case 'category':
                $category_id = get_option('wppe_expiry_category_id');
                if ($category_id && get_post_type($post_id) === 'post') {
                    wp_set_post_categories($post_id, [$category_id]);
                }
                break;

            case 'draft':
            default:
                wp_update_post(['ID' => $post_id, 'post_status' => 'draft']);
                break;
        }
    }
}
