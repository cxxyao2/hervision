
        function show(){
          var chanelId = $('#channel_id').val();
          if (chanelId != '3'){
            chanelId = '1';
          }
          $('.topic').addClass('hidden');
          $('#channel' + chanelId).removeClass('hidden');

        }



        function myHideAndShow(hideClass,showClass) {
            $('.'+hideClass).addClass('hidden');
            $('.'+showClass).removeClass('hidden');
        }

        function addHidden(id) {
            $('#' + id).addClass('hidden');
        }

        function moveHidden(id) {
            $('#' + id).removeClass('hidden');
        }


        function submitMyform(path,enctype1='application/x-www-form-urlencoded'){
          $("#myform").attr('action',path); 
          $("#myform").attr('enctype',enctype1); 
          $("#myform").submit();
        }

        function deleteAThread(path){
          questiom = confirm('确定要删除选择的信息吗？\n此操作不可以恢复！');

          return false;
        }
        
        function setSelectedTags(){
            var taglist="";
          　var obj = $('label').filter('.tagselect');
           $.each(obj, function( index, value ) {
                      taglist = taglist + value.id +',';
                    });
          $('#selectedTagArray').val(taglist);

        }


        function changeTagStyle(id1){

           if ($('#' + id1).hasClass('tagdefault'))
           {
             $('#' + id1).removeClass('tagdefault');
             $('#' + id1).addClass('tagselect');
           }
           else
           {
             $('#' + id1).removeClass('tagselect');
             $('#' + id1).addClass('tagdefault');
           }

        }


        function cal_words(controlid){
            inputcontent = $("#"+controlid).val();
            words = "";
          if (inputcontent.length > 0){
              //去掉html标签
              words = inputcontent.replace(/<[^>]+>/g,"");
              //去掉空格
              words = words.replace(/(^\s+)|(\s+$)/g,"");
              alert('thread body length is ' + words.length);
          }else{
              alert('it is a blank thread ');
          }

        }


          function input_words(id){
              str1 = $("#"+id).val();
              if (str1.length > 0){
                 $("#"+id+"counter").text(str1.length);
              }
          }

          function change_visible(btnId,divId){
            if($('#'+divId).hasClass('hidden')){
                $('#' + divId).removeClass('hidden');
                $('#' + btnId).text('display');
            }else{
                $('#' + divId).addClass('hidden');
                $('#' + btnId).text('hide');
            }
          }
