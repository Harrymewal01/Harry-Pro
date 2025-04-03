<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<p><?php esc_html_e('Your RMA request has been received. Our team will review it shortly.', 'rma-return-refund-exchange-woocommerce-pro'); ?></p>
<p><strong><?php esc_html_e('Request ID:', 'rma-return-refund-exchange-woocommerce-pro'); ?></strong> <?php echo esc_html($request_id); ?></p>
<p><strong><?php esc_html_e('Order ID:', 'rma-return-refund-exchange-woocommerce-pro'); ?></strong> <?php echo esc_html($order_id); ?></p>
<p><?php esc_html_e('Thank you for your patience.', 'rma-return-refund-exchange-woocommerce-pro'); ?></p>
