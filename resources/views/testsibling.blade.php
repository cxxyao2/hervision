
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js">
    </script>
    <script>
        $(document).ready(function(){
            $("h1").next().css({"color":"green","border":"2px solid green"});
            $("h2").siblings("span").css({"color":"red","border":"2px solid yellow"});

            $("h3").nextAll().css({"color":"green","border":"2px solid yellow"});
            $("h4").nextUntil("h6").css({"background-color":"purple","border":"2px solid yellow"});
            $("#sister").prev().css({"color":"red","border":"2px solid red"});

                });
    </script>

</head>
<body>

    <div>
        <h1>this is a long paragraph</h1>
        <span>h1's next classmate</span>

 </div>



 <div>
     <p>this is a long paragraph</p>
     <span>today is sunny</span>
     <h2>header</h2>
     <p>this is a second paragraph</p>
</div>


  <div>
         <h3>begin here</h3>
         <span>hi,ggod</span>
         <span>hi,better</span>
     </div>

     <div>
            <h4>begin here</h3>
            <h5>begin h5  here</h3>
            <h6>begin here</h3>
        </div>

        <div>
            <h3>h3 header is most belle</h3>
               <h4 id="sister">begin here</h4>
              <h5> hi h5 </h5>

           </div>

</body>
</html>
