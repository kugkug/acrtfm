$(document).ready(function () {
    $("[data-key=Title]").on("keyup", function () {
        let title = $(this).val();
        let parentCardTitle = $(this).closest(".card-body").find(".card-title");
        $(parentCardTitle).text(title);
    });

    $("[data-key=JobArea").on("keyup", function () {
        let job_area_title = $(this).val();
        console.log(job_area_title);
        _search_job_site_areas(job_area_title);
    });
    _init_actions();
});

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
            case "add-job-site":
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

                newArea.find(".card-body div.div-header").append(
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

            case "delete-job-site":
                let id = $(this).attr("data-id");
                _confirm(
                    "Delete Job Site",
                    "Are you sure you want to delete this job site?",
                    "warning",
                    "Delete",
                    true,
                    () => _delete_job_site(id)
                );
                break;
            case "delete-job-site-area":
                let area_id = $(this).attr("data-id");
                let title = $(this).attr("data-title");
                let site_id = $(this).attr("data-site-id");

                _confirm(
                    "Delete Job Site Area",
                    "Are you sure you want to delete " + title + "?",
                    "warning",
                    "Delete",
                    true,
                    () => _delete_job_site_area(area_id, site_id)
                );
                break;

            case "edit-job-site-area":
                $("#div-job-site-area-view").addClass("d-none");
                $("#div-job-site-area-edit").removeClass("d-none");

                $("[data-key=Title]").val(
                    $("[data-key=Title]").attr("data-default")
                );
                $("[data-key=Description]").val(
                    $("[data-key=Description]").attr("data-default")
                );
                break;
            case "cancel-edit-job-site-area":
                $("#div-job-site-area-view").removeClass("d-none");
                $("#div-job-site-area-edit").addClass("d-none");
                break;
            case "save-job-site-area":
                let area_data_id = $(this).attr("data-id");
                let new_title = $("[data-key=Title]").val();
                let new_description = $("[data-key=Description]").val();

                _save_job_site_area(area_data_id, new_title, new_description);
                break;
        }
    });
}

function _save_job_site_area(area_data_id, new_title, new_description) {
    ajaxRequest(
        "/executor/job-sites/update",
        {
            id: area_data_id,
            title: new_title,
            description: new_description,
        },
        ""
    );
}
function _delete_job_site(id) {
    ajaxRequest("/executor/job-sites/delete", { id: id }, "");
}

function _delete_job_site_area(id, site_id) {
    ajaxRequest(
        "/executor/job-sites/delete-area",
        { id: id, site_id: site_id },
        ""
    );
}
function _save_job() {
    let formData = new FormData();
    let subDetailsCard = $(".card-sub-details");
    let file_cntr = 0;

    formData.append("sub_id", $("[data-key=SiteId]").val());

    subDetailsCard.each(function () {
        let subDetailsName = $(this).find("[data-key=SubDetailsName]").val();
        let subDetailsDescription = $(this)
            .find("[data-key=SubDetailsDescription]")
            .val();
        let subDetailsAccomplishments = $(this)
            .find("[data-key=SubDetailsAccomplishments]")
            .val();
        let subDetailsAccomplishmentDate = $(this)
            .find("[data-key=SubDetailsAccomplishmentDate]")
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
        formData.append(
            "subDetailsAccomplishmentDates[]",
            subDetailsAccomplishmentDate
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

function _search_job_site_areas(search) {
    let card_titles = $(".card-title");

    card_titles.each(function () {
        let title = $(this).text().toLowerCase();
        if (title.includes(search.toLowerCase())) {
            $(this)
                .closest(".card-header")
                .closest(".card")
                .closest("div")
                .show();
        } else {
            $(this)
                .closest(".card-header")
                .closest(".card")
                .closest("div")
                .hide();
        }
    });
}
