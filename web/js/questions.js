reIndex();

$("#questions-form").on("beforeValidate", function (event) {
    $(".compactRadioGroup").each(function (index) {
        choices = [];
        $(this)
            .children()
            .each(function (index, value) {
                label = $(this).children("p").html();
                choices.push(label);
                $(this).children("input")[0].value = index;
            });
        $(this)
            .parents(".question-form")
            .find(".choices-form")
            .attr("value", choices);
    });
    reIndex();
});

$("body").on("click", ".form-delete", function () {
    deleteQuestion($(this));
});

$("body").on("click", ".form-add-choice", function () {
    addChoice($(this));
});

$("body").on("click", ".form-add-question", function () {
    addQuestion($(this));
});

$("body").on("click", ".label-delete", function () {
    deleteChoice($(this));
});

function deleteQuestion(element) {
    parent = $(element).parents(".question-box");
    parent.animate({ height: 0 }, function () {
        parent.remove();
        reIndex();
    });
}

function addChoice(element) {
    parent = $(element).parent(".container");
    question = parent.find(".label-q");
    block = question.first().clone();
    block.children().attr("value", "Выбор " + (question.length + 1));
    block.children().attr('checked', false);
    block.children("p").html("Выбор " + (question.length + 1));
    parent.find(".compactRadioGroup").append(block);
}

function deleteChoice(element) {
    $(element).parent().remove();
}

function reIndex() {
    var id = 1;
    $(".control-label").each(function (index) {
        $(this).html("Вопрос " + id++);
    });
}

function addQuestion($this) {
    var questionClone;


    $.ajax({
        url: "/test-constructor/add-question",
        method: "post",
        async: false,
        data: { type: $($this).data('type')},
        success: (data) => {
            if (data) {
                questionClone = $(data).find(".question-box").last();
            }
        },
    });

    questionClone.removeClass("show");
    $("#questions-container").append(questionClone);

    questionHeight = questionClone.height();
    questionClone.height(0);
    questionClone.animate({ height: questionHeight }, function () {
        questionClone.attr("style", false);
    });

    reIndex();
}
