@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <?php
            $arr = array("a"=>8,"b"=>2,"d"=>4);
            $arr2 = array("a"=>8,"b"=>2,"e"=>5);
            print_r(array_diff($arr,$arr2));
            print_r(array_intersect($arr,$arr2));
            echo count($arr);
            print_r(array_chunk($arr,2));
            if(array_key_exists("d",$arr))
            {
                echo "key esit";
            }
            else
             {
                echo "no";
            }
            print_r(array_slice($arr,2));

            echo "<br>.....";

            $xxx = true;

            if (isset($xxx)){
                echo "\$xxx. isset....";
            }
                else{
                    echo "\$xxx.  no  set....";
                }

                if (empty($xxx)){
                    echo "\$xxx is emtpy.....";
                }
                    else{
                        echo "\$xxx.  no emtpy ....";
                    }


        ?>





        </div>
    </div>
</div>
@endsection
