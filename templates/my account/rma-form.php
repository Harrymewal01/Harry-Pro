<?php
if (!defined('ABSPATH')) {
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rma_submit'])) {
    $order_id = sanitize_text_field($_POST['order_id']);
    $request_type = sanitize_text_field($_POST['request_type']);
    $reason = sanitize_textarea_field($_POST['reason']);

    $rma_request = [
        'post_title' => 'RMA Request for Order #' . $order_id,
        'post_type' => 'rma_request',
        'post_status' => 'pending',
        'post_author' => get_current_user_id()
    ];

    $request_id = wp_insert_post($rma_request);

    if ($request_id) {
        update_post_meta($request_id, 'order_id', $order_id);
        update_post_meta($request_id, 'request_type', $request_type);
        update_post_meta($request_id, 'reason', $reason);
        echo '<p>' . esc_html__('Your RMA request has been submitted.', 'rma-return-refund-exchange-woocommerce-pro') . '</p>';
    }
}
?>

<h2><?php esc_html_e('Submit RMA Request', 'rma-return-refund-exchange-woocommerce-pro'); ?></h2>

<form method="post">
    <p>
        <label><?php esc_html_e('Order ID:', 'rma-return-refund-exchange-woocommerce-pro'); ?></label>
        <input type="text" name="order_id" required>
    </p>
    <p>
        <label><?php esc_html_e('Request Type:', 'rma-return-refund-exchange-woocommerce-pro'); ?></label>
        <select name="request_type">
            <option value="refund"><?php esc_html_e('Refund', 'rma-return-refund-exchange-woocommerce-pro'); ?></option>
            <option value="exchange"><?php esc_html_e('Exchange', 'rma-return-refund-exchange-woocommerce-pro'); ?></option>
        </select>
    </p>
    <p>
        <label><?php esc_html_e('Reason:', 'rma-return-refund-exchange-woocommerce-pro'); ?></label>
        <textarea name="reason" required></textarea>
    </p>
    <p>
        <button type="submit" name="rma_submit"><?php esc_html_e('Submit Request', 'rma-return-refund-exchange-woocommerce-pro'); ?></button>
    </p>
</form>
