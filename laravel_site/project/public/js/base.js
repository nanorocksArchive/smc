$(document).ready(function(){
    var postid = 0;
    var body = null;

    $('.interaction').find('.edit').on( "click", function(e) {
        $('#succ').hide();
        $('.errorclass').hide();
        body =  $(this).parent().parent().find('.body').text();
        postid = $(this).parent().parent().find('.postid').html();
        var name =  $(this).parent().parent().find('.firstname').text();
        $('#edit-modal').modal().find('#post-body').val(body);
        $('#edit-modal .modal-body').find('label').find('span').text(name);
    });

    $('#save-body').on('click',function(){

        if( $('#post-body').val().length <= 20)
        {
                alert('Fill min 20 caracters for post.');
                return; //  $('.errorclass').show();
        }


            $.ajax({
                method: 'POST',
                url: url1,
                data: {body: $('#post-body').val(), id: postid, _token: token1}

            }).done(function (msg) {
                var temp = $('#post-body').val();
                $('.post').find('.body').first().text(temp);
                $('#edit-modal').modal('hide');
                alert('Success!!!');
            });

    });

    var pom = 0;
    $('.like').on('click',function () {

        postid = $(this).parent().parent().find('.postid').html();
        var l = pom ;
        var text1 = 'You add like on post';
        if(pom == 1)
        {
            pom = l = 0;
            text1 = 'Like';

        }else{
            pom = l = 1;
        }
        $.ajax({
            method: 'POST',
            url: urllike,
            data: {like: l, post_id: postid, _token: token1}

        }).done(function (msg) {
           // alert('You add like on post');
        });
        return $(this).text(text1);

    });

});