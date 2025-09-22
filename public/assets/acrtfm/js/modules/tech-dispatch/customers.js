$(document).ready(function () {
    $("[data-trigger]").off();
    $("[data-trigger]").on("click", function (e) {
        e.preventDefault();
        let trigger = $(this).attr("data-trigger");
        let form = $(this).closest("form");
        let formData = {};
        let cust_id = "";
        let location_id = "";

        switch (trigger) {
            case "save-customer":
                if (!_checkFormFields(form)) {
                    _show_toastr(
                        "error",
                        "Please provide all required fields",
                        "Customer Error"
                    );
                    return;
                }

                formData = JSON.parse(_collectFields(form));

                ajaxRequest("/executor/customers/save", formData, "");
                break;
            case "update-customer":
                cust_id = $(this).attr("data-id");
                if (!_checkFormFields(form)) {
                    _show_toastr(
                        "error",
                        "Please provide all required fields",
                        "Customer Error"
                    );
                    return;
                }
                formData = JSON.parse(_collectFields(form));
                ajaxRequest(
                    "/executor/customers/" + cust_id + "/update",
                    formData,
                    ""
                );
                break;
            case "delete-customer":
                cust_id = $(this).attr("data-id");
                _confirm(
                    "Delete Customer?",
                    "Are you sure you want to delete this customer?\nPlease note that this action is irreversible.",
                    "warning",
                    "Yes",
                    true,
                    () => _delete("customer", cust_id)
                );

                break;

            case "cancel-customer":
                location.href = "/customers";
                break;

            case "add-location":
                $("#addLocationModal").modal("show");
                break;
            case "cancel-add-location":
                $("#addLocationModal form")[0].reset();
                $("#addLocationModal").modal("hide");
                break;
            case "save-location":
                cust_id = $(this).attr("data-id");
                if (!_checkFormFields(form)) {
                    _show_toastr(
                        "error",
                        "Please provide all required fields",
                        "Location Error"
                    );
                    return;
                }
                formData = JSON.parse(_collectFields(form));
                formData.CustomerId = cust_id;
                ajaxRequest("/executor/location/save", formData, "");

                break;

            case "update-location":
                location_id = $(this).attr("data-id");
                if (!_checkFormFields(form)) {
                    _show_toastr(
                        "error",
                        "Please provide all required fields",
                        "Location Error"
                    );
                    return;
                }
                formData = JSON.parse(_collectFields(form));
                ajaxRequest(
                    "/executor/location/" + location_id + "/update",
                    formData,
                    ""
                );
                break;

            case "delete-location":
                location_id = $(this).attr("data-id");
                _confirm(
                    "Delete Location?",
                    "Are you sure you want to delete this location?\nPlease note that this action is irreversible.",
                    "warning",
                    "Yes",
                    true,
                    () => _delete("location", location_id)
                );

                break;

            case "add-equipment":
                $("#addEquipmentModal form")[0].reset();
                $("#addEquipmentModal").modal("show");
                break;
            case "save-equipment":
                cust_id = $(this).attr("data-id");
                if (!_checkFormFields(form)) {
                    _show_toastr(
                        "error",
                        "Please provide all required fields",
                        "Equipment Error"
                    );
                    return;
                }
                formData = JSON.parse(_collectFields(form));
                formData.CustomerId = cust_id;
                ajaxRequest("/executor/equipment/save", formData, "");
                break;

            case "cancel-add-equipment":
                $("#addEquipmentModal form")[0].reset();
                $("#addEquipmentModal").modal("hide");
                break;
        }
    });
});

function _delete(type, id) {
    let url = "";
    switch (type) {
        case "customer":
            url = "/executor/customers/" + id + "/delete";
            break;
        case "location":
            url = "/executor/location/" + id + "/delete";
            break;
        case "equipment":
            url = "/executor/equipment/" + id + "/delete";
            break;
    }
    ajaxRequest(url, "", "");
}
