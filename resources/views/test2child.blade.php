
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js">
    </script>
    <script>
        $(document).ready(function(){
            $('button').click(function(){
                $('#div1').fadeIn("slow");
            });
            $("div").children().css({"color":"red","border":"2px solid red"});
            $("div").children("p.1").css({"color":"blue","border":"5px solid yellow"});
            $("#div2").find("span").css({"color":"green","border":"5px solid blue"});

        });
    </script>
    <style>
        q:lang(no){
            quotes: "~" "~";
        }
        .ancestors *
        {
            display: block;
            border: 2px solid lightgrey;
            color: green;
            padding: 5px;
            margin: 15px
        }
    </style>
</head>
<body>
    <p>some test<q lang="no">a queto in a paragraphp</q>some text</p>
    <button>click to show div</button>
    <div id="div1" style="width:80px;height:80px;display:none;background-color:red;">
        <span>hi,how are you</span>
    </div><br>

    <div id="div2" class="ancestors">
        <p class="1"> hi, good world</p>
        <div> grandparent
        <div>  I like this poet
            <ul>
                <li>
                <span>PrometheusUnbound普罗米修斯（古希腊语：Προμηθε??），在希腊神话中，是泰坦神族的神明
                    并让半人马喀戎来代替普罗米修斯。但他必须永远戴一只铁环，环上镶上一块高加索山上的石子
                </span>
                </li>
                <li>
                    good teacher, good doctor, human's jewellery
                </li>
            </ul>
        </div>
    </div>
</div><br>

</body>
</html>
