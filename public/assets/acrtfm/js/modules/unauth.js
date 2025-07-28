$(document).ready(function () {
    $("[data-trigger]").off();

    $("[data-trigger]").on("click", function (e) {
        e.preventDefault();
        let trigger = $(this).attr("data-trigger");
        let form = $(this).closest("form");
        let formData = {};

        switch (trigger) {
            case "sign-up-submit":
                if (!_checkFormFields(form)) {
                    _show_toastr(
                        "error",
                        "Please fill all fields",
                        "User Error"
                    );
                    return;
                }

                formData = JSON.parse(_collectFields(form));
                ajaxRequest("/executor/account/registration", formData, "");

                break;

            case "login-submit":
                if (!_checkFormFields(form)) {
                    _show_toastr(
                        "error",
                        "Please fill all fields",
                        "User Error"
                    );
                }

                formData = JSON.parse(_collectFields(form));
                ajaxRequest("/executor/account/login", formData, "");

                break;
        }
    });
});
