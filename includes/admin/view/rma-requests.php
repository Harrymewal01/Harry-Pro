<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="wrap">
    <h1><?php esc_html_e('RMA Requests', 'rma-return-refund-exchange-woocommerce-pro'); ?></h1>
    
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th><?php esc_html_e('Request ID', 'rma-return-refund-exchange-woocommerce-pro'); ?></th>
                <th><?php esc_html_e('Order ID', 'rma-return-refund-exchange-woocommerce-pro'); ?></th>
                <th><?php esc_html_e('Customer', 'rma-return-refund-exchange-woocommerce-pro'); ?></th>
                <th><?php esc_html_e('Status', 'rma-return-refund-exchange-woocommerce-pro'); ?></th>
                <th><?php esc_html_e('Actions', 'rma-return-refund-exchange-woocommerce-pro'); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="5"><?php esc_html_e('No RMA requests available.', 'rma-return-refund-exchange-woocommerce-pro'); ?></td>
            </tr>
        </tbody>
    </table>
</div>
