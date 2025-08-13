$(document).ready(function () {
    $("[data-key=Title]").on("keyup", function () {
        let title = $(this).val();
        let parentCardTitle = $(this).closest(".card-body").find(".card-title");
        $(parentCardTitle).text(title);
    });

    _fetch_accomplishments();
    _init_actions();
});

function _fetch_accomplishments() {
    ajaxRequest("/executor/accomplishments/fetch", {}, "");
}

function _init_actions() {
    $("[data-key=SubDetailsName]").on("keyup", function () {
        let subDetailsName = $(this).val();
        let parentCardTitle = $(this).closest(".card-body").find(".card-title");
        $(parentCardTitle).text(subDetailsName);
    });

    $("[data-trigger]").off();
    $("[data-trigger]").on("click", function () {
        const trigger = $(this).data("trigger");

        switch (trigger) {
            case "add-accomplishment":
                let parentCard =
                    $(".area-main-card").closest(".main-container");
                let mainArea = $(".area-main-card");
                let newArea = mainArea.clone();
                newArea.removeClass("area-main-card");
                newArea.find("span").text();
                newArea.find("input").val("");
                newArea.find("textarea").val("");
                newArea.find("input[type='file']").val("");
                newArea.find(".card-title").text("");
                newArea.find(".card-body div:first-child()").append(
                    `<button class="btn btn-danger btn-flat" data-trigger="remove-area">
                        <i class="fa fa-trash"></i> Remove
                    </button>`
                );
                parentCard.append(newArea);

                _init_actions();
                break;
            case "add-files":
                $(this)
                    .closest(".form-group")
                    .find("input[type='file']")
                    .click();
                $(this)
                    .closest(".form-group")
                    .find("input[type='file']")
                    .on("change", function () {
                        let fileLength = $(this).get(0).files.length;
                        let files = $(this).get(0).files;

                        let validation = _validate_files(files);

                        if (!validation) {
                            $(this).val("");
                            $(this).closest(".form-group").find("span").text(0);
                            return;
                        }

                        $(this)
                            .closest(".form-group")
                            .find("span")
                            .text(fileLength);
                    });
                break;
            case "view-files":
                let files = $(this)
                    .closest(".card-sub-details")
                    .find("input[type='file']")
                    .get(0).files;

                if (files.length === 0) {
                    return;
                }

                let carousel = $("#image-carousel");
                let carousel_document = $("#document-carousel");
                carousel.find(".carousel-inner").empty();
                carousel_document.find(".carousel-inner").empty();

                let images = [];
                let documents = [];

                for (let i = 0; i < files.length; i++) {
                    let image = files[i];

                    if (image.type.includes("image")) {
                        images.push(image);
                    } else {
                        documents.push(image);
                    }
                }

                for (let i = 0; i < images.length; i++) {
                    let image = images[i];
                    let imageUrl = URL.createObjectURL(image);
                    carousel.find(".carousel-inner")
                        .append(`<div class="carousel-item ${
                        i === 0 ? "active" : ""
                    }">
                        <img class="d-block w-100" style=' max-height: 60vh !important;' src="${imageUrl}" alt="Image ${
                        i + 1
                    }">
                    </div>`);
                }

                for (let i = 0; i < documents.length; i++) {
                    let document = documents[i];
                    let documentUrl = URL.createObjectURL(document);
                    $("#document-list").append(
                        `<a href="${documentUrl}" target="_blank" class="text-info list-group-item list-group-item-action">${document.name}</a>`
                    );
                    carousel_document.find(".carousel-inner")
                        .append(`<div class="carousel-item ${
                        i === 0 ? "active" : ""
                    }">
                     <iframe src="${documentUrl}" type="application/pdf" class="d-block w-100" style='width: 100% !important; height: 50vh !important;'></iframe> 
                    </div>`);
                }
                $("#modal-images").modal("show");

                break;
            case "remove-area":
                let area = $(this).closest(".card-sub-details");
                _confirm(
                    "Remove Area",
                    "Are you sure you want to remove this area?",
                    "warning",
                    "Remove",
                    true,
                    function () {
                        area.remove();
                    }
                );
                break;
            case "save":
                _save_job();
                break;
            case "delete-accomplishment":
                let id = $(this).attr("data-id");
                let parent = $(this).attr("data-parent");
                _confirm(
                    "Delete Accomplishment",
                    "Are you sure you want to delete this accomplishment?",
                    "warning",
                    "Delete",
                    true,
                    () => _delete_accomplishment(id, parent)
                );
        }
    });
}

function _delete_accomplishment(id, parent) {
    ajaxRequest(
        "/executor/accomplishments/delete",
        { id: id, parent: parent },
        ""
    );
}

function _save_job() {
    let formData = new FormData();
    let subDetailsCard = $(".card-sub-details");
    let file_cntr = 0;

    formData.append("title", $("[data-key=Title]").val());
    formData.append("description", $("[data-key=Description]").val());

    subDetailsCard.each(function () {
        let subDetailsName = $(this).find("[data-key=SubDetailsName]").val();
        let subDetailsDescription = $(this)
            .find("[data-key=SubDetailsDescription]")
            .val();
        let subDetailsAccomplishments = $(this)
            .find("[data-key=SubDetailsAccomplishments]")
            .val();
        let subDetailsFiles = $(this)
            .find("[data-key=SubDetailsFiles]")
            .get(0).files;

        formData.append("subDetailsName[]", subDetailsName);
        formData.append("subDetailsDescription[]", subDetailsDescription);
        formData.append(
            "subDetailsAccomplishments[]",
            subDetailsAccomplishments
        );

        let images = [];
        for (let i = 0; i < subDetailsFiles.length; i++) {
            formData.append(
                `subDetailsFiles_${file_cntr}[]`,
                subDetailsFiles[i]
            );
        }

        file_cntr++;
    });

    ajaxSubmit("/executor/accomplishments/save", formData, "");
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
