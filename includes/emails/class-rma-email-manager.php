<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class RMA_Email_Manager {
    public static function send_email($email, $subject, $message) {
        $headers = ['Content-Type: text/html; charset=UTF-8'];
        wp_mail($email, $subject, $message, $headers);
    }

    public static function send_request_received_email($user_email, $order_id) {
        $subject = 'RMA Request Received - Order #' . $order_id;
        $message = '<p>Your RMA request for order <strong>#' . $order_id . '</strong> has been received.</p>';
        $message .= '<p>We will process your request soon.</p>';

        self::send_email($user_email, $subject, $message);
    }

    public static function send_request_updated_email($user_email, $order_id, $status) {
        $subject = 'RMA Request Updated - Order #' . $order_id;
        $message = '<p>Your RMA request for order <strong>#' . $order_id . '</strong> has been updated to: <strong>' . ucfirst($status) . '</strong>.</p>';

        self::send_email($user_email, $subject, $message);
    }

    public static function send_request_completed_email($user_email, $order_id) {
        $subject = 'RMA Request Completed - Order #' . $order_id;
        $message = '<p>Your RMA request for order <strong>#' . $order_id . '</strong> has been successfully processed.</p>';

        self::send_email($user_email, $subject, $message);
    }
}
