<?php
defined('WP_UNINSTALL_PLUGIN') || exit;

global $wpdb;
$wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE meta_key = '_wppe_expiry_date'");
delete_option('wppe_enabled_post_types');
