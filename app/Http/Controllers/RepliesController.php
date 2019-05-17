<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Reply;
use App\User;
use App\Notifications\YouWereMentioned;
use Illuminate\Support\Facades\Gate;

class RepliesController extends Controller
{
    public function __construct()
    {
      $this->middleWare('auth',['except' => 'index']);

    }

    public function index($channelId, Thread $thread){
      return $thread->replies()->paginate(config('constants.replis_per_page'));
    }


    public function update(Reply $reply)
    {
      $this->authorize('update',$reply);

      try{
          $this->validate(request(),['body' => 'required|spamfree']);

          // $spam->detect
        //  resolve(Spam::class)->detect(request('body'));


          $reply->update(request(['body']));

          //return back()->with('flash','reply has updated');
      }catch(\Exception $e){
          return response(
            'Sorry,your reply could not be saved',422
          );
      }



    }

    public function store($channelId,Thread $thread)
    {

        try{

              //  $this->authorize('create',new Reply);
              if(Gate::denies('create',new Reply)){
                return response(
                  'You are posting too frequently,please wait a while',422
                );

              }

          $this->validate(request(),['body' => 'required|spamfree']);

          //$lastReply = Reply::where('user_id',auth()->id())->latest()->first();


          $reply = $thread->addReply([
              'body' => request('body'),
              'user_id' => auth()->id()
            ]);

            preg_match_all('/\@([^\s\.]+)/',$reply->body,$matches);
            $names = $matches[1];
            foreach($names as $name){
              $user = User::whereName($name)->first();
              if($user){
                $user->notify(new YouWereMentioned($reply));
              }
            }


          }catch(\Exception $e){

            return response('sorry, you cannot save the reply this time',422);
          }


          if(request()->expectsJson()){
            return $reply->load('owner');
          }

          return back()->with('flash','Your reply has been left');


    }

    //对回复的点评,还是放在原来的thread下面TODO
    //此处设计是一个小的弹窗，双重循环的评论会分页等变得复杂，暂时没做
    public function commentStore( $replyId)
    {
      return dd($replyId);
      $reply = Reply::findOrFail($replyId);
      $thread = Thread::findOrFail($reply->thread_id);
      $commentForReply =$thread->addReply([
        'thread_id' => $reply->thread_id,
        'parent_id' => $replyId,
        'body' => json_encode([
          'fromTo'  => auth()->id().'to'.$reply->user_id,
          'message' => request('body')
        ]),
        'user_id' => auth()->id()
      ]);


      return $commentForReply->load('owner');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // For a route with the following URI: profile/{id}

      $reply = Reply::findOrFail($id);
      $this->authorize('update',$reply);
      $threadid =  $reply->thread_id;
      $reply->delete();

      if(request()->expectsJson()){
        return response(['status' => 'Reply deleted']);
      }

      //return redirect()->route('threads.show', [$threadid]);
      return back();
    }



}
