$(document).ready(function () {
    $("[data-trigger=update-module]").on("click", function () {
        let id = $(this).attr("data-id");
        let sForm = $(this).closest("form");
        // let data = _checkFormFields(sForm);
        let data = _collectFields(sForm);

        let new_data = { ...data, id: id };

        ajaxQuery("/admin/execute/modules", new_data, $(this));
    });
});
