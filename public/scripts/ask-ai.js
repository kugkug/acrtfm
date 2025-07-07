document.addEventListener("DOMContentLoaded", function () {
    $("#btn-inquire").on("click", function () {
        let search = $("[name=table_search]").val();
        if (search == "") return;

        $("#div-result .direct-chat-messages").append(
            `<div class="direct-chat-msg">
                <div class="direct-chat-text m-0 float-right">
                    ${search}
                </div>  
            </div>
            `
        );

        $("[name=table_search]").val("");
        $.ajax({
            url: "/airconditioners/ask/ai",
            type: "POST",
            datatype: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
            },
            data: { search_query: search },
            beforeSend: function () {
                $("#div-result").append(
                    '<div class="spinner-border text-info" role="status"> <span class="sr-only">Loading...</span> </div>'
                );
            },
            success: function (result) {
                if (result.status == false) return;

                $("#div-result").parent().find(".spinner-border").remove();

                result.content = result.content.replace(/[\r\n]/g, "<br />");
                $("#div-result .direct-chat-messages").append(
                    `<div class="direct-chat-msg">
                        <div class="direct-chat-text m-0 bg-primary text-white">
                            ${result.content}
                        </div>
                    </div>  
                </div>
                `
                );
                // $("#div-result").append(links);
            },
            error: function (e) {
                console.log(e);
                $("#div-result").parent().find(".spinner-border").remove();
            },
        });
    });
});
