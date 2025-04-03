<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!current_user_can('manage_woocommerce')) {
    echo '<p>You do not have permission to view this page.</p>';
    return;
}

global $wpdb;
$table_name = $wpdb->prefix . 'harry_rma_requests';
$requests = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");
?>

<div class="rma-request-list">
    <h2>RMA Requests</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Request Type</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Update Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $request) : ?>
                <tr>
                    <td><?php echo esc_html($request->order_id); ?></td>
                    <td><?php echo esc_html($request->type); ?></td>
                    <td><?php echo esc_html($request->reason); ?></td>
                    <td id="status-<?php echo $request->id; ?>"><?php echo esc_html($request->status); ?></td>
                    <td>
                        <select class="rma-status-dropdown" data-request-id="<?php echo $request->id; ?>">
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="processing">Processing</option>
                        </select>
                        <button class="update-status-btn" data-request-id="<?php echo $request->id; ?>">Update</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div id="rma-status-response"></div>
</div>
