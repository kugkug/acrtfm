$(document).ready(function () {
    $("[data-key=Title]").on("keyup", function () {
        let title = $(this).val();
        let parentCardTitle = $(this).closest(".card-body").find(".card-title");
        $(parentCardTitle).text(title);
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
            case "add-file":
                $(this)
                    .closest(".card-sub-details")
                    .find("input[type='file']")
                    .click();
                $(this)
                    .closest(".card-sub-details")
                    .find("input[type='file']")
                    .on("change", function () {
                        let fileLength = $(this).get(0).files.length;
                        let files = $(this).get(0).files;

                        $(this)
                            .closest(".card-sub-details")
                            .find("span")
                            .text(fileLength);
                    });
                break;
            case "view-images":
                let images = $(this)
                    .closest(".card-sub-details")
                    .find("input[type='file']")
                    .get(0).files;

                let carousel = $("#carouselExampleIndicators");
                carousel.find(".carousel-inner").empty();
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
                break;
            case "delete-job-site":
                let sub_id = $(this).attr("data-sub-id");
                _confirm(
                    "Delete Job Site",
                    "Are you sure you want to delete this job site?",
                    "warning",
                    "Delete",
                    true,
                    () => _delete_job_site(sub_id)
                );
                break;
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

function _delete_job_site(sub_id) {
    ajaxRequest("/executor/job-sites/" + sub_id + "/delete", {}, "");
}

function _save_job() {
    let formData = new FormData();
    let subDetailsCard = $(".card-sub-details");
    let image_cntr = 0;

    formData.append("sub_id", $("[data-key=SubId]").val());

    subDetailsCard.each(function () {
        let subDetailsName = $(this).find("[data-key=SubDetailsName]").val();
        let subDetailsDescription = $(this)
            .find("[data-key=SubDetailsDescription]")
            .val();
        let subDetailsAccomplishments = $(this)
            .find("[data-key=SubDetailsAccomplishments]")
            .val();
        let subDetailsImages = $(this)
            .find("[data-key=SubDetailsImages]")
            .get(0).files;

        formData.append("subDetailsName[]", subDetailsName);
        formData.append("subDetailsDescription[]", subDetailsDescription);
        formData.append(
            "subDetailsAccomplishments[]",
            subDetailsAccomplishments
        );

        let images = [];
        for (let i = 0; i < subDetailsImages.length; i++) {
            formData.append(
                `subDetailsImages_${image_cntr}[]`,
                subDetailsImages[i]
            );
        }

        image_cntr++;
    });

    ajaxSubmit("/executor/accomplishments/save", formData, "");
}
