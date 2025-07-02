$(document).ready(function () {
    $("[data-trigger='synch-ac']").click(function () {
        $.ajax({
            type: "GET",
            url: "http://synch.acrtfm.com?type=ac",
            beforeSend: function () {
                $("#div-button").addClass("d-none");
                $("#div-callout").removeClass("d-none");
                $("#div-progress").removeClass("d-none");
                $("#div-done").addClass("d-none");
            },
            success: function (response) {
                $("#div-button").removeClass("d-none");
                $("#div-callout").addClass("d-none");
                $("#div-progress").addClass("d-none");
                $("#div-done").removeClass("d-none");
            },
            error: function () {
                $("#div-button").removeClass("d-none");
                $("#div-callout").addClass("d-none");
                $("#div-progress").addClass("d-none");
            },
        });
    });

    $("[data-trigger='synch-educ']").click(function () {
        $.ajax({
            type: "GET",
            url: "http://synch.acrtfm.com?type=educ",
            beforeSend: function () {
                $("#div-button-educ").addClass("d-none");
                $("#div-callout-educ").removeClass("d-none");
                $("#div-progress-educ").removeClass("d-none");
                $("#div-done-educ").addClass("d-none");
            },
            success: function (response) {
                $("#div-button-educ").removeClass("d-none");
                $("#div-callout-educ").addClass("d-none");
                $("#div-progress-educ").addClass("d-none");
                $("#div-done-educ").removeClass("d-none");
            },
            error: function () {
                $("#div-button-educ").removeClass("d-none");
                $("#div-callout-educ").addClass("d-none");
                $("#div-progress-educ").addClass("d-none");
            },
        });
    });

    $("[data-trigger='synch-user']").click(function () {
        $.ajax({
            type: "GET",
            url: "http://synch.acrtfm.com?type=user",
            beforeSend: function () {
                $("#div-button-user").addClass("d-none");
                $("#div-callout-user").removeClass("d-none");
                $("#div-progress-user").removeClass("d-none");
                $("#div-done-user").addClass("d-none");
            },
            success: function (response) {
                console.log(response);
                $("#div-button-user").removeClass("d-none");
                $("#div-callout-user").addClass("d-none");
                $("#div-progress-user").addClass("d-none");
                $("#div-done-user").removeClass("d-none");
            },
            error: function () {
                $("#div-button-user").removeClass("d-none");
                $("#div-callout-user").addClass("d-none");
                $("#div-progress-user").addClass("d-none");
            },
        });
    });
});
