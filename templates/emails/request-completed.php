<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<p><?php esc_html_e('Your RMA request has been successfully processed and completed.', 'rma-return-refund-exchange-woocommerce-pro'); ?></p>
<p><strong><?php esc_html_e('Request ID:', 'rma-return-refund-exchange-woocommerce-pro'); ?></strong> <?php echo esc_html($request_id); ?></p>
<p><?php esc_html_e('Thank you for using our service.', 'rma-return-refund-exchange-woocommerce-pro'); ?></p>
