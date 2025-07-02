$(document).ready(function () {
    $("[name=brand_name]").on("change", function () {
        let brand = $(this).val().toLowerCase();

        if (brand !== "") {
            let img =
                "<img src='" +
                $("option:selected", this).attr("data-image") +
                "' alt='" +
                brand +
                " logo'/>";
            $("#div-brand-logo").html(img);
            $(".div-brand-logo").removeClass("d-none");
        } else {
            $(".div-brand-logo").addClass("d-none");
        }
    });

    $("#div-brand-logo").click(function () {
        $("#file-image").click();
    });

    $("#file-image").on("change", function (e) {
        var nSize = $(this).get(0).files[0].size;
        var sFileName = $(this).get(0).files[0].name;
        var sFullPath = window.URL.createObjectURL(e.target.files[0]);

        var aFileName = sFileName.split(".");
        var sFileType = aFileName[aFileName.length - 1].toLowerCase();

        var fSExt = new Array("Bytes", "KB", "MB", "GB"),
            h = 0;
        while (nSize > 900) {
            nSize /= 1024;
            h++;
        }

        var vFileName = "";
        var sInvalid = "";
        var sTooLarge = "";
        var sWrongCamp = "";

        var nExactSize = Math.ceil(Math.ceil(nSize * 100) / 100);
        var vSizeCat = fSExt[h];
        var sSize = nExactSize + "" + vSizeCat;

        if (sFileType != "jpg" && sFileType != "png" && sFileType != "jpeg") {
            sInvalid += sFileName + " - " + sFileType + ".<br />";
        } else {
            if (h < 3) {
                if (h == 2 && nExactSize > 25) {
                    sTooLarge += sFileName + " - " + sSize + ".<br />";
                } else {
                    vFileName += sFileName + "\n\n";
                }
            } else {
                sTooLarge += sFileName + " - " + sSize + ".<br />";
            }
        }

        var sMessage = "";

        if (sInvalid != "") {
            sMessage +=
                "<b>File Invalid Format:</b> <br />" +
                sInvalid +
                "<br /><br />";
        }

        if (sTooLarge != "") {
            sMessage +=
                "<b>File Too Large:</b> <br />" + sTooLarge + "<br /><br />";
        }

        sMessage +=
            "Please be advised, this system can only accept JPG, JPEG and PNG formatted file with up to 25MB max size.";

        if (sTooLarge != "" || sInvalid != "" || sWrongCamp != "") {
            _systemAlert("error", sMessage);
            $("#btn-update").prop("disabled", true);
            $("#div-brand-logo img").attr("src", "");
        } else {
            $("#btn-update").prop("disabled", false);
            $("#div-brand-logo img").attr("src", sFullPath);
        }
    });

    $("#btn-update").on("click", function (evt) {
        evt.preventDefault();
        var sFormData = new FormData();
        sFormData.append("brand", $("[name=brand_name]").val());
        sFormData.append("brand_logo", $("#file-image")[0].files[0]);
        sFormData.append("action", "update-brand-logo");

        ajaxSubmit("/admin/execute/manufacturers", sFormData, $(this));
    });
});
