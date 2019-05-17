
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
            $("span").parentsUntil("div").css({"color":"red","border":"2px solid red"});

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
        <span>hi,how are you</span></div><br>

    <div id="div2" class="ancestors">
        <div> grandparent
        <div>  I like this poet
            <ul>
                <li>
            <span>PrometheusUnbound普罗米修斯（古希腊语：Προμηθε??），在希腊神话中，是泰坦神族的神明
普罗米修斯
普罗米修斯
之一，名字的意思是“先见之明”(forethought)。是地母盖亚与天父乌拉诺斯的女儿忒弥斯与伊阿佩托斯的儿子。普罗米修斯教会了人类很多知识。宙斯禁止人类用火，他就帮人类从奥林匹斯偷取了火，因此触怒宙斯。宙斯将他锁在高加索山的悬崖上，每天派一只鹰去吃他的肝，又让他的肝每天重新长上。几千年后，赫剌克勒斯为寻找金苹果来到悬崖边，
把恶鹰射死，并让半人马喀戎来代替普罗米修斯。但他必须永远戴一只铁环，环上镶上一块高加索山上的石子</span>
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
