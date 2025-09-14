$(document).ready(function () {
    $("[data-trigger]").off();

    $("[data-trigger]").on("click", function (e) {
        e.preventDefault();
        let trigger = $(this).attr("data-trigger");
        let form = $(this).closest("form");
        let formData = {};
        switch (trigger) {
            case "save-customer":
                if (!_checkFormFields(form)) {
                    _show_toastr(
                        "error",
                        "Please provide all required fields",
                        "Customer Error"
                    );
                    return;
                }

                formData = JSON.parse(_collectFields(form));

                ajaxRequest("/executor/customers/save", formData, "");
                break;
            case "cancel-customer":
                location.href = "/customers";
                break;
        }
    });
});
