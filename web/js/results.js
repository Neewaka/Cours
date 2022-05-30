$(document).ready(function () {
    $("#download-json").on("click", function () {
        $.ajax({
            url: "/test-constructor/create",
            method: "post",
            async: false,
            data: { id: $(this).data("test") },
            success: (data) => {
                if (data) {
                    console.log(data);
                    var link = document.createElement("a");
                    link.setAttribute("href", data);
                    link.setAttribute("download", "download");
                    onload=link.click();
                }
            },
        });
    });
});
