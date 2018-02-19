$(document).ready(function() {
    $( ".reply" ).click(function() {

        var $thisID = $(this).attr('id');
        if ($thisID !== null){
            $( '.reply-form-' + $thisID).show();
        }
    });

    $( ".edit" ).click(function() {

        var $thisID = $(this).attr('id');

        if ($thisID !== null){
            $( '.edit-reply-form-' + $thisID).show();
        }
    });
});