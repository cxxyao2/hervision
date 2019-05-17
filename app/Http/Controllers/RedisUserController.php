<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Cookie ;

class RedisUserController extends Controller
{
    public function getHelloCookie($myname){

        $cookie = cookie('name', $myname, 10);
        return response('Hello World')->cookie($cookie);

    }

    public function getfunc(Request $request,$funcname)
    {

        $name = "";
        $name = $request->cookie('name');

        switch ($funcname)
        {
            case "getKeyValue":
                $redisvalue = self::getKeyValue("myname");
                break;
            case "incrKeyValue":
                $redisvalue = self::incrKeyValue("myname");
                break;
            case "delKey":
                $redisvalue = self::delKey("myname");
                    break;
            case "setKeyValue":
                $redisvalue = self::setKeyValue("mynewname",8888);
                break;
            case "zincrby":
                $redisvalue = (self::zincrby("sortedset",100));
                if(!empty($redisvalue)&&!is_null($redisvalue)){
                        $redisvalue =(json_encode($redisvalue));
                }

                break;
            case "zrevrange":
                $redisvalue = self::zrevrange("sortedset");
                if(!empty($redisvalue)&&!is_null($redisvalue)){
                        $redisvalue =(json_encode($redisvalue));
                }
                break;
            default:
                $redisvalue = "no records";


        }
        $redisvalue =  $redisvalue . " is   ". $name;
        return "<span id='redisrr'>" . $redisvalue . "</span>";
    }

    public function getKeyValue($keyid)
    {
        return Redis::get($keyid) ?? 0;
    }

    public function incrKeyValue($keyid)
    {
        Redis::incr($keyid);
        return self::getKeyValue($keyid);
    }

    public function delKey($keyid)
    {
        Redis::del($keyid);
        return  $keyid ." is deleleted";

    }
    public function setKeyValue($keyid,$keyvalue)
    {
        Redis::set($keyid, $keyvalue);
        return $keyid." is  ".self::getKeyValue($keyid);
    }

        //ZADD myzset 1 "one"
        //ZADD myzset 2 "two"
         //ZINCRBY myzset 2 "one"  有序集合
         //member 成员的新分数值，以字符串形式表示。数组myzet, 有两个成员,给其中一个加
        //ZINCRBY key increment member
    public function zincrby($myzet,$number)
    {

        Redis::zincrby($myzet,1,"0ne");
        Redis::zincrby($myzet,1,"two");
        Redis::zincrby($myzet,1,"three");
        Redis::zincrby($myzet,1,"four");
        Redis::zincrby($myzet,1,"five");
        Redis::zincrby($myzet,1,"six");

        return Redis::zrange($myzet,0,-1);
    }

    public function zrevrange($key)
    {
        //取出最大的5数值
        return  Redis::zrevrange($key,0,-1);

    }


}
