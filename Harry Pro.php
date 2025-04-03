<?php
/**
 * Plugin Name: Harry - RMA Pro
 * Plugin URI: https://yourwebsite.com/
 * Description: A fully functional RMA plugin for WooCommerce with return, refund, and exchange features.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com/
 * License: GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: rma-return-refund-exchange-woocommerce-pro
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define plugin constants
define('RMA_PLUGIN_VERSION', '1.0.0');
define('RMA_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('RMA_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include main classes and activation hooks
require_once RMA_PLUGIN_DIR . 'includes/class-rma-install.php';
require_once RMA_PLUGIN_DIR . 'includes/class-rma-functions.php';
require_once RMA_PLUGIN_DIR . 'includes/class-rma-post-types.php';
require_once RMA_PLUGIN_DIR . 'includes/admin/class-rma-settings.php';
require_once RMA_PLUGIN_DIR . 'includes/frontend/class-rma-frontend.php';
require_once RMA_PLUGIN_DIR . 'includes/emails/class-rma-email-manager.php';
require_once RMA_PLUGIN_DIR . 'includes/frontend/class-rma-request-form.php';

// Activation Hook
register_activation_hook(__FILE__, ['RMA_Install', 'activate']);

// Deactivation Hook
register_deactivation_hook(__FILE__, ['RMA_Install', 'deactivate']);

// Initialize the plugin
function rma_init_plugin() {
    if (!class_exists('WooCommerce')) {
        add_action('admin_notices', function() {
            echo '<div class="error"><p><strong>RMA Plugin</strong> requires WooCommerce to be installed and active.</p></div>';
        });
        return;
    }
    
    // Initialize core functionalities
    new RMA_Admin();
    new RMA_Settings();
    new RMA_Frontend();
    new RMA_Request_Form();
    new RMA_Email_Manager();
}
add_action('plugins_loaded', 'rma_init_plugin');

// Class for RMA Post Types
class RMA_Post_Types {
    public static function register_post_types() {
        register_post_type('rma_request', [
            'labels' => [
                'name' => __('RMA Requests', 'rma-return-refund-exchange-woocommerce-pro'),
                'singular_name' => __('RMA Request', 'rma-return-refund-exchange-woocommerce-pro')
            ],
            'public' => false,
            'show_ui' => true,
            'supports' => ['title', 'editor', 'custom-fields'],
            'capability_type' => 'post'
        ]);
    }
}
add_action('init', ['RMA_Post_Types', 'register_post_types']);

// Class for RMA Admin
class RMA_Admin {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
    }

    public function add_admin_menu() {
        add_menu_page(
	    'RMA Requests',
            'RMA Requests',
            'manage_options',
            'rma-requests',
            [$this, 'render_admin_dashboard'],
            'dashicons-archive'
        );
    }

    public function render_admin_dashboard() {
        echo '<div class="wrap"><h1>RMA Requests</h1><p>Manage all RMA requests here.</p></div>';
    }
}
new RMA_Admin();

// Class for RMA Settings
class RMA_Settings {
    public function __construct() {
        add_action('admin_init', [$this, 'register_settings']);
    }

    public function register_settings() {
        register_setting('rma_settings_group', 'rma_email_notifications');
        add_settings_section('rma_main_section', 'RMA Settings', null, 'rma-settings');
        add_settings_field(
            'rma_email_notifications',
            'Enable Email Notifications',
            [$this, 'email_notifications_callback'],
            'rma-settings',
            'rma_main_section'
        );
    }

    public function email_notifications_callback() {
        $value = get_option('rma_email_notifications', 'yes');
        echo '<input type="checkbox" name="rma_email_notifications" value="yes" ' . checked('yes', $value, false) . ' />';
    }
}
new RMA_Settings();

// Class for RMA Frontend
class RMA_Frontend {
    public function __construct() {
        add_shortcode('rma_request_form', [$this, 'render_request_form']);
    }

    public function render_request_form() {
        ob_start();
        echo '<form method="post" action="">
                <label>Order ID: <input type="text" name="order_id" required></label>
                <label>Request Type: 
                    <select name="request_type">
                        <option value="refund">Refund</option>
                        <option value="exchange">Exchange</option>
                    </select>
                </label>
                <label>Reason: <textarea name="reason" required></textarea></label>
                <button type="submit">Submit Request</button>
              </form>';
        return ob_get_clean();
    }
}
new RMA_Frontend();
