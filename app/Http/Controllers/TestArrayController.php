<?php

namespace App\Http\Controllers;


use App\Models\Thread;
use App\Models\AccountingItem;
use App\Models\Channel;
use App\Models\Bilan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Filters\ThreadFilters;
use Carbon\Carbon;
use App\Rules\SpamFree;
use App\User;
use DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CreateThreadRequest;



class TestArrayController extends Controller
{
    //

    public function test1(){
        dd(phpinfo());
       $thread = Thread::with('replies')->find(4);
        // array
        return $thread->makeHidden('title')->toArray();
       // $threads = Thread::all();
        //return $threads;
    }
}
