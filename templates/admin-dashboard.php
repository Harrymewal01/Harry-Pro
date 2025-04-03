<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $wpdb;
$table_name = $wpdb->prefix . 'harry_rma_requests';

$requests = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");

?>

<div class="wrap">
    <h1>RMA Requests Dashboard</h1>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Type</th>
                <th>Status</th>
                <th>Requested On</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $request) : ?>
                <tr>
                    <td><?php echo esc_html($request->id); ?></td>
                    <td><?php echo esc_html($request->order_id); ?></td>
                    <td><?php echo esc_html(ucwords($request->type)); ?></td>
                    <td><?php echo esc_html(ucwords($request->status)); ?></td>
                    <td><?php echo esc_html($request->created_at); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
