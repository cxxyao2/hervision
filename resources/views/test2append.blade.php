<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js">
    </script>
    <script>
        $(document).ready(function(){

            $('#button1').click(function(){
                $('#div1').css("color","red").slideUp(200).slideDown(400);
                $('span').append(location.href);
            });

        });
    </script>
</head>
<body>

    <button id="button1">click to show div</button>
    <div id="div1" style="width:300;height:300;background-color:green;" >
        <span>hi,how are you</span>
    </div>
    <br>



</body>
</html>
