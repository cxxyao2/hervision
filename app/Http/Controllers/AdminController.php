<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Thread;
use ILLUMINATE\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('admin');

  }

    public function  index(){
      $users = [];
      $threads = [];
      return view("admin.index")->with(
      ['users' => $users,
      'threads' => $threads]
    );

    }


    public function onlinelist(){
      $users = User::all();
      $onlineusers = [];
      foreach( $users as $user){
        if (Cache::has('user-is-online-' . $user->id)){
          $onlineusers[$user->id]=$user->name;
        }
      }
      $guests = DB::table('guest_histories')->where('expiration','>=',Carbon::today())
        ->get();


      return view("admin.onlinelist")->with([
          'onlineusers' => $onlineusers,
          'onguests' => $guests
       ]);

    }

    public function usersearch($id)
    {
          // 0 id   1 name
          $searchType=substr($id,0,1);
          $searchCond=substr($id,1);


          if ($searchType == '0'){
              $users = User::where('id', $searchCond)
              ->get();
          }


          if ($searchType == '1'){
            $searchCond =  '%'.$searchCond.'%';
            $users = User::where('name', 'like', $searchCond)
            ->orderBy('created_at','desc')
            ->get();
          }

          return view('admin._userlist')->with([
              'users' => $users
          ]);

    }

    public function threadsearch($id){
      // 0 id 1 title 2 body
      // 0 id   1 name
      $searchType=substr($id,0,1);
      $searchCond=substr($id,1);


      if ($searchType == '0'){
          $threads = Thread::where('id', $searchCond)
          ->get();
      }


      if ($searchType == '1'){
        $searchCond =  '%'.$searchCond.'%';
        $threads = Thread::where('title', 'like', $searchCond)
        ->orderBy('created_at','desc')
        ->get();
      }

      if ($searchType == '2'){
        $searchCond =  '%'.$searchCond.'%';
        $threads = Thread::where('body', 'like', $searchCond)
        ->orderBy('created_at','desc')
        ->get();
      }

      return view('admin._threadlist')->with([
          'threads' => $threads
      ]);


    }

    public function deleteUser($userid){

      $user = User::findOrFail($userid);
      $user->delete();
      return $userid;
    }

    public function updateUser($id){

      $user = User::findOrFail($id);
      if( $user->locked == 0){
        $user->locked = 1;
        $user->save();
        $datas=[];
        $datas['id']=$user->id;
        $datas['lock']=1;
        return $datas;

      }
      if( $user->locked == 1){
        $user->locked = 0;
        $user->save();
        //return $user->id.' '.'0';
        $datas=[];
        $datas['id']=$user->id;
        $datas['lock']=0;
        return $datas;

      }

      return $user;

    }


    public function updateThread($id){

      $thread = Thread::findOrFail($id);
      if( $thread->locked == 0){
        $thread->locked = 1;
        $thread->save();
        $datas=[];
        $datas['id']=$thread->id;
        $datas['lock']=1;
        return $datas;

      }
      if( $thread->locked == 1){
        $thread->locked = 0;
        $thread->save();
        //return $user->id.' '.'0';
        $datas=[];
        $datas['id']=$thread->id;
        $datas['lock']=0;
        return $datas;

      }
    }


    public function deleteThread( $id){
      $thread = Thread::findOrFail($id);
      $thread->delete();
      return $id;

    }


}
