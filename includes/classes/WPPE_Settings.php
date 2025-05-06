<?php
defined('ABSPATH') || exit;

class WPPE_Settings {
    private static $instance = null;

    private function __construct() {
    }

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
