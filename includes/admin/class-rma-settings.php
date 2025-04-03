<?php
if (!defined('ABSPATH')) {
    exit; // Direct access protection
}

if (!class_exists('RMA_Settings')) {
    class RMA_Settings {

        public function __construct() {
            add_action('admin_menu', [$this, 'add_settings_page']);
            add_action('admin_init', [$this, 'register_settings']);
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
            register_setting('rma_settings_group', 'rma_email_notifications');
            register_setting('rma_settings_group', 'rma_auto_approve');

            add_settings_section(
                'rma_main_section',
                __('RMA Settings', 'rma-return-refund-exchange-woocommerce-pro'),
                null,
                'rma-settings'
            );

            $this->add_settings_field(
                'rma_email_notifications',
                __('Enable Email Notifications', 'rma-return-refund-exchange-woocommerce-pro'),
                'email_notifications_callback'
            );

            $this->add_settings_field(
                'rma_auto_approve',
                __('Auto Approve Returns', 'rma-return-refund-exchange-woocommerce-pro'),
                'auto_approve_callback'
            );
        }

        private function add_settings_field($id, $label, $callback) {
            add_settings_field(
                $id,
                $label,
                [$this, $callback],
                'rma-settings',
                'rma_main_section'
            );
        }

        public function settings_page_content() {
            ?>
            <div class="wrap">
                <h1><?php esc_html_e('RMA Settings', 'rma-return-refund-exchange-woocommerce-pro'); ?></h1>
                <form method="post" action="options.php">
                    <?php
                    settings_fields('rma_settings_group');
                    do_settings_sections('rma-settings');
                    submit_button();
                    ?>
                </form>
            </div>
            <?php
        }

        public function email_notifications_callback() {
            $option = get_option('rma_email_notifications', 0);
            ?>
            <input type="checkbox" name="rma_email_notifications" value="1" <?php checked(1, $option, true); ?> />
            <?php esc_html_e('Enable email notifications for RMA requests', 'rma-return-refund-exchange-woocommerce-pro'); ?>
            <?php
        }

        public function auto_approve_callback() {
            $option = get_option('rma_auto_approve', 0);
            ?>
            <input type="checkbox" name="rma_auto_approve" value="1" <?php checked(1, $option, true); ?> />
            <?php esc_html_e('Automatically approve return requests', 'rma-return-refund-exchange-woocommerce-pro'); ?>
            <?php
        }
    }

    new RMA_Settings();
}