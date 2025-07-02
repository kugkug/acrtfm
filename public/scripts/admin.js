$(document).ready(function () {
    if (document.querySelector("#table_search")) {
        document.querySelector("#table_search").focus();
    }

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
                console.log(result);
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
  
                                                  <a href="/execute/ac-edit/${obj.id}" class="btn btn-primary btn-sm">
                                                      <i class="far fa-edit"></i>
                                                      Edit
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
                    let modalData = "";

                    if (modalObj.manuals.length > 0)
                        modalData = formatManuals(modalObj.manuals);
                    else modalData = formatUrls(modalObj.url);

                    $("#modalTitle").html(
                        `${modalObj.sku} - (${modalObj.brand})`
                    );

                    $("#p-title").html(modalData.header);
                    $("#div-links").html(modalData.links.join("<br />"));

                    $("#modelModal").modal("show");

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
});
