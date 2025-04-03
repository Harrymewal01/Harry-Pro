<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!is_user_logged_in()) {
    echo '<p>Please log in to submit an RMA request.</p>';
    return;
}

?>

<div class="rma-request-form">
    <h2>Submit RMA Request</h2>
    <form id="rma-request-form">
        <label for="order_id">Order ID:</label>
        <input type="text" id="order_id" name="order_id" required>

        <label for="request_type">Request Type:</label>
        <select id="request_type" name="request_type" required>
            <option value="return">Return</option>
            <option value="refund">Refund</option>
            <option value="exchange">Exchange</option>
        </select>

        <label for="reason">Reason:</label>
        <textarea id="reason" name="reason" required></textarea>

        <input type="hidden" name="security" value="<?php echo wp_create_nonce('rma_nonce'); ?>">
        <button type="submit">Submit Request</button>
    </form>
    <div id="rma-response"></div>
</div>
