<?php if (!defined('ABSPATH')) exit; ?>

<html>
<head>
    <title><?php esc_html_e('RMA Request Received', 'rma-return-refund-exchange-woocommerce-pro'); ?></title>
</head>
<body>
    <p><?php esc_html_e('Hello,', 'rma-return-refund-exchange-woocommerce-pro'); ?></p>
    <p><?php esc_html_e('We have received your RMA request for order #', 'rma-return-refund-exchange-woocommerce-pro'); ?><?php echo esc_html($order_id); ?>.</p>
    <p><?php esc_html_e('Our team will review your request and update you shortly.', 'rma-return-refund-exchange-woocommerce-pro'); ?></p>
    <p><?php esc_html_e('Thank you.', 'rma-return-refund-exchange-woocommerce-pro'); ?></p>
</body>
</html>
