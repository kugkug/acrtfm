$(document).ready(function () {
    // Password toggle functionality (global)
    $(document).on("click", ".password-toggle-btn", function (e) {
        e.preventDefault();
        var passwordInput = $(this)
            .closest(".password-input-wrapper")
            .find("input");
        var icon = $(this).find("i");

        if (passwordInput.attr("type") === "password") {
            passwordInput.attr("type", "text");
            icon.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            passwordInput.attr("type", "password");
            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    $('[data-action="toggle-theme"]').on("click", function () {
        let icon = $(this).find("i");
        let theme = "";
        if (icon.hasClass("fa-moon")) {
            icon.removeClass("fa-moon").removeClass("text-secondary");
            icon.addClass("fa-sun").addClass("text-warning");
            theme = "dark";
        } else {
            icon.removeClass("fa-sun").removeClass("text-warning");
            icon.addClass("fa-moon").addClass("text-secondary");
            theme = "light";
        }

        ajaxRequest(
            "/executor/settings/toggle-theme",
            {
                Theme: theme,
            },
            ""
        );
    });
    $('[data-action="logout"]').on("click", function () {
        console.log("logout");
        ajaxRequest("/executor/account/logout", "", "");
    });
});

function ajaxRequest(sUrl = "", sData = "", sLoadParent = "") {
    $.ajax({
        url: sUrl,
        type: "POST",
        headers: { "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content") },
        data: sData,
        beforeSend: function () {
            if (sLoadParent != "" && sLoadParent == "sub-loader") {
                $("#sub-loader").fadeIn(200);
            } else {
                $("#full-loader").fadeIn(200);
            }
        },
        success: function (result) {
            console.log(result);
            if (sLoadParent != "" && sLoadParent == "sub-loader") {
                $("#sub-loader").fadeOut(200);
            } else {
                $("#full-loader").fadeOut(500);
            }
            eval(result.js);
        },
        error: function (e) {
            if (sLoadParent != "" && sLoadParent == "sub-loader") {
                $("#sub-loader").fadeOut(200);
            } else {
                $("#full-loader").fadeOut(500);
            }
            console.log(e);

            scrollToTop();
            _show_toastr(
                "error",
                "Please call system administrator!",
                "System Error"
            );
        },
    });
}

function ajaxSubmit(sUrl = "", sFormData = "", sLoadParent = "") {
    $.ajax({
        url: sUrl,
        type: "POST",
        headers: { "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content") },
        data: sFormData,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function () {
            if (sLoadParent != "" && sLoadParent == "sub-loader") {
                $("#sub-loader").fadeIn(200);
            } else {
                $("#full-loader").fadeIn(200);
            }
        },
        success: function (result) {
            console.log(result);
            if (sLoadParent != "" && sLoadParent == "sub-loader") {
                $("#sub-loader").fadeOut(200);
            } else {
                $("#full-loader").fadeOut(500);
            }
            eval(result.js);
        },
        error: function (e) {
            if (sLoadParent != "" && sLoadParent == "sub-loader") {
                $("#sub-loader").fadeOut(200);
            } else {
                $("#full-loader").fadeOut(500);
            }
            console.log(e);

            _show_toastr(
                "error",
                "Please call system administrator!",
                "System Error"
            );
        },
    });
}

function _checkFormFields(parentForm) {
    var nCnt = 0;
    var nEmpty = 0;
    var aElements = $(parentForm).find("input, textarea, select");

    for (nCnt = 0; nCnt < aElements.length; nCnt++) {
        var sElement = aElements[nCnt];
        var sValue = $(sElement).val();
        var sData = $(sElement).attr("data");

        if ($(sElement).is(":visible")) {
            if (sData != "exclude") {
                if (sData == "req") {
                    if (sValue == "") {
                        $(sElement).next("div.invalid-feedback").show();
                        nEmpty++;
                    } else {
                        $(sElement).next("div.invalid-feedback").hide();
                    }
                }
            }
        }
    }

    if (nEmpty > 0) return false;
    else return true;
}

function _collectFields(parentForm) {
    var sJsonFields = {};
    var nCnt = 0;
    var nEmpty = 0;
    var aElements = $(parentForm).find(
        "input:not(:checkbox):not(:radio), textarea, select"
    );

    for (nCnt = 0; nCnt < aElements.length; nCnt++) {
        var sElement = aElements[nCnt];

        var sDataKey = $(sElement).attr("data-key");
        var sValue = $(sElement).val();

        if ($(sElement).is(":visible") === true) {
            if (sDataKey) {
                sJsonFields[sDataKey] = sValue;
            }
        }
    }

    return JSON.stringify(sJsonFields);
}

function _applyTheme(sTheme) {
    if (sTheme == "dark") {
        new quixSettings({
            version: "dark",
            layout: "vertical",
            navheaderBg: "color_2",
            headerBg: "color_2",
            sidebarBg: "color_2",
        });
    } else {
        new quixSettings({
            version: "light",
            layout: "vertical",
            navheaderBg: "color_1",
            headerBg: "color_1",
            sidebarBg: "color_1",
        });
    }
}

function _confirm(
    title,
    text,
    type,
    confirmButtonText,
    closeOnConfirm,
    funcCallback
) {
    swal(
        {
            title: title,
            text: text,
            type: type,
            showCancelButton: !0,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: confirmButtonText,
            closeOnConfirm: closeOnConfirm,
        },
        function () {
            funcCallback();
        }
    );
}

function scrollToTop() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
}
