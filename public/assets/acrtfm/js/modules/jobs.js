$(document).ready(function () {
    $("[data-key=Title]").on("keyup", function () {
        let title = $(this).val();
        let parentCardTitle = $(this).closest(".card-body").find(".card-title");
        $(parentCardTitle).text(title);
    });

    _fetch_jobs();
    _init_actions();
});

function _fetch_jobs() {
    ajax("/executor/jobs/fetch", {}, "jobs-list", "");
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
        }
    });
}

function _save_job() {
    let formData = new FormData();
    let subDetailsCard = $(".card-sub-details");
    let image_cntr = 0;

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

    ajaxSubmit("/executor/jobs/save", formData, "");
}
