$(document).ready(function () {
    $("[data-trigger]").off();
    $("[data-trigger]").on("click", function (e) {
        e.preventDefault();

        let trigger = $(this).attr("data-trigger");
        let form = $(this).closest("form");
        let formData = {};
        let work_order_id = "";

        switch (trigger) {
            case "create-work-order":
                if (!_checkFormFields(form)) {
                    _show_toastr(
                        "error",
                        "Please provide all required fields",
                        "Work Order Error"
                    );
                    return;
                }
                formData = JSON.parse(_collectFields(form));
                ajaxRequest("/executor/work-orders/save", formData, "");
                break;

            case "update-work-order":
                if (!_checkFormFields(form)) {
                    _show_toastr(
                        "error",
                        "Please provide all required fields",
                        "Work Order Error"
                    );
                    return;
                }
                work_order_id = $(this).attr("data-id");
                formData = JSON.parse(_collectFields(form));
                ajaxRequest(
                    `/executor/work-orders/${work_order_id}/update`,
                    formData,
                    ""
                );
                break;

            case "delete-work-order":
                work_order_id = $(this).attr("data-id");
                _confirm(
                    "Delete Work Order?",
                    "Are you sure you want to delete this work order?\nPlease note that this action is irreversible.",
                    "warning",
                    "Yes",
                    true,
                    () => _delete("work-order", work_order_id)
                );

                break;
            case "add-photos":
                work_order_id = $(this).attr("data-id");
                $(this)
                    .closest(".card-body")
                    .find("input[type='file']")
                    .click();

                $(this)
                    .closest(".card-body")
                    .find("input[type='file']")
                    .on("change", function () {
                        let fileLength = $(this).get(0).files.length;
                        let files = $(this).get(0).files;

                        let validation = _validate_files(files);

                        if (!validation) {
                            $(this).val("");
                            return;
                        }

                        _add(trigger, work_order_id);
                    });
                break;

            case "add-note":
                work_order_id = $(this).attr("data-id");
                formData = JSON.parse(_collectFields(form));
                console.log(formData);
                ajaxRequest(
                    "/executor/work-orders/" + work_order_id + "/add-note",
                    formData,
                    ""
                );
                break;
        }
    });

    $("[data-target]").on("click", function (e) {
        e.preventDefault();

        let target = $(this).attr("data-target");
        let work_order_id = $(this).attr("data-id");

        $(".div-target").removeClass("d-none").addClass("d-none");
        $(".div-target").removeClass("d-block").addClass("d-none");

        $("#" + target).addClass("d-block");

        _fetch(target, work_order_id);
    });

    $("[data-target=card-photos]").click();
});

function _fetch(target, id) {
    let url = "";
    switch (target) {
        case "card-photos":
            url = "/executor/work-orders/" + id + "/fetch-photos";
            break;
        case "card-notes":
            url = "/executor/work-orders/" + id + "/fetch-notes";
            break;
        default:
            return;
    }

    console.log(url);

    ajaxRequest(url, "", "sub-loader");
}
function _add(type, id) {
    let url = "";
    let formData = new FormData();

    switch (type) {
        case "add-photos":
            let workOrderPhotos = $("[data-key=WorkOrderPhotos]").get(0).files;
            for (let i = 0; i < workOrderPhotos.length; i++) {
                formData.append(`workOrderPhotos[]`, workOrderPhotos[i]);
            }
            formData.append("work_order_id", id);
            ajaxSubmit("/executor/work-orders/add-photos", formData, "");
            // url = "/executor/work-orders/" + id + "/add-photos";
            break;
    }
    // ajaxRequest(url, "", "");
}

function _delete(type, id) {
    let url = "";
    switch (type) {
        case "work-order":
            url = "/executor/work-orders/" + id + "/delete";
            break;
    }
    ajaxRequest(url, "", "");
}

function _validate_files(files) {
    let invalid_images = [];
    let invalid_sizes = [];
    let valid_size = 1024 * 1024 * 25; // 25MB
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
            "Only accepts image and pdf files.\n\nThe following files are invalid: " +
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
            "Only accepts up to 25MB.\n\nThe following files are too large: " +
                invalid_sizes.join(", "),
            "warning",
            "OK",
            true,
            function () {}
        );

        return false;
    }

    return true;
}

function _init_actions() {
    $("div[data-trigger=view-image]").off();
    $("div[data-trigger=view-image]").on("click", function (e) {
        e.preventDefault();
        let data_id = $(this).attr("data-id");
        let data_url = $(this).attr("data-url");

        $("#modal-image-view")
            .find(".img-container")
            .html(
                "<img class='d-block w-100' style=' max-height: 60vh !important;'src='" +
                    data_url +
                    "' alt=''>"
            );

        $("#modal-image-view")
            .find("[data-trigger='delete-image']")
            .attr("data-id", data_id);
        $("#modal-image-view").modal("show");
    });

    $("button[data-trigger=close-image]").off();
    $("button[data-trigger=close-image]").on("click", function (e) {
        e.preventDefault();
        $("#modal-image-view").modal("hide");
    });

    $("button[data-trigger=delete-image]").off();
    $("button[data-trigger=delete-image]").on("click", function (e) {
        e.preventDefault();
        let data_id = $(this).attr("data-id");
        _confirm(
            "Delete Image",
            "Are you sure you want to delete this image?",
            "warning",
            "Delete",
            true,
            () => _delete("image", data_id)
        );
    });
}

function _delete(type, data_id) {
    switch (type) {
        case "image":
            url = "/executor/work-orders/" + data_id + "/delete-image";
            break;
    }
    ajaxRequest(url, "", "");
}
