<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class RMA_Functions {
    /**
     * Get RMA requests
     *
     * @param int|null $user_id
     * @return array|object|null
     */
    public static function get_rma_requests($user_id = null) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'rma_requests';

        if ($user_id) {
            $user_id = intval($user_id);
            return $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE user_id = %d", $user_id));
        }
        
        return $wpdb->get_results("SELECT * FROM $table_name");
    }

    /**
     * Update RMA request status
     *
     * @param int $request_id
     * @param string $status
     * @return bool|int
     */
    public static function update_rma_status($request_id, $status) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'rma_requests';
        
        $request_id = intval($request_id);
        $status = sanitize_text_field($status);
        
        $allowed_statuses = ['pending', 'approved', 'rejected'];
        if (!in_array($status, $allowed_statuses)) {
            error_log("Invalid status update for RMA request ID: $request_id");
            return false;
        }
        
        $updated = $wpdb->update(
            $table_name,
            ['status' => $status],
            ['id' => $request_id],
            ['%s'],
            ['%d']
        );
        
        if ($updated === false) {
            error_log("Failed to update RMA request ID: $request_id");
        }
        
        return $updated;
    }
    
    /**
     * Delete an RMA request manually
     *
     * @param int $request_id
     * @return bool|int
     */
    public static function delete_rma_request($request_id) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'rma_requests';
        
        $request_id = intval($request_id);
        
        $deleted = $wpdb->delete(
            $table_name,
            ['id' => $request_id],
            ['%d']
        );
        
        if ($deleted === false) {
            error_log("Failed to delete RMA request ID: $request_id");
        }
        
        return $deleted;
    }
}