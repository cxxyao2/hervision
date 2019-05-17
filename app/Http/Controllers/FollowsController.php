<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use Illuminate\Support\Facades\DB;

class FollowsController extends Controller
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
    public function index()
    {
        //
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
    public function store($followed_id)
    {
            $follow = Follow::create([
              'following_id' => auth()->id(),
              'followed_id' => $followed_id
            ]);


            //return redirect('/');
            session()->flash(
              'message','关注成功!'
            );
            //return $follow;
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
    public function destroy($followed_id)
    {

        DB::table('follows')->where([
          ['followed_id', '=', $followed_id],
          ['following_id', '=', auth()->id()],
        ])->delete();

        if(request()->expectsJson()){
          return response(['status' => '关注 deleted']);
        }
        //return redirect()->route('threads.show', [$threadid]);
        return back();

    }



}
