$(document).ready(function () {
    $("[data-key='ModelNumber']").on("keyup", function () {
        let url = $(this).attr("data-url");
        let modelNumber = $(this).val();

        ajaxRequest(url, { search: modelNumber }, "sub-loader");
    });

    $("[data-trigger='view-manual']").off();
    $("[data-trigger='view-manual']").on("click", function () {
        let url = $(this).attr("data-url");
        $("#ifrPdf").attr("src", url);
        $("#full-screen-btn").attr("href", url);
        $("#full-screen-btn").removeClass("d-none");
    });
});
