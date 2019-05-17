<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserNotificationsController extends Controller
{


    protected $notifyTypes;



    public function __construct()
    {
      $this->middleware('auth');
      $this->notifyTypes = [
        '订阅更新' => 'App\Notifications\ThreadWasUpdated',
        '新回复' => 'App\Notifications\YouWereMentioned',
        '站内私信' => 'App\Notifications\textMessage',
        '系统通知'=> 'App\Notifications\System'
      ];


    }



    public function notifyAllTypes($user)
    {


        $notificationsByType = [];

        foreach($this->notifyTypes as $key1=>$val1){
          $notificationsByType[$key1]=auth()->user()->unreadNotifications->where('type', $val1);
        }


      return view("profiles.notifyAllTypes")->with(
        ['notifyTypes' => $this->notifyTypes ,
        'notifications' => $notificationsByType]
      );

    }

    public function notifyType($user,$notifyType)
    {

        $first = DB::table('notifications')
          ->whereNull('read_at');
        $notifications = DB::table('notifications')
          ->whereColumn([
            ['notifiable_type','=',$notifyType],
            ['notifiable_id','=',$user->id]
            ])
          ->union($first)
          ->orderBy('created_at', 'desc')
          ->paginate(5);;

      return view("profiles.notifyType")->with('notifications');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()->unreadNotifications;
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

       $this->destroy($userid, $notificationId);
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
    public function destroy(User $user, $notificationId)
    {

        auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();
        return back();
    }
}
