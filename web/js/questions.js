$('#button').on('click', function(){
    $('#page-content').append('<button class="btn btn-primary" id="button">push</button>');
    console.log('123');
    $.ajax({
        type : "POST",
        url : "/test/34491d476ce9f2b91aa5/questions",
        data : {
                hash_link : '34491d476ce9f2b91aa5',
                }
    }).done(function(data) {
        console.log(data)
    })
})