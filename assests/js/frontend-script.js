document.addEventListener("DOMContentLoaded", function () {
    let rmaForm = document.querySelector(".rma-form-container form");

    if (rmaForm) {
        rmaForm.addEventListener("submit", function (e) {
            let orderId = document.querySelector("input[name='order_id']").value.trim();
            let reason = document.querySelector("textarea[name='reason']").value.trim();

            if (orderId === "" || reason === "") {
                alert("Please fill in all required fields.");
                e.preventDefault();
            }
        });
    }
});
