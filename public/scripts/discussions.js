document.addEventListener("DOMContentLoaded", function () {
    $("[data-trigger]").off();

    $("[data-trigger=post]").on("click", function (e) {
        e.preventDefault();
        let trigger = $(this).attr("data-trigger");
        let sForm = $(this).closest("form");

        switch (trigger) {
            case "post":
                let data = _collectFields(sForm);
                data = {
                    ...data,
                    is_notification_enabled: document.getElementById(
                        "is_notification_enabled"
                    ).checked
                        ? 1
                        : 0,
                };

                if (!_checkFormFields(sForm)) {
                    toastr.error("Empty discussion is not allowed!");
                    return;
                }
                ajaxQuery("/execute/client/post", data, $(this));

                break;
        }
    });

    if ($(".div-table-data").length) {
        _fetch("/api/discussion/list", { type: "fetch" });
    }

    $(window).scroll(function () {
        if (
            $("[name=search_type]").val() !== "playlist" &&
            $(window).scrollTop() == $(document).height() - $(window).height()
        ) {
            let pageno = parseInt($("#pageno").val()) + 1;

            if (pageno <= parseInt($("#page_total").val())) {
                _fetch("/api/discussion/list?page=" + pageno, {
                    type: "paginate",
                });
            }
        }
    });
});

function confirmDelete() {
    if (confirm("Are you sure you want to end this discussion?")) return true;
    return false;
}

function _fetch(targetUrl = "", data = "") {
    ajaxQuery(targetUrl, data, "", "GET");
}

function _execWidget() {
    $("input[type=radio]").off();
    $("input[type=radio]").on("click", function (event) {
        alert("Test");
        let radio = $(this);
        let rate = $(this).val();
        let comment_id = $(this).attr("id").split("_")[1];
        let radios = $($(radio).closest(".rating")).find("input[type=radio]");
        for (const rad of radios) {
            if ($(rad).val() <= $(radio).val()) {
                $($(rad).next("label")).css("color", "#ffcc00 !important");
            } else {
                $($(rad).next("label")).css("color", "#dddddd !important");
            }
        }

        let data = {
            rate: rate,
            comment_id: comment_id,
        };

        ajaxQuery("/execute/client/rate-comment", data, $(this));
    });
}
