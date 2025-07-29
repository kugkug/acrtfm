$(document).ready(function () {
    $("[data-trigger]").off();
    $("[data-trigger]").on("click", function () {
        const trigger = $(this).data("trigger");

        switch (trigger) {
            case "add-area":
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
        }
    });
});

function _init_actions() {
    $("[data-trigger='remove-area']").off();
    $("[data-trigger='remove-area']").on("click", function () {
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
