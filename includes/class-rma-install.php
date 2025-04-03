<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class RMA_Install {
    public static function activate() {
        self::create_rma_post_type();
        flush_rewrite_rules();
    }

    public static function deactivate() {
        flush_rewrite_rules();
    }

    private static function create_rma_post_type() {
        register_post_type('rma_request', [
            'labels' => [
                'name' => __('RMA Requests', 'rma-return-refund-exchange-woocommerce-pro'),
                'singular_name' => __('RMA Request', 'rma-return-refund-exchange-woocommerce-pro')
            ],
            'public' => false,
            'show_ui' => true,
            'supports' => ['title', 'editor', 'custom-fields'],
            'capability_type' => 'post'
        ]);
    }
}
