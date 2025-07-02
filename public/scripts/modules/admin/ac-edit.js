$(document).ready(function () {
    let file = $("[type=file]");

    if (file.length) {
        $(file).off();
        $(file).click();
        $(file).on("change", function (e) {
            let fileLength = $(this).get(0).files.length;
            let files = $(this).get(0).files;
            let invalidCnt = 0;

            for (const file of files) {
                let nSize = file.size;
                var sFileName = file.name;
                let sFullPath = URL.createObjectURL(file);

                let aFileName = sFileName.split(".");
                let sFileType = aFileName[aFileName.length - 1].toLowerCase();

                var fSExt = new Array("Bytes", "KB", "MB", "GB"),
                    h = 0;
                while (nSize > 900) {
                    nSize /= 1024;
                    h++;
                }

                var nExactSize = Math.ceil(Math.ceil(nSize * 100) / 100);
                var vSizeCat = fSExt[h];
                var sSize = nExactSize + "" + vSizeCat;

                if (sFileType != "pdf") {
                    invalidCnt++;
                }
                //  else {
                //     if (h < 3) {
                //         if (h == 2 && nExactSize > 25) {
                //             invalidCnt++;
                //         }
                //     } else {
                //         invalidCnt++;
                //     }
                // }
            }

            if (invalidCnt > 0) {
                let sMessage =
                    "Please be advised, this system can only accept PDF formatted file.";

                _systemAlert("error", sMessage);

                $(".choose-file-button").text("Choose files");
                $(".file-message").text("or drag and drop files here");

                $(".file-drop-area").removeClass("d-none");
                $(".div-main-uploads").addClass("d-none");
            } else {
                $(".choose-file-button").text(fileLength + " chosen file/s");
                $(".file-message").text("");

                let iFrames = "";
                let x = 0;
                for (const file of files) {
                    let sFullPath = URL.createObjectURL(file);
                    iFrames += `<div class="form-group" style="text-align:center;">
                                        <label for="label">Label</label>
                                        <input type="text" id="label_${x}" class="form-control mb-2" placeholder="Label ">
                                        <iframe src="${sFullPath}" frameborder="0" height="450" style="width: 80%;"></iframe>
                                        <hr />
                                    </div>`;
                    x++;
                }

                $("#div-uploads").html(iFrames);
                $(".div-main-uploads").removeClass("d-none");
                $(".file-drop-area").addClass("d-none");
            }
        });
    }

    $("#btn-review").off();
    $("#btn-review").on("click", function (e) {
        e.preventDefault();

        let files = $("#txtFiles")[0].files;
        let fileLength = files.length;

        if (fileLength > 0) {
            let form_data = new FormData();
            form_data.append("ac_id", $("#txdtAcId").val());
            for (let x = 0; x < fileLength; x++) {
                form_data.append("labels[]", $("#label_" + x).val());
                form_data.append("files[]", files[x]);
            }

            ajaxSubmit("/admin/execute/upload-pdf", form_data, $(this));
        } else {
            _systemAlert("error", "No files have been selected!");
        }
        // let form_data = new FormData();
        // form_data.append("Document", chosen_file);

        // let parentForm = $(this).closest("form");
        // let chosen_file = $($(".file-input"))[0].files[0];

        // let form_data = new FormData();
        // form_data.append("Document", chosen_file);
    });

    $("#btn-reset").off();
    $("#btn-reset").on("click", function () {
        $("#txtFiles").val("");
        $("#div-uploads").html("");
        $(".file-drop-area").removeClass("d-none");
        $(".div-main-uploads").addClass("d-none");

        $(".choose-file-button").text("Choose files");
        $(".file-message").text("or drag and drop files here");
    });

    $("[data-trigger=delete-pdf]").off();
    $("[data-trigger=delete-pdf]").on("click", function () {
        let manual_id = $(this).attr("data-id");

        ajaxQuery("/admin/execute/delete-pdf", { manual_id: manual_id });
    });

    $("#btn-review-bulk").off();
    $("#btn-review-bulk").on("click", function (e) {
        e.preventDefault();

        let files = $("#txtFiles")[0].files;
        let fileLength = files.length;

        if (fileLength > 0) {
            let form_data = new FormData();
            form_data.append("model_numbers", $("#txtModelNos").val());

            for (let x = 0; x < fileLength; x++) {
                form_data.append("labels[]", $("#label_" + x).val());
                form_data.append("files[]", files[x]);
            }

            ajaxSubmit("/admin/execute/upload-pdf-bulk", form_data, $(this));
        } else {
            _systemAlert("error", "No files have been selected!");
        }
        // let form_data = new FormData();
        // form_data.append("Document", chosen_file);

        // let parentForm = $(this).closest("form");
        // let chosen_file = $($(".file-input"))[0].files[0];

        // let form_data = new FormData();
        // form_data.append("Document", chosen_file);
    });
});
