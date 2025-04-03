<?php
if (!defined('ABSPATH')) {
    exit;
}

$requests = get_posts([
    'post_type' => 'rma_request',
    'post_status' => 'publish',
    'author' => get_current_user_id()
]);
?>

<h2><?php esc_html_e('Your RMA Requests', 'rma-return-refund-exchange-woocommerce-pro'); ?></h2>

<table class="shop_table">
    <thead>
        <tr>
            <th><?php esc_html_e('Request ID', 'rma-return-refund-exchange-woocommerce-pro'); ?></th>
            <th><?php esc_html_e('Order ID', 'rma-return-refund-exchange-woocommerce-pro'); ?></th>
            <th><?php esc_html_e('Status', 'rma-return-refund-exchange-woocommerce-pro'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($requests)) : ?>
            <?php foreach ($requests as $request) : ?>
                <tr>
                    <td><?php echo esc_html($request->ID); ?></td>
                    <td><?php echo esc_html(get_post_meta($request->ID, 'order_id', true)); ?></td>
                    <td><?php echo esc_html(get_post_status($request->ID)); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="3"><?php esc_html_e('No RMA requests found.', 'rma-return-refund-exchange-woocommerce-pro'); ?></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
