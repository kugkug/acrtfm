function _checkFormFields(frmId = "") {
    var nCnt = 0;
    var nEmpty = 0;
    var aElements = $(frmId).find("input, textarea, select");

    for (nCnt = 0; nCnt < aElements.length; nCnt++) {
        var sElement = aElements[nCnt];
        var sValue = $(sElement).val();
        var sData = $(sElement).attr("data");

        if ($(sElement).is(":visible")) {
            if (sData != "exclude") {
                if (sData == "req") {
                    if (sValue.trim() == "") {
                        $(sElement).addClass(" has-error ");
                        nEmpty++;
                    } else {
                        $(sElement).removeClass(" has-error ");
                    }
                }
            }
        }
    }

    if (nEmpty > 0) {
        return false;
    } else {
        return true;
    }
}

function _collectFields(vFormId) {
    var sJsonFields = {};
    var nCnt = 0;
    var nEmpty = 0;
    var aElements = $(vFormId).find(
        "input:not(:checkbox):not(:radio), textarea, select"
    );

    for (nCnt = 0; nCnt < aElements.length; nCnt++) {
        var sElement = aElements[nCnt];

        var sDataKey = $(sElement).attr("data-key");
        var sValue = $(sElement).val();

        // if ($(sElement).is(":visible") === true) {
        //     if (sDataKey) {
        sJsonFields[sDataKey] = sValue;
        // }
        // }
    }

    return sJsonFields;
}

function _clearFields() {
    var nCnt = 0;
    var nEmpty = 0;
    var aElements = $("form").find("input, textarea, select");

    for (nCnt = 0; nCnt < aElements.length; nCnt++) {
        var sElement = aElements[nCnt];

        $(sElement).removeClass(" has-error ");
        $(sElement).val("");
    }
}

// function ajaxRequest(sUrl = "", sData = "", sLoadParent = "") {
//     $.ajax({
//         url: sUrl,
//         type: "POST",
//         headers: { "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content") },
//         data: sData,
//         beforeSend: function () {
//             $(".div-loader").show();
//         },
//         success: function (result) {
//             $(".div-loader").hide();
//             console.log(result);
//             eval(result.js);
//         },
//         error: function (e) {
//             $(".div-loader").hide();
//             _confirm(
//                 "alert",
//                 "Cannot continue, please call system administrator!"
//             );
//         },
//     });
// }

function ajaxQuery(sUrl = "", sData = "", sLoadParent = "", sType = "POST") {
    $.ajax({
        url: sUrl,
        type: sType,
        headers: { "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content") },
        data: sData,
        beforeSend: function () {
            if (sLoadParent != "none") {
                $("body").css({ "pointer-events": "none" });
            }
            if (sLoadParent != "") {
                $(sLoadParent).append(
                    '<div class="spinner-border spinner-border-sm text-primary" role="status"> <span class="sr-only">Loading...</span> </div>'
                );
            } else {
                $("#div-overlay").show();
            }
        },
        success: function (result) {
            console.log(result);
            $("body").css({ "pointer-events": "" });
            if (sLoadParent != "") {
                $(sLoadParent).parent().find(".spinner-border").remove();
            } else {
                $("#div-overlay").hide();
            }

            eval(result);
        },
        error: function (e) {
            console.log(e.responseText);
            $("body").css({ "pointer-events": "" });
            $(sLoadParent).parent().find(".spinner-border").remove();

            $("#div-overlay").hide();

            toastr.error("Failed to complete the process!");
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
            if (sLoadParent != "none") {
                $("body").css({ "pointer-events": "none" });
            }
            if (sLoadParent != "") {
                $(sLoadParent).append(
                    '<div class="spinner-border spinner-border-sm text-primary" role="status"> <span class="sr-only">Loading...</span> </div>'
                );
            } else {
                $("#div-overlay").show();
            }
        },
        success: function (result) {
            console.log(result);
            $("body").css({ "pointer-events": "" });
            if (sLoadParent != "") {
                $(sLoadParent).parent().find(".spinner-border").remove();
            } else {
                $("#div-overlay").hide();
            }

            eval(result.message);
        },
        error: function (e) {
            console.log(e.responseText);
            let response = JSON.parse(e.responseText);
            if (response.message) {
                toastr.error(response.message);
                return;
            }

            $("body").css({ "pointer-events": "" });
            $(sLoadParent).parent().find(".spinner-border").remove();

            $("#div-overlay").hide();
            toastr.error("Failed to complete the process!");
        },
    });
}

function _systemAlert(type = "", msg = "") {
    switch (type) {
        case "empty":
            var sTitle = "System Alert";
            var sMessage =
                "Cannot continue, Please complete the required fields.";
            break;

        case "email":
            var sTitle = "System Alert";
            var sMessage = "Cannot continue, Invalid Email Address.";
            break;

        case "system":
        case "server":
            var sTitle = "System Alert";
            var sMessage =
                "Cannot continue, Please call your system administrator.";
            break;

        case "error":
            var sTitle = "System Alert";
            var sMessage = msg;
            break;

        default:
            var sTitle = "System Alert";
            var sMessage = type;
            break;
    }

    $.alert({
        title: sTitle,
        icon: "fa fa-exclamation",
        type: "red",
        content: sMessage,
    });
}

function _refresh() {
    location.reload();
}
