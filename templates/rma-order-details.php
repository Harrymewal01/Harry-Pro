<?php if ($request->status == 'approved') : ?>
    <button id="generate_label" class="button button-primary" data-order-id="<?php echo $request->order_id; ?>">
        Generate Return Label
    </button>
    <div id="label_result"></div>

    <script>
        jQuery(document).ready(function($) {
            $('#generate_label').click(function() {
                var orderId = $(this).data('order-id');

                $.post('<?php echo admin_url('admin-ajax.php'); ?>', {
                    action: 'generate_return_label',
                    order_id: orderId
                }, function(response) {
                    if (response.success) {
                        $('#label_result').html('<a href="' + response.label_url + '" target="_blank">Download Return Label</a>');
                    } else {
                        alert(response.message);
                    }
                });
            });
        });
    </script>
<?php endif; ?>
