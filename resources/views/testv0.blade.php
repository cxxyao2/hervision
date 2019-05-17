@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <?php
            $arr = array(8,2,4,10,21,6,9);

            function qs($a,$s=0, $e=null)
            {

                if($e === null){
                    $e = count($a);
                }

                if($s >= $e){
                    var_dump($s . " ". $e);
                    return $a;

                }

                $j = $e - 1;
                $i = $s;
                $n = $a[$s];
                for(;$j >$i;$j--){
                    if($a[$j] <$n){
                        $t = $a[$i];
                        $a[$i] =$a[$j];
                        $a[$j] = $t;
                        for($i++;$i<$j;$i++){
                            if($a[$i]>$n){
                                $t =  $a[$j];
                                $a[$j] = $a[$i];
                                $a[$i] =  $t;
                                break;
                            }
                        }
                    }
                }
                qs($a,$s,$i);
                qs($a,$i+1,$e);
                return $a;

            }

        echo "\n" . implode($arr, ".");
        echo "<br>";
        echo '这是第 " '  . __LINE__ . ' " 行';
        echo '该文件位于 " '  . __FILE__ . ' " ';
        echo '该文件位于 " '  . __DIR__ . ' " ';
        echo "\n" . implode(qs($arr) , ".");

    ?>





        </div>
    </div>
</div>
@endsection
