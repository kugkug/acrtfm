$(document).ready(function () {
    $("[data-trigger=brand]").on("click", function () {
        let Span = $(this).find("span")[0];
        let Icon = $(this).find("i")[0];

        if ($(Span).attr("data-type") == "add") {
            $(Span).attr("data-type", "cancel");
            $(Icon).removeClass("fa-plus").addClass("fa-trash");
            $(this).removeClass("btn-info").addClass("btn-danger");

            $("[name=brand]").val("").show().focus();
            $("[name=select_brand]").val("").hide();
        } else {
            $(Span).attr("data-type", "add");
            $(Icon).removeClass("fa-trash").addClass("fa-plus");
            $(this).removeClass("btn-danger").addClass("btn-info");

            $("[name=brand]").val("").hide();
            $("[name=select_brand]").val("").show();
        }
    });

    $("[name=select_brand]").on("change", function () {
        $("[name=brand]").val($(this).val());
    });
});
