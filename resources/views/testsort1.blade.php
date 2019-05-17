@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <?php
            $arr1 = array(2,4,10,21,6);
            $cnt = count($arr1) - 1;
            for($i = $cnt ;$i >= 0; $i--)
            {
                for($j = 0;  $j < $i ; $j++)
                {
                    if ( $arr1[$i] < $arr1[$j] )
                    {
                        $aa = $arr1[$i];
                        $arr1[$i] = $arr1[$j];
                        $arr1[$j] = $aa ;
                    }
                }
            }
         echo     dd($arr1);
    ?>



        </div>
    </div>
</div>
@endsection
