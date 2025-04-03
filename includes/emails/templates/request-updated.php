<?php if (!defined('ABSPATH')) exit; ?>

<html>
<head>
    <title><?php esc_html_e('RMA Request Updated', 'rma-return-refund-exchange-woocommerce-pro'); ?></title>
</head>
<body>
    <p><?php esc_html_e('Hello,', 'rma-return-refund-exchange-woocommerce-pro'); ?></p>
    <p><?php esc_html_e('Your RMA request for order #', 'rma-return-refund-exchange-woocommerce-pro'); ?><?php echo esc_html($order_id); ?> <?php esc_html_e('has been updated.', 'rma-return-refund-exchange-woocommerce-pro'); ?></p>
    <p><?php esc_html_e('Current Status:', 'rma-return-refund-exchange-woocommerce-pro'); ?> <strong><?php echo esc_html($status); ?></strong></p>
    <p><?php esc_html_e('If you have any questions, please contact our support team.', 'rma-return-refund-exchange-woocommerce-pro'); ?></p>
    <p><?php esc_html_e('Thank you.', 'rma-return-refund-exchange-woocommerce-pro'); ?></p>
</body>
</html>
