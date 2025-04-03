<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$order_id = isset($_GET['order_id']) ? sanitize_text_field($_GET['order_id']) : '';

$args = [
    'post_type' => 'rma_request',
    'meta_query' => [
        [
            'key' => 'order_id',
            'value' => $order_id,
            'compare' => '='
        ]
    ]
];

$rma_requests = new WP_Query($args);

if ($rma_requests->have_posts()) {
    while ($rma_requests->have_posts()) {
        $rma_requests->the_post();
        $status = get_post_meta(get_the_ID(), 'status', true);
        echo '<p>' . esc_html__('Status: ', 'rma-return-refund-exchange-woocommerce-pro') . esc_html($status) . '</p>';
    }
} else {
    echo '<p>' . esc_html__('No RMA request found for this order.', 'rma-return-refund-exchange-woocommerce-pro') . '</p>';
}

wp_reset_postdata();
?>
