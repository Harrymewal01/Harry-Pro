<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!is_user_logged_in()) {
    echo '<p>Please log in to view your RMA requests.</p>';
    return;
}

$current_user_id = get_current_user_id();
global $wpdb;
$table_name = $wpdb->prefix . 'harry_rma_requests';

$requests = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE user_id = %d ORDER BY created_at DESC", $current_user_id));
?>

<div class="rma-dashboard">
    <h2>Your RMA Requests</h2>
    <?php if (empty($requests)) : ?>
        <p>No RMA requests found.</p>
    <?php else : ?>
        <table>
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
    <?php endif; ?>
</div>
