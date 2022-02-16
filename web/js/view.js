$('.field-testform-password').css('display', 'none');

$('#role-admin').on('click', function(){
    $("#test-form").get(0).reset();
    $(this).addClass('active');
    $('#role-student').removeClass('active');
    $('.field-testform-name').css('display', 'none');
    $('.field-testform-password').css('display', 'block');
})

$('#role-student').on('click', function(){
    $("#test-form").get(0).reset();
    $(this).addClass('active');
    $('#role-admin').removeClass('active');
    $('.field-testform-password').css('display', 'none');
    $('.field-testform-name').css('display', 'block');
})

$('#test-form').on('beforeValidate', function(e){

    if($('#role-admin').hasClass('active'))
    {
        $('#test-form').yiiActiveForm('remove', 'testform-name');
    }
    else
    {
        $('#test-form').yiiActiveForm('remove', 'testform-password');
    }

})