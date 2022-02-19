showStudent();
$("#role-student").parents('.list-group-item').addClass("active");

$("#role-admin").on("click", function () {
    $(this).parents('.list-group-item').addClass('active');
    $(this).addClass("active");
    shopAdmin();
});

$("#role-student").on("click", function () {
    $(this).addClass("active");
    $(this).parents('.list-group-item').addClass('active');
    showStudent();
});

$("#test-form").on("beforeValidate", function (e) {
    if ($("#role-admin").hasClass("active")) {
        $("#test-form").yiiActiveForm("remove", "testform-name");
    } else {
        $("#test-form").yiiActiveForm("remove", "testform-password");
    }
});

function showStudent() {
    if (!is_published) {
        $(".view-submit").css("display", "none");
    }
    $("#test-form").get(0).reset();
    $("#role-admin").removeClass("active");
    $("#role-admin").parents('.list-group-item').removeClass("active");
    $(".field-testform-password").css("display", "none");
    $(".field-testform-name").css("display", "block");
}

function shopAdmin() {
    $(".view-submit").css("display", "block");
    $("#test-form").get(0).reset();
    $("#role-student").removeClass("active");
    $("#role-student").parents('.list-group-item').removeClass("active");
    $(".field-testform-name").css("display", "none");
    $(".field-testform-password").css("display", "block");
}
