document.addEventListener("DOMContentLoaded", function () {
    let deleteButtons = document.querySelectorAll(".button-danger");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function (e) {
            if (!confirm("Are you sure you want to delete this RMA request?")) {
                e.preventDefault();
            }
        });
    });
});
