var player;
let next_trigger;
document.addEventListener("DOMContentLoaded", function () {
    $("[name=search_type]").on("change", function () {
        let searchby = $(this).val();

        if (searchby == "category") {
            $("[name=category_name]").removeClass("d-none");
            $("[name=presentor_name]").addClass("d-none");
            $("#div-keyword").addClass("d-none");
            $("[name=playlist_name]").addClass("d-none");
        } else if (searchby == "presentor") {
            $("[name=category_name]").addClass("d-none");
            $("[name=presentor_name]").removeClass("d-none");
            $("#div-keyword").addClass("d-none");
            $("[name=playlist_name]").addClass("d-none");
        } else if (searchby == "playlist") {
            $("[name=presentor_name]").addClass("d-none");
            $("[name=category_name]").addClass("d-none");
            $("#div-keyword").addClass("d-none");
            $("[name=playlist_name]").removeClass("d-none");
        } else if (searchby == "keyword") {
            $("[name=presentor_name]").addClass("d-none");
            $("[name=category_name]").addClass("d-none");
            $("[name=playlist_name]").addClass("d-none");
            $("#div-keyword").removeClass("d-none");
            $("[name=keyword]").val("");
            $("[name=keyword]").focus();
        } else {
            $("[name=category_name]").addClass("d-none");
            $("[name=presentor_name]").addClass("d-none");
            $("[name=playlist_name]").addClass("d-none");
            $("#div-keyword").addClass("d-none");

            _fetch("/api/education/list", { type: "fetch" });
        }
    });

    if ($(".div-table-data").length) {
        _fetch("/api/education/list", { type: "fetch" });
    }

    $(window).scroll(function () {
        if (
            $("[name=search_type]").val() !== "playlist" &&
            $(window).scrollTop() == $(document).height() - $(window).height()
        ) {
            let search_text = "";
            let pageno = parseInt($("#pageno").val()) + 1;

            if (pageno <= parseInt($("#page_total").val())) {
                _fetch("/api/education/list?page=" + pageno, {
                    type: "paginate",
                    search_by: $("[name=search_type]").val(),
                    search_text: search_text,
                });
            }
        }
    });

    $("[name=category_name], [name=presentor_name], [name=playlist_name]").on(
        "change",
        function () {
            if ($("[name=" + $(this).attr("name") + "]").val() != "") {
                let data = {
                    type: "fetch",
                    search_by: $(this).attr("name"),
                    search_text: $("[name=" + $(this).attr("name") + "]").val(),
                };
                _fetch("/api/education/list", data);
            }
        }
    );

    $("#btn-search").on("click", function () {
        _fetch("/api/education/list", {
            search_by: "keyword",
            search_text: $("[name=keyword]").val(),
        });
    });
});

function _fetch(targetUrl = "", data = "") {
    ajaxQuery(targetUrl, data, "", "GET");
}

function _execWidget() {
    $(".btn-iframe").off();
    $(".btn-iframe").on("click", function () {
        let parentDiv = $(this).closest(".card");
        let title = $($(parentDiv).find(".card-header")[0]).text();
        let link = $(this).attr("data-link");
        let share_link = $(this).attr("data-share");

        $("#modelModal").off();
        $(".modal-title").text(title.trim());
        $("#modal-body iframe").attr("src", link);
        $(".modal-footer [data-share]").attr("data-share", share_link);

        $("#modelModal").modal("show");

        $("#modelModal").on("hidden.bs.modal", function (e) {
            $("#modal-body iframe").attr("src", "");
        });
    });

    $(".btn-playlist").off();
    $(".btn-playlist").on("click", function () {
        next_trigger = $($(this).closest("li")).next("li").find("a");
        $(this).closest("ul").find("li").removeClass("bg-primary");
        $(this).closest("ul").find("a").removeClass("text-white");
        $(this).closest("li").addClass("bg-primary");
        $(this).addClass("text-white");

        let link = $(this).attr("data-link");
        let education_id = $(this).attr("data-id");

        ajaxQuery("/api/playlist_history/save", { education_id: education_id });

        $(".div-playlist-body iframe").attr("src", link);

        onYouTubeIframeAPIReady();
    });

    $("#play-all").off();
    $("#play-all").on("click", function () {
        $("#ul-playlist li:first a").click();
    });

    $(".modal [data-share]").off();
    $(".modal [data-share]").on("click", function () {
        let share_link = $(this).attr("data-share");
        navigator.clipboard.writeText(share_link);

        // Alert the copied text
        toastr.success("Copied to clipboard.");
    });

    $(".card-tools [data-share]").off();
    $(".card-tools [data-share]").on("click", function () {
        let share_link = $(this).attr("data-share");
        navigator.clipboard.writeText(share_link);

        // Alert the copied text
        toastr.success("Copied to clipboard.");
    });
}

function onYouTubeIframeAPIReady() {
    player = new YT.Player("iframe-player", {
        events: {
            onReady: onPlayerReady,
            onStateChange: onPlayerStateChange,
        },
    });
}

function onPlayerReady(event) {
    document.getElementById("iframe-player").style.borderColor = "#FF6D00";
}
function changeBorderColor(playerStatus) {
    var color;
    if (playerStatus == -1) {
        color = "#37474F"; // unstarted = gray
    } else if (playerStatus == 0) {
        $(next_trigger).click();
        color = "#FFFF00"; // ended = yellow
    } else if (playerStatus == 1) {
        color = "#33691E"; // playing = green
    } else if (playerStatus == 2) {
        color = "#DD2C00"; // paused = red
    } else if (playerStatus == 3) {
        color = "#AA00FF"; // buffering = purple
    } else if (playerStatus == 5) {
        color = "#FF6DOO"; // video cued = orange
    }

    if (color) {
        document.getElementById("iframe-player").style.borderColor = color;
    }
}
function onPlayerStateChange(event) {
    changeBorderColor(event.data);
}
