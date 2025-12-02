// Initialize Google Places Autocomplete
let autocomplete;
function initAutocomplete() {
    const billingAddressInput = document.getElementById("billing_address");
    if (
        billingAddressInput &&
        typeof google !== "undefined" &&
        google.maps &&
        google.maps.places
    ) {
        autocomplete = new google.maps.places.Autocomplete(
            billingAddressInput,
            {
                types: ["address"],
                componentRestrictions: { country: ["us"] }, // Restrict to US addresses, remove if you want international
                fields: ["formatted_address", "address_components", "geometry"],
            }
        );

        autocomplete.addListener("place_changed", function () {
            const place = autocomplete.getPlace();
            if (!place.geometry) {
                console.warn(
                    "No details available for input: '" + place.name + "'"
                );
                return;
            }
            // The place is already set in the input field by Google Places
            // You can access place details here if needed:
            // place.formatted_address - full formatted address
            // place.address_components - array of address components
        });
    }
}

// Fallback initialization if Google Maps API loads after document ready
$(document).ready(function () {
    // Check if Google Maps API is already loaded
    if (typeof google !== "undefined" && google.maps && google.maps.places) {
        initAutocomplete();
    }

    $("[data-trigger]").off();
    $("[data-trigger]").on("click", function (e) {
        e.preventDefault();
        let trigger = $(this).attr("data-trigger");
        let form = $(this).closest("form");
        let formData = {};
        let cust_id = "";
        let location_id = "";
        let equipment_id = "";
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

                // Validate that at least name or company is provided
                let nameInput = form.find('input[name="name"]');
                let companyInput = form.find('input[name="company"]');
                let nameValue = nameInput.val().trim();
                let companyValue = companyInput.val().trim();

                if (!nameValue && !companyValue) {
                    nameInput
                        .next("div.invalid-feedback")
                        .text("Please provide either a Name or Company")
                        .show();
                    companyInput
                        .next("div.invalid-feedback")
                        .text("Please provide either a Name or Company")
                        .show();
                    _show_toastr(
                        "error",
                        "Please provide either a Name or Company",
                        "Customer Error"
                    );
                    return;
                } else {
                    nameInput.next("div.invalid-feedback").hide();
                    companyInput.next("div.invalid-feedback").hide();
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

                // Validate that at least name or company is provided
                let nameInputUpdate = form.find('input[name="name"]');
                let companyInputUpdate = form.find('input[name="company"]');
                let nameValueUpdate = nameInputUpdate.val().trim();
                let companyValueUpdate = companyInputUpdate.val().trim();

                if (!nameValueUpdate && !companyValueUpdate) {
                    nameInputUpdate
                        .next("div.invalid-feedback")
                        .text("Please provide either a Name or Company")
                        .show();
                    companyInputUpdate
                        .next("div.invalid-feedback")
                        .text("Please provide either a Name or Company")
                        .show();
                    _show_toastr(
                        "error",
                        "Please provide either a Name or Company",
                        "Customer Error"
                    );
                    return;
                } else {
                    nameInputUpdate.next("div.invalid-feedback").hide();
                    companyInputUpdate.next("div.invalid-feedback").hide();
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

            case "update-equipment":
                equipment_id = $(this).attr("data-id");
                if (!_checkFormFields(form)) {
                    _show_toastr(
                        "error",
                        "Please provide all required fields",
                        "Equipment Error"
                    );
                    return;
                }
                formData = JSON.parse(_collectFields(form));
                ajaxRequest(
                    "/executor/equipment/" + equipment_id + "/update",
                    formData,
                    ""
                );
                break;
            case "delete-equipment":
                equipment_id = $(this).attr("data-id");
                _confirm(
                    "Delete Equipment?",
                    "Are you sure you want to delete this equipment?\nPlease note that this action is irreversible.",
                    "warning",
                    "Yes",
                    true,
                    () => _delete("equipment", equipment_id)
                );
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
