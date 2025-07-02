$(document).ready(function () {
    $("#chkTnc").on("click", function () {
        let hvac = $("#chkHvac").is(":checked");
        let tnc = $(this).is(":checked");

        if (tnc && hvac) {
            $("#btn-register").attr("disabled", false);
        } else {
            $("#btn-register").attr("disabled", true);
        }
    });

    $("#chkHvac").on("click", function () {
        let tnc = $("#chkTnc").is(":checked");
        let hvac = $(this).is(":checked");

        if (tnc && hvac) {
            $("#btn-register").attr("disabled", false);
        } else {
            $("#btn-register").attr("disabled", true);
        }
    });

    $(".spn-link").on("click", function () {
        let eye = $(this);
        let parent = $(this).closest("div.input-group");
        let input = $(parent).find("input")[0];

        if (eye.hasClass("fa-eye")) {
            $(input).attr("type", "text");

            eye.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            $(input).attr("type", "password");

            eye.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
});
