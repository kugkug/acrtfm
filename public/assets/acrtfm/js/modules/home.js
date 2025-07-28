$(document).ready(function () {
    $("[data-trigger]").click(function () {
        var trigger = $(this).data("trigger");
        location = $(this).attr("data-url");
    });
});
