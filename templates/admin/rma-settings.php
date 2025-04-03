<?php
if (!defined('ABSPATH')) {
    exit; // Direct access protection
}

class RMA_Settings_Page {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function add_settings_page() {
        add_menu_page(
            __('RMA Settings', 'rma-return-refund-exchange-woocommerce-pro'),
            __('RMA Settings', 'rma-return-refund-exchange-woocommerce-pro'),
            'manage_options',
            'rma-settings',
            [$this, 'settings_page_content'],
            'dashicons-admin-generic',
            80
        );
    }

    public function register_settings() {
        $settings = [
            'rma_enable_emails' => 'yes',
            'rma_auto_approve' => 'no',
            'rma_return_days' => '30',
            'rma_enable_partial_refund' => 'no'
        ];

        foreach ($settings as $setting => $default) {
            register_setting('rma_settings_group', $setting);
        }
    }

    public function enqueue_scripts($hook) {
        if ($hook !== 'toplevel_page_rma-settings') return;
        wp_enqueue_style('rma-admin-css', plugin_dir_url(__FILE__) . 'admin.css');
        wp_enqueue_script('rma-admin-js', plugin_dir_url(__FILE__) . 'admin.js', ['jquery'], false, true);
    }

    public function settings_page_content() {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('RMA Settings', 'rma-return-refund-exchange-woocommerce-pro'); ?></h1>
            
            <h2 class="nav-tab-wrapper">
                <a href="#general" class="nav-tab nav-tab-active"><?php esc_html_e('General', 'rma-return-refund-exchange-woocommerce-pro'); ?></a>
                <a href="#emails" class="nav-tab"><?php esc_html_e('Emails', 'rma-return-refund-exchange-woocommerce-pro'); ?></a>
                <a href="#policy" class="nav-tab"><?php esc_html_e('Return Policy', 'rma-return-refund-exchange-woocommerce-pro'); ?></a>
            </h2>

            <form id="rma-settings-form" method="post" action="options.php">
                <?php settings_fields('rma_settings_group'); ?>

                <div id="general" class="tab-content active">
                    <h3><?php esc_html_e('General Settings', 'rma-return-refund-exchange-woocommerce-pro'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th><?php esc_html_e('Enable RMA Emails', 'rma-return-refund-exchange-woocommerce-pro'); ?></th>
                            <td>
                                <input type="checkbox" name="rma_enable_emails" value="yes" <?php checked('yes', get_option('rma_enable_emails', 'yes')); ?> />
                            </td>
                        </tr>
                        <tr>
                            <th><?php esc_html_e('Auto Approve Requests', 'rma-return-refund-exchange-woocommerce-pro'); ?></th>
                            <td>
                                <input type="checkbox" name="rma_auto_approve" value="yes" <?php checked('yes', get_option('rma_auto_approve', 'no')); ?> />
                            </td>
                        </tr>
                    </table>
                </div>

                <div id="emails" class="tab-content">
                    <h3><?php esc_html_e('Email Settings', 'rma-return-refund-exchange-woocommerce-pro'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th><?php esc_html_e('Return Days Limit', 'rma-return-refund-exchange-woocommerce-pro'); ?></th>
                            <td>
                                <input type="number" name="rma_return_days" value="<?php echo esc_attr(get_option('rma_return_days', '30')); ?>" />
                            </td>
                        </tr>
                    </table>
                </div>

                <div id="policy" class="tab-content">
                    <h3><?php esc_html_e('Return Policy', 'rma-return-refund-exchange-woocommerce-pro'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th><?php esc_html_e('Enable Partial Refunds', 'rma-return-refund-exchange-woocommerce-pro'); ?></th>
                            <td>
                                <input type="checkbox" name="rma_enable_partial_refund" value="yes" <?php checked('yes', get_option('rma_enable_partial_refund', 'no')); ?> />
                            </td>
                        </tr>
                    </table>
                </div>

                <p>
                    <button type="submit" class="button button-primary"><?php esc_html_e('Save Settings', 'rma-return-refund-exchange-woocommerce-pro'); ?></button>
                </p>
            </form>
        </div>
        <?php
    }
}

new RMA_Settings_Page();
