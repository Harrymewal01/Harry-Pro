<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Check if the class already exists to prevent redeclaration error
if (!class_exists('RMA_Post_Types')) {
    class RMA_Post_Types {
        /**
         * Register Custom Post Type for RMA Requests
         */
        public static function register_post_types() {
            $args = [
                'labels' => [
                    'name'          => __('RMA Requests', 'rma-return-refund-exchange-woocommerce-pro'),
                    'singular_name' => __('RMA Request', 'rma-return-refund-exchange-woocommerce-pro'),
                    'add_new'       => __('Add New RMA Request', 'rma-return-refund-exchange-woocommerce-pro'),
                    'edit_item'     => __('Edit RMA Request', 'rma-return-refund-exchange-woocommerce-pro'),
                    'view_item'     => __('View RMA Request', 'rma-return-refund-exchange-woocommerce-pro'),
                    'search_items'  => __('Search RMA Requests', 'rma-return-refund-exchange-woocommerce-pro'),
                    'not_found'     => __('No RMA Requests found', 'rma-return-refund-exchange-woocommerce-pro'),
                    'all_items'     => __('Manage RMA Requests', 'rma-return-refund-exchange-woocommerce-pro'),
                ],
                'public'       => false,
                'show_ui'      => true,
                'show_in_menu' => true, // Show as a separate admin menu
                'menu_position'=> 55,
                'menu_title'   => __('RMA Return Refund & Exchange', 'rma-return-refund-exchange-woocommerce-pro'),
                'menu_icon'    => 'dashicons-external',
                'supports'     => ['title', 'editor', 'custom-fields'],
                'capability_type' => 'manage_woocommerce', // Restrict access to WooCommerce managers
                'map_meta_cap' => true,
                'hierarchical' => false,
                'rewrite'      => false,
                'query_var'    => true,
            ];

            register_post_type('rma_request', $args);
        }
    }
}

// Hook to register the custom post type
add_action('init', ['RMA_Post_Types', 'register_post_types']);