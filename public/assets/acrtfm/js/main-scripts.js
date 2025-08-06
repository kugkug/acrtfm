$(document).ready(function () {
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
                        $(sElement).addClass(" is-invalid ");
                        nEmpty++;
                    } else {
                        $(sElement).removeClass(" is-invalid ");
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

function _validate_files(type, files) {
    switch (type) {
        case "image":
            let invalid_images = [];
            let invalid_sizes = [];
            let valid_size = 1024 * 1024 * 5; // 5MB
            let valid_ext = [
                "jpg",
                "jpeg",
                "png",
                "gif",
                "bmp",
                "webp",
                "pdf",
                "JPG",
                "JPEG",
                "PNG",
                "GIF",
                "BMP",
                "WEBP",
                "PDF",
            ];

            for (const file of files) {
                let size = file.size;
                let type = file.type;
                let name = file.name;
                let ext = name.split(".").pop();

                if (!valid_ext.includes(ext)) {
                    invalid_images.push(name);
                }

                if (size > valid_size) {
                    invalid_sizes.push(name);
                }
            }

            if (invalid_images.length > 0) {
                _confirm(
                    "Invalid Files",
                    "The following files are invalid: " +
                        invalid_images.join(", "),
                    "warning",
                    "OK",
                    true,
                    function () {}
                );

                return false;
            }

            if (invalid_sizes.length > 0) {
                _confirm(
                    "Invalid Sizes",
                    "The following files are too large: " +
                        invalid_sizes.join(", "),
                    "warning",
                    "OK",
                    true,
                    function () {}
                );

                return false;
            }

            break;
        case "document":
            let invalid_documents = [];
            let invalid_document_sizes = [];
            let valid_document_size = 1024 * 1024 * 10; // 10MB
            let valid_document_ext = [
                "pdf",
                "PDF",
                "doc",
                "DOC",
                "docx",
                "DOCX",
                "xls",
                "XLS",
                "xlsx",
                "XLSX",
                "ppt",
                "PPT",
                "pptx",
                "PPTX",
            ];
            for (const file of files) {
                let size = file.size;
                let type = file.type;
                let name = file.name;
                let ext = name.split(".").pop();

                if (!valid_document_ext.includes(ext)) {
                    invalid_documents.push(name);
                }

                if (size > valid_document_size) {
                    invalid_document_sizes.push(name);
                }
            }

            if (invalid_documents.length > 0) {
                _confirm(
                    "Invalid Files",
                    "The following files are invalid: " +
                        invalid_documents.join(", "),
                    "warning",
                    "OK",
                    true,
                    function () {}
                );

                return false;
            }

            if (invalid_document_sizes.length > 0) {
                _confirm(
                    "Invalid Sizes",
                    "The following files are too large: " +
                        invalid_document_sizes.join(", "),
                    "warning",
                    "OK",
                    true,
                    function () {}
                );

                return false;
            }

            break;
    }

    return true;
}
