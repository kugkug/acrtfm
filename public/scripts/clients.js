let public_path = $("#txtManualPath").val();
document.addEventListener("DOMContentLoaded", function () {
    if (document.querySelector("#table_search")) {
        document.querySelector("#table_search").focus();
    }

    // document.querySelector("#search_by").addEventListener("change", function () {
    //   document.querySelector("#table_search").value = "";
    //   document.querySelector("#brand_name").value = "";

    //   let search_by = document.querySelector("#search_by").value;

    //   if (search_by == "sku") {
    //     $("#div-brands").hide();
    //     $("#div-models").show();
    //     $("#div-brand-data").hide();
    //     $("#div-model-data").show();

    //     document.querySelector("#table_search").focus();
    //   } else {
    //     $("#div-brands").show();
    //     $("#div-models").hide();
    //     $("#div-brand-data").show();
    //     $("#div-model-data").hide();
    //   }
    // });

    $("[name=brand_name]").on("change", function () {
        let Form = $(this).closest("form");
        $(Form).submit();
    });

    $("[data-trigger=modal]").on("click", function () {
        let modalObj = JSON.parse($(this).attr("data-object"));
        let modalData = formatUrls(modalObj.url);

        $("#modalTitle").html(`${modalObj.sku} - (${modalObj.brand})`);

        $("#p-title").html(modalData.header);
        $("#div-links").html(modalData.links.join("<br />"));

        $("#modelModal").modal("show");
        $("#ifrPdf").attr("src", "");

        $("[data-link]").off();
        $("[data-link]").on("click", function () {
            $("#ifrPdf").attr("src", $(this).attr("data-link"));
        });
    });

    $("[data-trigger=img-button]").on("click", function () {
        let Form = $(this).closest("form");
        let sBrand = $(this).attr("data-brand");
        $("[name=brand_name]").val(sBrand);

        $(Form).submit();
    });

    $("[name=table_search]").on("keyup", function () {
        let search = $(this).val();

        $.ajax({
            url: "/airconditioners/search/model",
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
            },
            data: { search: search },
            beforeSend: function () {
                $("#div-model-data").html(
                    '<div class="spinner-border text-info " role="status"> <span class="sr-only">Loading...</span> </div>'
                );
            },
            success: function (result) {
                $("#div-model-data").parent().find(".spinner-border").remove();

                let data = result.data;
                let table = ``;

                if (data.length <= 0) {
                    table += `
                        <a href="#" onclick='_report();' class='btn btn-danger ' style='margin-bottom: 5px'>Report Missing Model</a>
                    `;
                }

                table += `<table class="table text-nowrap mt-4">
                                <thead>
                                    <tr>
                                        <th>Model</th>
                                        <th>Brand</th>
                                        <th class='w-25'>Read More</th>
                                    </tr>
                                </thead>
                                <tbody>`;
                for (const obj of data) {
                    // let sObj = `{"sku":${obj.sku},"brand":${obj.brand}, "url":${obj.url}}`;
                    // console.log(sObj);
                    table += `<tr>
                                        <td>${obj.sku}</td>
                                        <td>${obj.brand}</td>
                                        <td>
                                            <a href="javascript:void(0)" target="_blank" data-toggle="modal" data-target="" class="btn btn-info btn-sm" data-object='${JSON.stringify(
                                                obj
                                            )}' data-trigger="modal">
                                                <i class="fa fa-search"></i>
                                                Explore
                                            </a>
                                        </td>
                                    </tr>
                                        `;
                }
                table += `</tbody></table>`;

                $("#div-model-data").html(table);

                $("[data-trigger=modal]").off();
                $("[data-trigger=modal]").click(function () {
                    let modalObj = JSON.parse($(this).attr("data-object"));

                    let liveUrl = formatUrls(modalObj.url);

                    let pdfManual = formatManuals(modalObj.manuals);

                    let modalData = {
                        links: liveUrl.links.concat(pdfManual.links),
                    };

                    $("#modalTitle").html(
                        `${modalObj.sku} - (${modalObj.brand})`
                    );

                    $("#p-title").html(modalData.header);
                    $("#div-links").html(modalData.links.join("<br />"));

                    $("#modelModal").modal("show");
                    $("#ifrPdf").attr("src", "");

                    $("[data-link]").off();
                    $("[data-link]").on("click", function () {
                        $("#btnFullScreen").attr(
                            "href",
                            $(this).attr("data-link")
                        );
                        $("#ifrPdf").attr("src", $(this).attr("data-link"));
                    });
                });
            },
            error: function (e) {
                $("#div-model-data").parent().find(".spinner-border").remove();
            },
        });
    });

    $("#selMissingModelBrand").on("change", function () {
        if ($(this).val() == "new_brand") {
            $("#txtMissingBrand").val("");
            $("#div-missing-brand").removeClass("d-none");
        } else {
            $("#div-missing-brand").removeClass("d-none").addClass("d-none");
        }
    });

    $("[data-trigger=report]").on("click", function () {
        $.ajax({
            url: "/airconditioners/report/model",
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
            },
            data: {
                sku: $("#txtMissingModel").val(),
                brand: $("#selMissingModelBrand").val(),
                missing_brand: $("#txtMissingBrand").val(),
                link: $("#txtLink").val(),
                pdf_link: $("#txtPdfLink").val(),
            },
            beforeSend: function () {},
            success: function (result) {
                if (result.status == "error") {
                    eval(result.message);

                    return;
                }

                toastr.success("Model Number Reported!");
                $("#missingModelModal").modal("hide");
            },
            error: function (e) {},
        });
    });
});

