$(document).ready(function () {
    _fetch({
        search_type: "",
        search_text: "",
    });

    $("select[data-key='search_type']").change(function () {
        var search_type = $(this).val();
        if (search_type == "") {
            $("[class*='search-container-']")
                .removeClass("d-none")
                .addClass("d-none");
            return;
        }

        $("[class*='search-container-']")
            .removeClass("d-none")
            .addClass("d-none");
        $(".search-container-" + search_type).removeClass("d-none");
    });

    $(".search-select").on("change", function () {
        let search_type = $("select[data-key='search_type']").val();
        _fetch({
            search_type: search_type,
            search_text: $(".search-container-" + search_type).val(),
        });
    });

    $(".search-text").on("keyup", function () {
        let search_type = $("select[data-key='search_type']").val();
        _fetch({
            search_type: search_type,
            search_text: $(
                ".search-container-" + search_type + " .search-text"
            ).val(),
        });
    });

    $(window).scroll(function () {
        if (
            $("select[data-key='search_type']").val() !== "playlist" &&
            $(window).scrollTop() == $(document).height() - $(window).height()
        ) {
            let search_type = $("select[data-key='search_type']").val();
            let search_text = $(".search-container-" + search_type).val();

            let next_page = parseInt($("#next_page").val());
            let page_total = parseInt($("#page_total").val());

            console.log(next_page, page_total);

            if (next_page <= page_total) {
                ajaxRequest(
                    "/executor/education/paginate",
                    {
                        page: next_page,
                        page_total: parseInt($("#page_total").val()),
                        search_type: search_type,
                        search_text: search_text,
                    },
                    "sub-loader"
                );
            }
        }
    });
});

function _fetch(formData) {
    ajaxRequest("executor/education/search", formData, "sub-loader");
}

function _init_actions() {
    $(".btn-paylist").off();
    $(".btn-paylist").on("click", function () {
        let watch_link = $(this).attr("data-src");
        let title = $(this).attr("data-title");

        $("#educationPlayer").attr("src", watch_link);
        // $("#videoTitle").text(title);
        $("#educationModal").modal("show");

        $("#educationModal").on("hidden.bs.modal", function () {
            $("#educationPlayer").attr("src", "");
        });
        // console.log(watch_link);
    });
}
