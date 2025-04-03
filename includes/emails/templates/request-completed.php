<?php if (!defined('ABSPATH')) exit; ?>

<html>
<head>
    <title><?php esc_html_e('RMA Request Completed', 'rma-return-refund-exchange-woocommerce-pro'); ?></title>
</head>
<body>
    <p><?php esc_html_e('Hello,', 'rma-return-refund-exchange-woocommerce-pro'); ?></p>
    <p><?php esc_html_e('Your RMA request for order #', 'rma-return-refund-exchange-woocommerce-pro'); ?><?php echo esc_html($order_id); ?> <?php esc_html_e('has been successfully completed.', 'rma-return-refund-exchange-woocommerce-pro'); ?></p>
    <p><?php esc_html_e('If you have any further inquiries, please reach out to our support team.', 'rma-return-refund-exchange-woocommerce-pro'); ?></p>
    <p><?php esc_html_e('Thank you for choosing us.', 'rma-return-refund-exchange-woocommerce-pro'); ?></p>
</body>
</html>
