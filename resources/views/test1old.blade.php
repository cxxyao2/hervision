@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php
            class Car
    {
      var $color;
      function __construct($color="green") {
        $this->color = $color;
      }
      function what_color() {
        return $this->color;
      }
    }
    //区分大小写的常量，默认大小写敏感false
    define("GREE","欢迎");
    echo GREE . "jane";
    print "<br>";
    echo strlen("good world");
    print "<br>";
    echo strpos("hello world","wor");
    echo "<br>";
    $zzz = 16 % 3;
    $yyyy = intdiv(10, 4);
    $x = array("a" => "red","b" => "green");
    var_dump( $x == $yyyy);
    echo "yyyy is " . $yyyy;
    echo "<br>";
    //不区分大小写的常量,第三个参数是大小写
    define("Gree1","test不问",false);
    echo Gree1;
    echo "<br>";

    $test = '菜鸟教程';
// 普通写法
$username = isset($test) ? $test : 'nobody';
echo $username, PHP_EOL;

$username = $_GET['user'] ?? 'nobody';
echo $username;
echo "<br>";
echo (bool)0;

 $t = date("H");
 if ($t < 10)
 {
     echo "good morning";
 }
 else
 {
     echo "good evening";
 }

 $favor = "red";
 switch ($favor)
 {
     case "red":
        echo "you like red";
        break;
    case "green":
        echo "you like green";
        break;
    default:
        echo "life is colorful";

 }
 $cars = array("vol","xxx");
 echo count($cars);
 $age=array("pepeter" => 25,"mike" => 20,"alike"=>40);
 ksort($age);
 foreach($age as $key=>$value)
 {
     echo "key" . $key ." " . $value;
     echo "<br>";
 }



echo $_SERVER['PHP_SELF'];
echo "<br>";

    ?>



        </div>
    </div>
</div>
@endsection
