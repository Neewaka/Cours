reIndex();

$("#questions-form").on("beforeValidate", function (event) {
    $(".compactRadioGroup").each(function (index) {
        choices = [];
        $(this)
            .children()
            .each(function () {
                label = $(this).children("p").html();
                choices.push(label);
                $(this).children("input")[0].value = label;
            });
        $(this)
            .parents(".question-form")
            .find(".choices-form")
            .attr("value", choices);
    });
    reIndex();
    // return false;
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
    parent = $(element).parents('.question-box');
    parent.animate({height: 0}, function(){
        parent.remove();
        reIndex();
    });
    
}

function addChoice(element) {
    parent = $(element).parent(".container");
    question = parent.find(".label-q");
    block = question.first().clone();
    block.children().attr("value", "choice");
    block.children("p").html("Выбор " + ++question.length);
    parent.find(".compactRadioGroup").append(block);
}

function deleteChoice(element) {
    $(element).parent().remove();
}

function reIndex() {
    var id = 1;
    $(".control-label").each(function (index) {
        $(this).html(id++ + ". ");
    });
}

function addQuestion() {
    var questionClone = $(".question-box").last().clone();
    console.log(questionClone)
    questionClone.find("input").each(function (index) {
        formName = $(this).attr("name");
        firstPar = formName.indexOf("[");
        secondPar = formName.indexOf("]");
        index = formName.slice(++firstPar, secondPar);
        newIndex = formName.replace(index, $(".question-box").length);
        $(this).attr("name", newIndex);
    });

    questionClone.removeClass('show');
    $(".questions").append(questionClone);

    questionHeight = questionClone.height();
    questionClone.height( 0 );
    questionClone.animate({height: questionHeight}, function(){
        questionClone.attr('style', false);
    });

    reIndex();
}
