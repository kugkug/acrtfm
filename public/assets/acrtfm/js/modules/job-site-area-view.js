$(document).ready(function () {
    $("[data-key=Title]").on("keyup", function () {
        let title = $(this).val();
        let parentCardTitle = $(this).closest(".card-body").find(".card-title");
        $(parentCardTitle).text(title);
    });

    _init_actions();
});

function _init_actions() {
    $("[data-trigger]").off();
    $("[data-trigger]").on("click", function () {
        const trigger = $(this).data("trigger");

        switch (trigger) {
            case "edit-job-site-area":
                $("#div-job-area-view").addClass("d-none");
                $("#div-job-area-edit").removeClass("d-none");

                $("[data-key=Title]").val(
                    $("[data-key=Title]").attr("data-default")
                );
                $("[data-key=Description]").val(
                    $("[data-key=Description]").attr("data-default")
                );
                $("[data-key=Accomplishments]").val(
                    $("[data-key=Accomplishments]").attr("data-default")
                );
                break;
            case "cancel-edit-job-site-area":
                $("#div-job-area-view").removeClass("d-none");
                $("#div-job-area-edit").addClass("d-none");
                break;
            case "view-document":
                let documentUrl = $(this).attr("data-href");
                let documentTarget = $(this).attr("data-target");
                let documentId = $(this).attr("data-id");

                $("#document-iframe").attr("src", documentUrl);
                $("#document-iframe").attr("data-id", documentId);

                $(documentTarget).attr("src", documentUrl);
                break;
            case "view-image":
                let image_id = $(this).data("id");

                $("#carousel-item-" + image_id).addClass("active");
                $("#modal-images").modal("show");
                break;

            case "delete-image":
                _confirm(
                    "Delete Image",
                    "Are you sure you want to delete this image?",
                    "warning",
                    "Delete",
                    true,
                    () => _delete_image()
                );
                break;
            case "delete-document":
                let document_id = $(this).attr("data-id");
                let document_url = $(this).attr("data-url");
                _confirm(
                    "Delete Document",
                    "Are you sure you want to delete this document?",
                    "warning",
                    "Delete",
                    true,
                    () => _delete_document(document_id, document_url)
                );
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
                let files = $("#div-job-area-edit")
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
                $("#modal-files-view").modal("show");

                break;

            case "close-image":
                $("#modal-images").modal("hide");
                break;

            case "update-job-site-area":
                _update_job_site_area();
                break;
        }
    });
}

function _update_job_site_area() {
    let formData = new FormData();

    let title = $("[data-key=Title]").val();
    let description = $("[data-key=Description]").val();
    let accomplishments = $("[data-key=Accomplishments]").val();
    let subDetailsFiles = $("[data-key=SubDetailsFiles]").get(0).files;
    let images = [];

    formData.append("sub_id", $("[data-key=SubId]").val());
    formData.append("title", title);
    formData.append("description", description);
    formData.append("accomplishments", accomplishments);

    for (let i = 0; i < subDetailsFiles.length; i++) {
        formData.append(`subDetailsFiles[]`, subDetailsFiles[i]);
    }

    ajaxSubmit("/executor/job-sites/update-area", formData, "");
}

function _delete_image() {
    let carousel_images = $("#carousel-images");

    let image_id = carousel_images
        .find(".carousel-item.active")
        .attr("data-id");
    console.log(image_id);
    ajaxRequest("/executor/job-sites/delete-image", { id: image_id }, "");
}

function _delete_document(document_id, document_url) {
    ajaxRequest(
        "/executor/job-sites/delete-document",
        { id: document_id, url: document_url },
        ""
    );
}

function _delete_job_site(id) {
    ajaxRequest("/executor/job-sites/delete", { id: id }, "");
}

function _delete_job_site_area(id) {
    ajaxRequest("/executor/job-sites/delete-area", { id: id }, "");
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

    ajaxSubmit("/executor/job-sites/save", formData, "");
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

function _search_job_sites(search) {
    let card_titles = $(".card-title");

    card_titles.each(function () {
        let title = $(this).text().toLowerCase();
        if (title.includes(search.toLowerCase())) {
            $(this)
                .closest(".card-body")
                .closest(".card")
                .closest("div")
                .show();
        } else {
            $(this)
                .closest(".card-body")
                .closest(".card")
                .closest("div")
                .hide();
        }
    });
}
