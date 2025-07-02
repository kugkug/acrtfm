document.addEventListener("DOMContentLoaded", function () {
    $("#btn-inquire").on("click", function () {
        let search = $("[name=table_search]").val();

        $.ajax({
            url: "/airconditioners/ask/ai",
            type: "POST",
            datatype: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
            },
            data: { search_query: search },
            beforeSend: function () {
                $("#div-result").html(
                    '<div class="spinner-border text-info " role="status"> <span class="sr-only">Loading...</span> </div>'
                );
            },
            success: function (result) {
                console.log(result);
                if (result.status == false) return;

                $("#div-result").parent().find(".spinner-border").remove();
                let links = `
                    <h3 class='my-3'>Other References: </h3>
                    <div class='row'>`;

                for (const item of result.citations) {
                    links += `
                            <div class="col-md-6 mb-2">
                                <a href='${item}' target='_blank'> ${item} </a>
                            </div>
                            `;
                }
                links += `</div>`;

                result.content = result.content.replace(/[\r\n]/g, "<br />");
                $("#div-result").html(result.content);
                $("#div-result").append(links);
            },
            error: function (e) {
                console.log(e);
                $("#div-result").parent().find(".spinner-border").remove();
                $("#div-result").parent().find(".spinner-border").remove();
            },
        });
    });
});
