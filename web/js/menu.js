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