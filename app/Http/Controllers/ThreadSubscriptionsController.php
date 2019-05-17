<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThreadSubscription;
use App\Models\Thread;
use Illuminate\Support\Facades\DB;
use App\User;

class ThreadSubscriptionsController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');

  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $userid)
    {

      $threads = DB::table('threads')
       ->join('thread_subscriptions', function ($join)
        {
            $join->on('threads.id', '=', 'thread_subscriptions.thread_id');
       })
       ->where([
           ['thread_subscriptions.user_id','=', $userid]
       ])
       ->select('threads.*')
       ->paginate(config('constants.threads_per_page'));


       return view('threads.index_noeloq')->with(['threads' => $threads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($channelId, Thread $thread)
    {
      $sub = new ThreadSubscription;
      $sub->thread_id =  $thread->id;
      $sub->user_id = auth()->id();
      $sub->save();
      //return redirect('/');
      session()->flash(
        'message','your subscription has been saved successfully'
      );
      return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($channelId, Thread $thread)
    {
        $thread->unsubscribe();
    }
}
