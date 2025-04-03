<?php
if (!defined('ABSPATH')) {
    exit;
}

$requests = get_posts([
    'post_type' => 'rma_request',
    'post_status' => 'publish',
    'numberposts' => -1
]);
?>

<div class="wrap">
    <h1><?php esc_html_e('RMA Dashboard', 'rma-return-refund-exchange-woocommerce-pro'); ?></h1>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th><?php esc_html_e('Request ID', 'rma-return-refund-exchange-woocommerce-pro'); ?></th>
                <th><?php esc_html_e('Order ID', 'rma-return-refund-exchange-woocommerce-pro'); ?></th>
                <th><?php esc_html_e('Status', 'rma-return-refund-exchange-woocommerce-pro'); ?></th>
                <th><?php esc_html_e('Actions', 'rma-return-refund-exchange-woocommerce-pro'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($requests)) : ?>
                <?php foreach ($requests as $request) : ?>
                    <tr>
                        <td><?php echo esc_html($request->ID); ?></td>
                        <td><?php echo esc_html(get_post_meta($request->ID, 'order_id', true)); ?></td>
                        <td><?php echo esc_html(get_post_status($request->ID)); ?></td>
                        <td>
                            <a href="<?php echo esc_url(admin_url('admin.php?page=rma-settings&request_id=' . $request->ID)); ?>" class="button"><?php esc_html_e('View', 'rma-return-refund-exchange-woocommerce-pro'); ?></a>
                            <a href="<?php echo esc_url(get_delete_post_link($request->ID)); ?>" class="button button-danger"><?php esc_html_e('Delete', 'rma-return-refund-exchange-woocommerce-pro'); ?></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4"><?php esc_html_e('No RMA requests found.', 'rma-return-refund-exchange-woocommerce-pro'); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
