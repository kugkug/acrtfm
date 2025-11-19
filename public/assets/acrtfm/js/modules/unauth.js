$(document).ready(function () {
    // Password toggle functionality
    // $(".password-toggle-btn").on("click", function (e) {
    //     e.preventDefault();
    //     var passwordInput = $(this)
    //         .closest(".password-input-wrapper")
    //         .find("input");
    //     var icon = $(this).find("i");

    //     if ($(passwordInput).attr("type") === "password") {
    //         // passwordInput.attr("type", "text");
    //         icon.removeClass("fa-eye").addClass("fa-eye-slash");
    //     } else {
    //         // passwordInput.attr("type", "password");
    //         icon.removeClass("fa-eye-slash").addClass("fa-eye");
    //     }
    // });

    $("[data-trigger]").off();

    $("[data-trigger]").on("click", function (e) {
        e.preventDefault();
        let trigger = $(this).attr("data-trigger");
        let form = $(this).closest("form");
        let formData = {};

        switch (trigger) {
            case "sign-up-submit-company":
                if (!_checkFormFields(form)) {
                    _show_toastr(
                        "error",
                        "Please fill all fields",
                        "User Error"
                    );
                    return;
                }

                formData = JSON.parse(_collectFields(form));
                ajaxRequest(
                    "/executor/account/company-registration",
                    formData,
                    ""
                );

                break;

            case "sign-up-submit-technician":
                if (!_checkFormFields(form)) {
                    _show_toastr(
                        "error",
                        "Please fill all fields",
                        "User Error"
                    );
                    return;
                }

                formData = JSON.parse(_collectFields(form));
                ajaxRequest(
                    "/executor/account/technician-registration",
                    formData,
                    ""
                );

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
