<?php
setcookie("user", "runoob", time()+3600);
session_start();
$_SESSION['view']=1;
?>
<html>
<head></head>
<body>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">



        <?php
        $c1 = array("hello","hi");
        $d1 = &$c1;
        define("GREETING","WELCOME HUMAN");

        const CONNECTOK = 1;
        var_dump(CONNECTOK);
        ECHO "<br>";
        var_dump(GREETING);
ECHO "<br>";
        var_dump($d1);


        function func1(){
            echo __FUNCTION__,"\n";
        }

        $b = "func1";
        $b();
        echo "<br>";
        echo GREETING;
        class cas1
        {
            private $name1;
            public function __construct($name1){
                $this->name1 = $name1;
                echo $this->name1;
            }
        }
        $obj1 = new cas1("jennifer is excel");

        class cas2
        {
            private $name1;
            public function __construct(){
                echo "<br>";
                echo "world gets better";
            }
        }
        $obj2 = new cas2;
        ?>



        <?php
        class MyDestructableClass {
           function __construct() {
               print "构造函数\n";
               $this->name = "MyDestructableClass";
           }

           function __destruct() {
               print "销毁 " . $this->name . "\n";
           }
        }

        $obj = new MyDestructableClass();


         class MyClass
{
    const constant = '常量值1';
public static $my_static = 'foo';
    public function __construct(){
        echo "hello,yao" ;
    }
    function showConstant() {
        echo  self::constant . PHP_EOL;
    }
}

echo MyClass::constant . PHP_EOL;
echo "<br>";
$newMy = new MyClass;

echo "<br>";
echo MyClass::$my_static . PHP_EOL;

class test222 extends MyClass{
    public function __construct(){
         parent::__construct();
        echo "taitai" ;
    }

}

$new2 = new test222();
  $cxx1 = "<br>hi";
   echo $cxx1;
    $cxx2 = htmlspecialchars($cxx1,ENT_COMPAT);

    echo $cxx2;

    if (preg_match("/^[a-zA-Z ]*$/","country governet ctiyomen", $match1)) {
        var_dump($match1);
}

echo date("Y-M-d ");

echo "<br>";

 if (isset($_COOKIE['user1'])){
     echo "welcome" . $_COOKIE['user'];
 }else{
     echo "hahah";
 }
 echo "<br>";
 echo "clicks" . $_SESSION['view'];
 unset($_SESSION['view']);
 session_destroy();

function customError($errno, $errstr){
    echo "<b>Error</b> [$errno]  $errstr";
}

set_error_handler("customError");

 //$file=fopen("welcome.txt","r");
  $test = 2;
  if ($test > 1){
      trigger_error("test must <1 ");
  }

        ?>







        </div>
    </div>
</div>
</body>
</html>
