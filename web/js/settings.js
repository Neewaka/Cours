

$(document).ready(function(){

    $('[data-toggle="popover"]').popover({
        delay: {
            show: "0",
            hide: "800",
        }
    });   


    $('.button-delete').on('click', function(){

        $('#deleteModal').modal('toggle');
    
    })

    $('.btn-hash-link').on('click', function(){
        text = $(this).data('url');
        var copytext = document.createElement('input');
        copytext.value = text;
        document.body.appendChild(copytext);
        copytext.select();
        document.execCommand("copy");
        document.body.removeChild(copytext);
    })
});


