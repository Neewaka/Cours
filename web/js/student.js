$(document).ready(function () {
    $("#noDays").countdown({
        until: +testTime,
        format: "HMS",
        onExpiry: liftOff,
    });
});

function liftOff() {
    $('#student-submit').removeClass('data-blocked');
    $('#student-submit').click();
}

$('#student-confirm').on('click', function(){
    $('#student-submit').removeClass('data-blocked');
    $('#student-submit').click();
})

$("#questions-form").on("beforeSubmit", function () {

    if ($('#student-submit').hasClass("data-blocked")) {
        var data = $("#questions-form").serialize();
        $.ajax({
            url: $("#questions-form").attr("action"),
            type: "POST",
            data: data,
            success: function (data) {
                $("#studentModal").modal("toggle");
                var dataArray = JSON.parse(data);
                $("#modalBody").html("");
                dataArray.forEach((element) => {
                    $("#modalBody").append(
                        "<div> - Вопрос " + (element + 1) + "</div>"
                    );
                });
            },
            error: function (jqXHR, errMsg) {
                alert(errMsg);
            },
        });

        return false;
    }

    return true;
});

$(".label-q").on("click", function () {
    input = $(this).find("input");
    current = input.prop("checked");
    if (input.attr("type") == "checkbox") {
        input.prop("checked", !current);
    } else {
        input.prop("checked", true);
    }
});

function reIndex() {
    var id = 1;
    $(".control-label").each(function (index) {
        $(this).html("Вопрос " + id++);
    });
}

reIndex();
