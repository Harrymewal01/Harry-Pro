<?php
// Exit if accessed directly
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete plugin options
delete_option('rma_email_notifications');
delete_option('rma_auto_approve');

// Delete post types (RMA requests)
global $wpdb;
$wpdb->query("DELETE FROM {$wpdb->posts} WHERE post_type = 'rma_request'");
$wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE post_id NOT IN (SELECT ID FROM {$wpdb->posts})");

// Delete any custom tables (if used)
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}rma_requests");

// Clear scheduled actions (if any)
wp_clear_scheduled_hook('rma_scheduled_task');
