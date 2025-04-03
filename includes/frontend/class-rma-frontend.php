<?php
if (!defined('ABSPATH')) {
    exit; // Direct access protection
}

if (!class_exists('RMA_Frontend')) {
    class RMA_Frontend {

        public function __construct() {
            add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
            add_shortcode('rma_request_form', [$this, 'display_rma_form']);
        }

        public function enqueue_scripts() {
            wp_enqueue_style('rma-frontend-style', plugins_url('assets/css/frontend.css', dirname(__FILE__)));
            wp_enqueue_script('rma-frontend-script', plugins_url('assets/js/frontend.js', dirname(__FILE__)), ['jquery'], null, true);
        }

        public function display_rma_form() {
            ob_start();
            ?>
            <form id="rma-request-form">
                <label for="order_id">Order ID:</label>
                <input type="text" id="order_id" name="order_id" required>

                <label for="reason">Reason:</label>
                <textarea id="reason" name="reason" required></textarea>

                <input type="submit" value="Submit Request">
            </form>
            <?php
            return ob_get_clean();
        }
    }

    new RMA_Frontend();
}
