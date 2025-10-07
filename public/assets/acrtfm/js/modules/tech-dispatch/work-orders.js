$(document).ready(function () {
    $("[data-trigger]").off();
    $("[data-trigger]").on("click", function (e) {
        e.preventDefault();

        let trigger = $(this).attr("data-trigger");
        let form = $(this).closest("form");
        let formData = {};
        let work_order_id = "";

        switch (trigger) {
            case "create-work-order":
                if (!_checkFormFields(form)) {
                    _show_toastr(
                        "error",
                        "Please provide all required fields",
                        "Work Order Error"
                    );
                    return;
                }
                formData = JSON.parse(_collectFields(form));
                ajaxRequest("/executor/work-orders/save", formData, "");
                break;

            case "update-work-order":
                if (!_checkFormFields(form)) {
                    _show_toastr(
                        "error",
                        "Please provide all required fields",
                        "Work Order Error"
                    );
                    return;
                }
                work_order_id = $(this).attr("data-id");
                formData = JSON.parse(_collectFields(form));
                ajaxRequest(
                    `/executor/work-orders/${work_order_id}/update`,
                    formData,
                    ""
                );
                break;

            case "delete-work-order":
                work_order_id = $(this).attr("data-id");
                _confirm(
                    "Delete Work Order?",
                    "Are you sure you want to delete this work order?\nPlease note that this action is irreversible.",
                    "warning",
                    "Yes",
                    true,
                    () => _delete("work-order", work_order_id)
                );

                break;
        }
    });

    $("[data-target]").on("click", function (e) {
        e.preventDefault();

        let target = $(this).attr("data-target");

        $(".div-target").removeClass("d-none").addClass("d-none");
        $(".div-target").removeClass("d-block").addClass("d-none");

        $("#" + target).addClass("d-block");
    });

    $("[data-target=card-photos]").click();
});

function _delete(type, id) {
    let url = "";
    switch (type) {
        case "work-order":
            url = "/executor/work-orders/" + id + "/delete";
            break;
    }
    ajaxRequest(url, "", "");
}
