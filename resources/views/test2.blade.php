@extends ('layouts.app')
@section ('content')
<div>
            <ul>
                <li>
                    <lable><button id="getKeyValue">getKeyValue: </button></label>
                </li>
                <li>
                    <lable><button id="incrKeyValue">incrKeyValue: </button></label>
                </li>
                <li>
                    <lable><button id="delKey">delKey: </button></label>
                </li>
                <li>
                    <lable><button id="setKeyValue">setKeyValue: </button></label>
                </li>
                <li>
                    <lable><button id="zincrby">zincrby: </button></label>
                </li>
                <li>
                    <lable><button id="zrevrange">zrevrange: </button></label>
                </li>

            </ul>
    </div>

    <div>
     <label>set cookies as  your name : <input id="inname"></label>
    </div>

    <br>
    <label>the following is return value of redis</lable>
    <div  id="divUsers" style="width:30%;height:30%;color:blue;background-color:#E6E6FA;border:2px solid dark;">
        <span id="redisrr">empty</span>
    </div>
    @endsection

    @section ('js')
        <script type="text/javascript" src="{{URL::asset('/js/redis.js')}}"></script>
    @endsection
