<form id="harry-rma-form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="order_id" value="<?php echo esc_attr($order_id); ?>">
    
    <label for="rma_reason">Reason for RMA:</label>
    <textarea name="rma_reason" id="rma_reason" required></textarea>

    <label for="rma_file">Upload File (Optional - JPG, PNG, PDF, Max 2MB):</label>
    <input type="file" name="rma_file" id="rma_file">

    <button type="submit">Submit RMA Request</button>
</form>

<script>
jQuery(document).ready(function($) {
    $('#harry-rma-form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response.data.message);
            }
        });
    });
});
</script>
