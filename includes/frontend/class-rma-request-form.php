<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class RMA_Request_Form {

    public function __construct() {
        add_shortcode('rma_request_form', [$this, 'render_request_form']);
        add_action('init', [$this, 'handle_form_submission']);
    }

    public function render_request_form() {
        ob_start();
        ?>
        <form method="post" action="" enctype="multipart/form-data">
            <label>Email: <input type="email" name="customer_email" required></label>
            <label>Name: <input type="text" name="customer_name" required></label>
            <label>Order ID: <input type="text" name="order_id" required></label>
            <label>Order Date: <input type="date" name="order_date" required></label>
            
            <label>Return Reason:
                <select name="return_reason" required>
                    <option value="wrong_product">Wrong Product Received</option>
                    <option value="damaged_product">Damaged Product</option>
                    <option value="quality_issue">Quality Issue</option>
                    <option value="size_issue">Size Issue</option>
                    <option value="other">Other</option>
                </select>
            </label>
            
            <label>Return Type:
                <select name="return_type" required>
                    <option value="refund">Refund</option>
                    <option value="exchange">Exchange</option>
                </select>
            </label>
            
            <label>Upload Images (Max 3):
                <input type="file" name="return_images[]" accept="image/*" multiple>
            </label>
            
            <label>Comments: <textarea name="comments"></textarea></label>
            
            <input type="hidden" name="rma_request_nonce" value="<?php echo wp_create_nonce('rma_request_action'); ?>">
            <button type="submit" name="rma_submit_request">Submit Request</button>
        </form>
        <?php
        return ob_get_clean();
    }

    public function handle_form_submission() {
        if (isset($_POST['rma_submit_request'])) {
            if (!isset($_POST['rma_request_nonce']) || !wp_verify_nonce($_POST['rma_request_nonce'], 'rma_request_action')) {
                wp_die('Security check failed.');
            }

            if (!isset($_POST['customer_email'], $_POST['customer_name'], $_POST['order_id'], $_POST['order_date'], $_POST['return_reason'], $_POST['return_type'])) {
                wp_die('All required fields must be filled.');
            }

            $customer_email = sanitize_email($_POST['customer_email']);
            $customer_name = sanitize_text_field($_POST['customer_name']);
            $order_id = sanitize_text_field($_POST['order_id']);
            $order_date = sanitize_text_field($_POST['order_date']);
            $return_reason = sanitize_text_field($_POST['return_reason']);
            $return_type = sanitize_text_field($_POST['return_type']);
            $comments = sanitize_textarea_field($_POST['comments']);
            
            // Handle image uploads
            $uploaded_images = [];
            if (!empty($_FILES['return_images']['name'][0])) {
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                $upload_overrides = ['test_form' => false];
                
                foreach ($_FILES['return_images']['name'] as $key => $value) {
                    if ($_FILES['return_images']['error'][$key] === 0) {
                        $file = [
                            'name'     => $_FILES['return_images']['name'][$key],
                            'type'     => $_FILES['return_images']['type'][$key],
                            'tmp_name' => $_FILES['return_images']['tmp_name'][$key],
                            'error'    => $_FILES['return_images']['error'][$key],
                            'size'     => $_FILES['return_images']['size'][$key],
                        ];
                        
                        $upload = wp_handle_upload($file, $upload_overrides);
                        if ($upload && !isset($upload['error'])) {
                            $uploaded_images[] = $upload['url'];
                        }
                    }
                }
            }

            $post_data = [
                'post_title'   => 'RMA Request - Order ' . $order_id,
                'post_content' => $comments,
                'post_status'  => 'pending',
                'post_type'    => 'rma_request',
                'meta_input'   => [
                    'customer_email' => $customer_email,
                    'customer_name'  => $customer_name,
                    'order_id'       => $order_id,
                    'order_date'     => $order_date,
                    'return_reason'  => $return_reason,
                    'return_type'    => $return_type,
                    'return_images'  => $uploaded_images,
                ]
            ];

            $post_id = wp_insert_post($post_data);

            if ($post_id) {
                wp_redirect(add_query_arg('rma_success', '1', $_SERVER['REQUEST_URI']));
                exit;
            } else {
                wp_redirect(add_query_arg('rma_error', '1', $_SERVER['REQUEST_URI']));
                exit;
            }
        }
    }
}

new RMA_Request_Form();
