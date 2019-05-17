
$(document).ready(function(){

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });


  $('button[name="btnusers"]').click(function() {
                $.post('/admin/users/usersearch/' + $('#userSelect').val() + $('#userSearch').val()
                ,function(html) {
                  $('#userTableDiv').remove();
                  $('#divUsers').append( html );
                  });
    });




  $("div").on("click","button.userDelete",function(){
       event.stopPropagation();
       var r=confirm("Deleted data cannot be recoverd.Are you sure to delete it？");
       if(r){
            $.ajax({
                method: 'DELETE',
                url: '/admin/users/' +　$(this).next('input').val(),
                success: function( data ) {
                    $('#rowuserid'+ data).remove();
                    $('#userCount').text(($('#userTbl tr').length - 2)+ ' records');
                  flash('User ( ID=' + data +' ) has been deleted','success');

                },
                error:function(xhr,textstatus,thrown){

                }
            });
       }

  });


    $("div").on("click","button.userLock",function(){
       event.stopPropagation();
       $.ajax({
           method: 'put',
           url: '/admin/users/' +　$(this).next('input').val(),
           success: function( data ) {

                if (data['lock'] == 0 ){
                $('#txtLock'+ data['id']).html("unlock");
                  $('#btnLock'+ data['id']).text('lockit');
             }
             if (data['lock'] == 1){
               $('#txtLock'+ data['id']).html("locked");
               $('#btnLock'+ data['id']).text('unlock');

             }
           },
           error:function(xhr,textstatus,thrown){

           }
       });
      });


      $('button[name="btnthreads"]').click(function() {
                    $.post('/admin/threads/threadsearch/' + $('#threadSelect').val() + $('#threadSearch').val()
                    ,function(html) {
                      $('#threadTableDiv').remove();
                      $('#divThreads').append( html );
                      });
        });




      $("div").on("click","button.threadDelete",function(){
           event.stopPropagation();
           var r=confirm("Deleted data cannot be recoverd.Are you sure to delete it？");
           if(r){
                $.ajax({
                    method: 'DELETE',
                    url: '/admin/threads/' +　$(this).next('input').val(),
                    success: function( data ) {
                        $('#rowthreadid'+ data).remove();
                        $('#threadCount').text(($('#threadsTbl tr').length - 2)+ ' records');
                      flash('Thread ( ID=' + data +' ) has been deleted','success');

                    },
                    error:function(xhr,textstatus,thrown){

                    }
                });
           }

      });


        $("div").on("click","button.threadLock",function(){
           event.stopPropagation();
           $.ajax({
               method: 'put',
               url: '/admin/threads/' +　$(this).next('input').val(),
               success: function( data ) {

                    if (data['lock'] == 0 ){
                    $('#threadLock'+ data['id']).html("unlock");
                      $('#btnthreadLock'+ data['id']).text('lockit');
                    }

                   if (data['lock'] == 1){
                     $('#threadLock'+ data['id']).html("locked");
                     $('#btnthreadLock'+ data['id']).text('unlock');
                   }
               },
               error:function(xhr,textstatus,thrown){

               }
           });
          });
});