function formatUrls(modalUrls) {
    let urlRegex = /(https?:\/\/[^\s]+)/g;
    let response = {};
    let links = [];
    let aModalUrls = modalUrls.split("[");

    if (aModalUrls.length > 1) {
        for (const modalurl of aModalUrls) {
            if (modalurl.trim() != "") {
                let aMoralUrl = modalurl.split("]");
                if (aMoralUrl.length > 1) {
                    let sTitle = aMoralUrl[0];
                    let sUrl = aMoralUrl[1];
                    sUrl.replace(urlRegex, function (url) {
                        var newurl = url.replace(").", "");

                        if (newurl[newurl.length - 1] == ")")
                            newurl = newurl.substring(0, newurl.length - 1);

                        a_newurl = newurl.split(".");

                        let sLink = `<a class='btn btn-info mb-3 btn-block' href="#" data-link="${newurl}">
                                <i class="fas fa-external-link-alt"></i>
                                ${sTitle}
                            </a>`;

                        links.push(sLink);
                    });

                    response.links = links;
                } else {
                    response.header = aMoralUrl[0];
                }
            }
        }
    } else {
        let sLink = `<a class='btn btn-info mb-3 btn-block' href="${aModalUrls[0]}" target='_blank' >
                            <i class="fas fa-external-link-alt"></i>
                            Go To Website
                        </a>`;
        links.push(sLink);
        response.links = links;
    }

    return response;
}

function formatManuals(manualData) {
    let urlRegex = /(https?:\/\/[^\s]+)/g;
    let response = {};
    let links = [];

    for (const manual of manualData) {
        let sLink = `<a class='btn btn-info mb-3 btn-block' href="#" data-link="http://docs.google.com/gview?url=${
            public_path + "/" + manual.filename
        }&embedded=true">
                            <i class="fas fa-external-link-alt"></i>
                            ${manual.label}
                        </a>`;
        links.push(sLink);
        response.links = links;
        response.header = manual.label;
    }
    return response;
}

function _report() {
    let missing_model = $("#table_search").val();

    $("#txtMissingModel").val(missing_model);
    $("#missingModelModal").modal("show");
}
