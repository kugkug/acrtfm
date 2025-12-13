/**
 * Populate edit profile modal with current user data
 * @param {Object} userData - User data object with profile fields
 */
function populateEditProfileModal(userData) {
    if (!userData) {
        // If no data provided, try to get from window object
        userData = window.currentUserData || {};
    }

    // Populate form fields
    if (userData.name !== undefined) {
        $("#editProfileModal input[name='name']").val(userData.name || "");
    }
    if (userData.email !== undefined) {
        $("#editProfileModal input[name='email']").val(userData.email || "");
    }
    if (userData.first_name !== undefined) {
        $("#editProfileModal input[name='first_name']").val(
            userData.first_name || ""
        );
    }
    if (userData.last_name !== undefined) {
        $("#editProfileModal input[name='last_name']").val(
            userData.last_name || ""
        );
    }
    if (userData.phone !== undefined) {
        $("#editProfileModal input[name='phone']").val(userData.phone || "");
    }
    if (userData.contact !== undefined) {
        $("#editProfileModal input[name='contact']").val(
            userData.contact || ""
        );
    }
    if (userData.company !== undefined) {
        $("#editProfileModal input[name='company']").val(
            userData.company || ""
        );
    }
    if (userData.contact_person !== undefined) {
        $("#editProfileModal input[name='contact_person']").val(
            userData.contact_person || ""
        );
    }
    if (userData.address !== undefined) {
        const addressField = $("#editProfileModal textarea[name='address']");
        if (addressField.length) {
            addressField.val(userData.address || "");
        }
    }
    if (userData.theme !== undefined) {
        $("#editProfileModal select[name='theme']").val(userData.theme || "light");
    }
}

/**
 * Show the edit profile modal
 */
function showEditProfileModal() {
    // Populate fields before showing modal
    populateEditProfileModal(window.currentUserData);
    $("#editProfileModal").modal("show");
}

$(document).ready(function () {
    // Handle edit profile button click
    $('[data-target="#editProfileModal"]').on("click", function (e) {
        e.preventDefault();
        showEditProfileModal();
    });

    // Populate fields when modal is shown (Bootstrap event)
    $("#editProfileModal").on("show.bs.modal", function () {
        populateEditProfileModal(window.currentUserData);
    });

    $("[data-trigger]").off();
    $("[data-trigger]").on("click", function (e) {
        e.preventDefault();
        let trigger = $(this).attr("data-trigger");
        let form = $(this).closest("form");
        let formData = {};

        switch (trigger) {
            case "update-profile":
                formData = JSON.parse(_collectFields(form));
                ajaxRequest("/executor/profile/update", formData, "");
                break;
        }
    });
});
