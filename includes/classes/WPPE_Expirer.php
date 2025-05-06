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

    public function expire_posts() {
        $today = current_time('Y-m-d');
        $args = [
            'post_type'   => get_option('wppe_enabled_post_types', []),
            'post_status' => 'publish',
            'meta_query'  => [
                [
                    'key'     => '_wppe_expiry_date',
                    'value'   => $today,
                    'compare' => '<=',
                    'type'    => 'DATE'
                ]
            ],
            'fields'      => 'ids',
            'nopaging'    => true
        ];

        $posts = get_posts($args);
        foreach ($posts as $post_id) {
            wp_update_post([
                'ID' => $post_id,
                'post_status' => 'draft'
            ]);
        }
    }
}
