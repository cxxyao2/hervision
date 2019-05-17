<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Thread;
use App\User;
use Illuminate\Support\Facades\DB;


class TagsController extends Controller
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
    public function index( $userid, Tag $tag)
    {

         $threads = DB::table('threads')
         ->join('thread_tag', function ($join) {
             $join->on('thread_tag.thread_id', '=', 'threads.id');
         })
           ->join('tags', function ($join) {
               $join->on('tags.id', '=', 'thread_tag.tag_id');
           })
           ->where( 'threads.user_id','=', $userid)
           ->where( 'tags.id','=', $tag->id)
           ->select('threads.*');

           $threads = $threads->paginate(config('constants.threads_per_page'));
           $trending = [];

      return view('threads.index_noeloq',[
        'threads' => $threads,
        'trending' => $trending
      ]);

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
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
