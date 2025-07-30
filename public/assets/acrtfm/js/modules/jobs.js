$(document).ready(function () {
    $("[data-key=Title]").on("keyup", function () {
        let title = $(this).val();
        $(".span-title").text(title);
        $("[data-trigger=add-accomplishment] span").text(title);
    });
    _init_actions();
});

function _init_actions() {
    $("[data-trigger]").off();
    $("[data-trigger]").on("click", function () {
        const trigger = $(this).data("trigger");

        switch (trigger) {
            case "add-accomplishment":
                let mainArea = $(".area-main-card");
                let newArea = mainArea.clone();
                newArea.removeClass("area-main-card");
                newArea.find("span").text();
                newArea.find("input").val("");
                newArea.find("textarea").val("");
                newArea.find("input[type='file']").val("");
                newArea.find(".card-body div:first-child()").append(
                    `<button class="btn btn-danger btn-flat" data-trigger="remove-area">
                        <i class="fa fa-trash"></i> Remove
                    </button>`
                );
                mainArea.after(newArea);
                updateAreaCount();
                _init_actions();
                break;
            case "add-file":
                $(this)
                    .closest(".card-area")
                    .find("input[type='file']")
                    .click();
                $(this)
                    .closest(".card-area")
                    .find("input[type='file']")
                    .on("change", function () {
                        let fileLength = $(this).get(0).files.length;
                        let files = $(this).get(0).files;

                        $(this)
                            .closest(".card-area")
                            .find("span")
                            .text(fileLength);
                    });
                break;
            case "view-images":
                let images = $(this)
                    .closest(".card-area")
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
                let area = $(this).closest(".card-area");
                _confirm(
                    "Remove Area",
                    "Are you sure you want to remove this area?",
                    "warning",
                    "Remove",
                    true,
                    function () {
                        area.remove();
                        updateAreaCount();
                    }
                );
                break;
        }
    });
}

function updateAreaCount() {
    let areaCards = $(".card-area");
    let areaCount = areaCards.length;
    for (let i = 0; i < areaCount; i++) {
        areaCards
            .eq(i)
            .find("span")
            .text(i + 1);
    }
}
