//da?
da()

function da(){
    $name = $(".page-name").html();
    $('.btn-group-vertical').children().each(function(){
        if($name == $(this).html())
        {
            $(this).addClass('active');
        }
    })
}


$('.modal-answers').on('click', function(){

    $('#resultsModal').modal('show');
    $.ajax({
        type : "POST",
        url : "/test/" + hash_link + "/student-result?testResult=" + $(this).data('id'),
        data : {
                hash_link : hash_link,
                testResult : $(this).data('id'),
                }
    }).done(function(data) {
        $('.modal-body').html(data);
    })
})

$('#resultsModal').on('hidden.bs.modal', function(){
    $('.modal-body').html('');
})