$('.field-testform-password').css('display', 'none');

$('#role-admin').on('click', function(){
    $(this).addClass('active');
    $('#role-student').removeClass('active');
    console.log('admin');
    $('.field-testform-name').css('display', 'none');
    $('.field-testform-password').css('display', 'block');
})

$('#role-student').on('click', function(){
    $(this).addClass('active');
    $('#role-admin').removeClass('active');
    console.log('student');
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