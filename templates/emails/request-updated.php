<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<p><?php esc_html_e('Your RMA request status has been updated. Please check your request details.', 'rma-return-refund-exchange-woocommerce-pro'); ?></p>
<p><strong><?php esc_html_e('Request ID:', 'rma-return-refund-exchange-woocommerce-pro'); ?></strong> <?php echo esc_html($request_id); ?></p>
<p><strong><?php esc_html_e('New Status:', 'rma-return-refund-exchange-woocommerce-pro'); ?></strong> <?php echo esc_html($status); ?></p>
