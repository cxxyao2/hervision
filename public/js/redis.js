
$(document).ready(function(){

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });


  $('button').click(function() {
                $.post('/redis/' + $(this).attr('id')
                ,function(html) {
                  $('#redisrr').remove();
                  $('#divUsers').append( html );
                  });
    });


    $('#inname').change(function() {

                  $.post('/redisCookie/'+ $(this).val()
                  ,function(html) {
                    $('#redisrr').remove();
                    $('#divUsers').append( html );
                    });
      });
});
