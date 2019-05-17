
$(document).ready(function(){

  
    $("input").keyup(function(){
        inputstr = $("#bodyt").val();
        inputlen = cal_words(inputstr);
    });

});
