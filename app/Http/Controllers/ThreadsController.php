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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CreateThreadRequest;




class ThreadsController extends Controller
{

   /**
      ThreadsController constructor

   */

   public $visibelArray;
   public $commentArray;
   protected  $titlelen ;
   protected  $bodylen;

   public function __construct()
   {
     $this->middleware('auth')->except(['index','show','homepage']);
     $this->visibelArray = [0 => " all can see", 1 => "only auther"];
     $this->commentArray= [0 => " can comment", 1 => "no comment"];
     $this->titlelen = config('constants.thread_titlelen');
     $this->bodylen = config('constants.thread_bodylen');

   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel,ThreadFilters $filters)
    {

          $threads = $this->getThreads($channel, $filters);
          $threads = $threads->where('locked',0)
            ->where('visible_level',0);

          if (request()->wantsJson()){
            return $threads;
          }

          $trending = Thread::where('visits','>',0)
          ->where('locked',0)
          ->where('visible_level',0);

          if($channel->exists){
            $trending->where('channel_id',$channel->id);
          }
            $trending = $trending->orderBy('visits','desc')
                    ->take(config('constants.popular_article_rank'))
                    ->get();
        //  $trending=[];

          $threads = $threads->paginate(config('constants.threads_per_page'));
          return view('threads.index',[
            'threads' => $threads,
            'trending' => $trending
          ]);

    }

    public function homepage(){
      //每个channel各选最新的5条,
      $channels= Channel::all();
      $threadslist = [];
      foreach($channels as $channel){
        $threadslist[$channel->id] = Thread::where('channel_id',$channel->id)
            ->where('locked',0)
            ->where('visible_level',0)
            ->orderBy('created_at','desc')
            ->take(config('constants.threads_per_page'))
            ->get();

      }

      return  view('threads.homepage',[
        'threadslist' => $threadslist]);

    }



   public function getThreads(Channel $channel, ThreadFilters $filters)
   {
       $threads = Thread::latest()->filter($filters);

       if($channel->exists){
         $threads->where('channel_id',$channel->id);
       }

       //dd($threads->toSql());
       return $threads;

   }



