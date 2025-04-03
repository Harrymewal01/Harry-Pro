<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$current_user_id = get_current_user_id();
$args = [
    'post_type' => 'rma_request',
    'author' => $current_user_id,
    'posts_per_page' => -1
];

$rma_history = new WP_Query($args);

if ($rma_history->have_posts()) {
    echo '<table>';
    echo '<tr><th>' . esc_html__('Order ID', 'rma-return-refund-exchange-woocommerce-pro') . '</th><th>' . esc_html__('Status', 'rma-return-refund-exchange-woocommerce-pro') . '</th></tr>';
    while ($rma_history->have_posts()) {
        $rma_history->the_post();
        $order_id = get_post_meta(get_the_ID(), 'order_id', true);
        $status = get_post_meta(get_the_ID(), 'status', true);
        echo '<tr><td>' . esc_html($order_id) . '</td><td>' . esc_html($status) . '</td></tr>';
    }
    echo '</table>';
} else {
    echo '<p>' . esc_html__('No RMA requests found.', 'rma-return-refund-exchange-woocommerce-pro') . '</p>';
}

wp_reset_postdata();
?>