    public function search(Request $request )
    {

          if(request()->has('searchCriteria'))
          {

          }else{
            return back();
          }

            //标题
          $body =  '%'.request('searchCriteria').'%';
          $threads = Thread::where('body', 'like', $body);
          $threads = $threads->where('threads.locked',0)
            ->where('threads.visible_level',0);
          $threads = $threads->paginate(config('constants.threads_per_page'));
          $viewname = 'threads.index';


          //内容
            if ( empty($threads)|| is_null($threads)|| ($threads->count()==0)){
            $title =  '%'.request('searchCriteria').'%';
            $threads = Thread::where('title', 'like', $body);
            $threads = $threads->where('threads.locked',0)
              ->where('threads.visible_level',0);
            $threads = $threads->paginate(config('constants.threads_per_page'));

          }

          //作者
          if (empty($threads)|| is_null($threads)|| ($threads->count()==0)){
            $author_name =  '%'.request('searchCriteria').'%';
            $threads = DB::table('threads')
             ->join('users', function ($join)
              {
                  $join->on('threads.user_id', '=', 'users.id');
             })
             ->where([
                 ['users.name','like',   $author_name]
             ])
             ->select('threads.*');
             $threads = $threads->where('threads.locked',0)
               ->where('threads.visible_level',0);
             $threads = $threads->paginate(config('constants.threads_per_page'));
             $viewname = 'threads.index_noeloq';
          }


        $trending = [];
        return view($viewname,[
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

        $data = [
          'visibelArray' => $this->visibelArray,
          'commentArray' => $this->commentArray
          ];

      return view('threads.create')->with($data);
    }


    public function createplus(){
      $data = [
        'visibelArray' => $this->visibelArray,
        'commentArray' => $this->commentArray
        ];

        return view('threads.createplus')->with($data);

    }



    public function createAccounting()
    {

      $currentDay = Carbon::now()->format('Y-m-d');
      $inCatagories  = AccountingItem::where('catagory_code','like','00%')->get();
      $outCatagories  = AccountingItem::where('catagory_code','like','01%')->get();
      $data = [
        'currentDay'   => $currentDay,
        'inCatagories' => $inCatagories,
        'outCatagories' => $outCatagories,
        'visibelArray' => $this->visibelArray,
        'commentArray' => $this->commentArray
        ];

      return view('threads.createAccounting')->with($data);
    }




    public function store(CreateThreadRequest $request )
    {

        $visibleLevel = 0;
        if ($request->has('visible_level')) {
          $visibleLevel = request('visible_level');
        }

        $canComment = 0;
        if ($request->has('can_comment')){
          $canComment = request('can_comment');
        }

        $body = request('body');
        $foreword = mb_substr($body,0,100);
        if (str_word_count($foreword)<str_word_count($body)) {
          $foreword = $foreword.'...';
        }

        $thread = Thread::create([
          'user_id' => auth()->id(),
          'channel_id' => request('channel_id'),
          'title' => request('title'),
          'body' => $body,
          'foreword' => $foreword,
          'replies_count' => 0,
          'visible_level' => $visibleLevel,
          'can_comment'  => $canComment
        ]);



        $tags = request('tags');
        if (!empty($tags)  && (count($tags) > 0)) {
             $thread->tags()->sync($tags);
         }


        session()->flash('flash','your thread has been published');

        return redirect('/threads');

    }


    public function storeFinance(Request $request)
    {
      //accounting_day,inout_flag,inout_catagory,inout_amount

      $this->validate(request(),[
        'accounting_day' => 'required',
        'inout_flag' => 'required',
        'inout_catagory' => 'required',
        'item_details' =>'max:50',
        'inout_amount' => 'required|max:6'
      ]);

      $visibleLevel = 0;
       if(request('visible_level')){
         $visibleLevel = request('visible_level');
       }

       $canComment = 0;
       if(request('can_comment')){
         $canComment = request('can_comment');
       }

       $body = request('inout_amount');
       $details = '';
       if(!empty(request('item_details')) && !is_null(request('item_details'))){
         $details = request('item_details');
         $body = $details.' '.request('inout_amount');
       }

      $catagoryName = AccountingItem::where('catagory_code','=',request('inout_catagory'))->pluck('catagory_name')->first();
      $foreword = substr($body,0,100);
      $thread = Thread::create([
        'user_id' => auth()->id(),
        'channel_id' => request('channel_id'),
        'title' => request('accounting_day').' '.$catagoryName,
        'body' => $body,
        'foreword' => $foreword,
        'replies_count' => 0,
        'visible_level' => $visibleLevel,
        'can_comment'  => $canComment
      ]);



        $bilan = Bilan::create([
          'user_id' => auth()->id(),
          'bilan_day' => request('accounting_day'),
          'inout_flag' => request('inout_flag'),
          'catagory_code' => request('inout_catagory'),
          'item_details' => $details,
          'item_amount' => request('inout_amount')
        ]);


        session()->flash('flash','your thread has been published');

        return redirect('/threads');



    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channelId, Thread $thread)
    {
        //return $thread->load('replies');
        //return $thread;
        //$key = sprintf("users.%s.visits.%s",auth()->id(),$thread->id);
        //cache()->forever($key,Carbon::now());
        if(auth()->check()){
            auth()->user()->read($thread);
        }

        //作者自己的访问不增加次数
        if(auth()->check()){
          if(!(auth()->user()->id == $thread->user_id)){
            $thread->increment('visits');
          }
        }


        $previousID = Thread::where('id','<',$thread->id)
        ->where('user_id',$thread->user_id)
        ->where('locked',0)
        ->where('visible_level',0)
        ->max('id');
        $previousThread = Thread::find($previousID);

        $nextId = Thread::where('id','>',$thread->id)
        ->where('user_id',$thread->user_id)
        ->where('locked',0)
        ->where('visible_level',0)
        ->min('id');
        $nextThread = Thread::find($nextId);
    return  view('threads.show',compact('thread','previousThread','nextThread'));

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {

         $visibelArray = $this->visibelArray;
         $commentArray = $this->commentArray;

        return view('threads.edit',compact('thread','visibelArray','commentArray'));

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
  //  public function update($channel, $thread)
    public function update( $channel,  Thread $thread)
    {

        $this->validate(request(),[
            'body' => 'required|max:'.$this->bodylen,
            'title' => 'required|spamfree|max:'.$this->titlelen,
        ]);

        $body = request('body');
        $foreword = mb_substr($body,0,100);
        if (str_word_count($foreword)<str_word_count($body)) {
        $foreword = $foreword.'...';
        }


        $thread->update([
        'body' => $body,
        'title' => request('title'),
        'foreword' => $foreword ]);

        if(request()->ajax()){
            return response(null,Response::HTTP_OK);
        }


        // the following updates other columns .advanced mode
        $channel_id = $thread->channel_id;
        if (request()->has('channel_id')) {
            $channel_id = request('channel_id');
        }


        $visibleLevel = $thread->visible_level;
        if (request()->has('visible_level')) {
            $visibleLevel = request('visible_level');
        }

        $canComment = $thread->can_comment;
        if (request()->has('can_comment')){
            $canComment = request('can_comment');
        }

        //标签处理
        $tags= request('tags');
    //    return dd($tags);



        DB::transaction(function () use ($thread,$tags,$channel_id,$visibleLevel,$canComment) {

            $thread->channel_id  = $channel_id;
            $thread->visible_level  = $visibleLevel;
            $thread->can_comment  = $canComment;
            $thread->save();
            $thread->tags()->sync($tags);

        });

        session()->flash('message','thead has updated successfully!');
        //  return back();
        return redirect('/threads/'.$thread->channel->slug);

      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel,Thread $thread)
    {
      $this->authorize('update',$thread);
      $thread->delete();
      //return redirect()->route('threads.show', [$threadid]);
      //return back();
      return redirect('/threads');

    }


}
