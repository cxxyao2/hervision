<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Activity;
use App\Models\Follow;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Notifications\textMessage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;



class ProfilesController extends Controller
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


    public function deleteUser($id){
      //id, threads, replies, bilans,
      $user = User::findOrFail($id);
      $userName = $user->name;
      $user->delete();
      return back()->with('flash','user/'.$userName. 'has been deleted');
    }

    public function lockUser($id){

      $user = User::findOrFail($id);
      $user->locked();
      return back()->with('flash','user/'.$user->name. 'has been locked');
    }

    public function unlockUser($id){
      $user = User::findOrFail(request('loginUserId'));
      $user->unlocked();
      return back()->with('flash','user/'.$user->name. 'has been locked');

    }


    public function textMessage(Request $request)
    {

        $folowedId = request('followedId');

        $textContent = request('textContent');
        $fan = User::findOrFail(auth()->id());
        $vlogger = User::findOrFail($folowedId);
        if($vlogger){
          $vlogger->notify(new textMessage($fan,$vlogger,$textContent));
        //  $user->notify(new InvoicePaid($invoice));
        }

        return back()->with('flash','私信发送成功！');

    }

    public function download(Request $request,User $user)
    {
      //创建文件
        $datas = DB::table('threads')
                     ->select('title','body')
                     ->where('user_id', '=', $user->id)
                     ->get();
        $content = "";
        foreach( $datas as $data){
          $content = $content . mb_convert_encoding($data->body, 'UTF-8');
        }

        $filename = "tempfile.csv";
        // print(chr(0xEF).chr(0xBB).chr(0xBF));
         $headers = [
             'Content-Encoding'    => 'UTF-8',
             'Content-Type'        => 'text/csv;charset=UTF-8'
         ];

        Storage::disk('public')->put($filename, $content);

      //下载文件
      //Storage::download('file.jpg', $name, $headers);
      return Storage::disk('public')->download($filename, 'mythreads.csv', $headers);

      //  return response()->download($pathToFile)->deleteFileAfterSend();

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
    public function show(User $user)
    {
        Log::info("用户xxx登录成功",['user_id'=>$user->id]);
        Log::channel('slack')->info('Something happened!');
        Log::warning("disk not eaough");
        return view('profiles.show',[
          'profileUser' => $user
       ]);

    }



    // postgre db for heroku
    protected function getuserstat(User $user)
    {
        //必须是管理员或者本人
        //判断cache中是否有数据,有就取cache,没有就取数据库，
        //默认保留5分钟
        if  (auth()->user()->isAdmin() ||((auth()->user()->id === $user->id) && !auth()->user()->islocked())){

        }else{
        return back()->withErrors('you are not authorized to use this function');
        }

        //Cache::flush();
        $minutes= config('constants.profile_expire_minute');

        //按月统计发帖数
        $factors = Cache::remember($user->name.'_factors', $minutes, function () use($user) {
        return DB::table('threads')
         ->select('channel_id',  DB::raw("date_part('month', created_at) month1"),
         DB::raw("date_part('year', created_at) year1"),DB::raw("count(id) as published"))
         ->groupBy('channel_id','month1','year1')
         ->where('user_id', '=', $user->id)
         ->get();
         });

        //总发帖数,访问数,收到的评论
        $indicators = Cache::remember($user->name.'_indicators', $minutes, function () use($user) {
        return DB::table('threads')
        ->select(DB::raw("count(id) publishcnt, sum(visits) visitcnt,sum(replies_count) replycnt"))
        ->where('user_id', '=', $user->id)
        ->groupBy('user_id')
        ->get();
        });


        //评论收到的赞,
        $favoritecnt = Cache::remember($user->name.'_favoriteCnt', $minutes, function ()  use($user){
         return DB::table('favorites')
          ->join('replies', function ($join)
           {
               $join->on('replies.id', '=', 'favorites.favorited_id');
          })
          ->where([
              ['favorites.favorited_type','like', '%Reply%'],
              ['replies.user_id','=', $user->id]
          ])
          ->select('favorites.id')
          ->get()
          ->count();
        });



        //您的收藏
        $subs = Cache::remember($user->name.'_subs', $minutes, function ()  use($user) {
           return DB::table('thread_subscriptions')
                ->where( 'user_id','=', $user->id)
                ->get();
         });

        //被收藏
        $besubs = Cache::remember($user->name.'_besubs', $minutes, function () use($user) {
           return DB::table('thread_subscriptions')
             ->join('threads', function ($join) {
                 $join->on('thread_subscriptions.thread_id', '=', 'threads.id');
             })
             ->where( 'threads.user_id','=', $user->id)
             ->selectRaw('thread_subscriptions.thread_id,count(thread_subscriptions.thread_id) subcnt')
             ->groupBy('thread_subscriptions.thread_id')
             ->get();
         });


        //理财统计  channel_id=3  $finances
        //收入
        //支出
        $yearmonth1 = Cache::remember($user->name.'_yearmonth', $minutes, function () use($user) {
            return DB::table('bilans')
                      ->selectRaw("date_part('year',bilan_day) year1,
                      date_part('month',bilan_day) month1")
                      ->where('user_id',$user->id)
                      ->groupBy('year1','month1')
                      ->get();
            });

        $ins1 = Cache::remember($user->name.'_ins', $minutes, function () use($user) {
            return DB::table('bilans')
                      ->selectRaw("date_part('year',bilan_day) year1,
                      date_part('month',bilan_day) month1,
                      sum(item_amount) insum")
                      ->where([
                          ['user_id','=',$user->id],
                          ['inout_flag','=',0]
                      ])
                      ->groupBy('year1','month1')
                      ->get();
          });

        $outs1 = Cache::remember($user->name.'_outs', $minutes, function () use($user) {
             return DB::table('bilans')
                       ->selectRaw("date_part('year',bilan_day) year1,
                       date_part('month',bilan_day) month1,
                       sum(item_amount) outsum")
                       ->where([
                           ['user_id','=',$user->id],
                           ['inout_flag','=',1]
                       ])
                       ->groupBy('year1','month1')
                       ->get();
           });

        $finances = array();

         foreach($yearmonth1 as $yearmonth){
            $year1 = $yearmonth->year1;
             $month1 = $yearmonth->month1;
             $in1 = 0;
             $out1 = 0;
              $inthismonth = $ins1->where('year1',$year1)->where('month1',$month1)->first();
             if(!empty($inthismonth)&&(!is_null($inthismonth))){
                  $in1 = $inthismonth->insum;
               }
              $outthismonth = $outs1->where('year1',$year1)->where('month1',$month1)->first();
              if(!empty($outthismonth)&&(!is_null($outthismonth))){
                 $out1 = $outthismonth->outsum;
              }

             array_push($finances, collect([
                          'year' => $year1,
                          'month' => $month1,
                          'insum' => $in1,
                          'outsum' => $out1,
                          ])) ;
         }

        //你关注的人
        $followings = Cache::remember($user->name.'_followings', $minutes, function () use($user) {
        return Follow::with('myDetails')
        ->where('following_id','=',$user->id)
        ->get();
        });

        //你的粉丝
        $fans = Cache::remember($user->name.'_fans', $minutes, function () use($user) {
        return Follow::where('followed_id','=',$user->id)
        ->get();
        });


        //常用标签
        $mytags = Cache::remember($user->name.'_mytags', $minutes, function () use($user){
        return DB::table('threads')
        ->join('thread_tag', function ($join) {
         $join->on('thread_tag.thread_id', '=', 'threads.id');
        })
        ->join('tags', function ($join) {
           $join->on('tags.id', '=', 'thread_tag.tag_id');
        })
        ->where( 'threads.user_id','=', $user->id)
        ->select('tags.id' , 'tags.name', DB::raw('count(threads.id) articlecnt'))
        ->groupBy('tags.id', 'tags.name')
        ->get();
        });


        $userstatis=[];
        $userstatis['indicators'] =   $indicators;
        $userstatis['favoritecnt'] =   $favoritecnt;
        $userstatis['subs'] =   $subs;
        $userstatis['besubs'] =   $besubs;
        $userstatis['finances'] =   $finances;
        $userstatis['followings'] =   $followings;
        $userstatis['fans'] =   $fans;
        $userstatis['mytags'] =   $mytags;
        $userstatis['factors'] =   $factors;
        return  $userstatis;



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userstatmain(User $user)
    {
        $userstatis = $this->getuserstat($user);
        $indicators = $userstatis['indicators'] ;
        $favoritecnt = $userstatis['favoritecnt'] ;
        $subs    = $userstatis['subs'] ;
        $besubs   = $userstatis['besubs']  ;
        $finances = $userstatis['finances']  ;
        $followings  = $userstatis['followings'] ;
        $fans  = $userstatis['fans'] ;
        $mytags  = $userstatis['mytags'] ;
        $factors = $userstatis['factors'];
        $lastthread = Thread::where('user_id',$user->id)
         ->orderBy('created_at', 'desc')
         ->first();

         return view('profiles.userstatmain',[
            'profileuser' => $user,
            'indicators' => $indicators,
            'favoritecnt' => $favoritecnt,
            'subs' => $subs,
            'besubs'=> $besubs,
            'finances' => $finances,
            'followings' => $followings,
            'fans' => $fans,
            'mytags' => $mytags,
            'factors'=>$factors,
            'thread' => $lastthread
        ]);


    }




   public function getbyuserfinance( User $user,Channel $channel,$year,$month)
   {

     $userstatis = $this->getuserstat($user);
     $indicators = $userstatis['indicators'] ;
     $favoritecnt = $userstatis['favoritecnt'] ;
     $subs    = $userstatis['subs'] ;
     $besubs   = $userstatis['besubs']  ;
     $finances = $userstatis['finances']  ;
     $followings  = $userstatis['followings'] ;
     $fans  = $userstatis['fans'] ;
     $mytags  = $userstatis['mytags'] ;
     $factors = $userstatis['factors'];

     $threads =Thread::where('user_id',$user->id)
       ->where('channel_id',3)
       ->orderBy('created_at', 'desc')
       ->get();

        $catagorysum = DB::table('bilans')
            ->leftJoin('accounting_items', 'bilans.catagory_code', '=', 'accounting_items.catagory_code')
              ->select(DB::raw('accounting_items.catagory_code as acccode'),
              DB::raw('accounting_items.catagory_name as category'),
              DB::raw('sum(bilans.item_amount) as number'))
              ->where('bilans.user_id',$user->id)
              ->groupBy('acccode','category')
              ->get();


       return view('profiles.userstatfinance',[
         'profileuser' => $user,
         'indicators' => $indicators,
          'favoritecnt' => $favoritecnt,
          'subs' => $subs,
          'besubs'=> $besubs,
          'finances' => $finances,
          'followings' => $followings,
          'fans' => $fans,
          'mytags' => $mytags,
          'factors'=>$factors,
          'threads' => $threads,
          'catagorysum' => $catagorysum
      ]);

   }
    public function getbyuserdate( User $user,Channel $channel,$year,$month)
    {

      $userstatis = $this->getuserstat($user);
      $indicators = $userstatis['indicators'] ;
      $favoriteCnt = $userstatis['favoritecnt'] ;
      $subs    = $userstatis['subs'] ;
      $besubs   = $userstatis['besubs']  ;
      $finances = $userstatis['finances']  ;
      $followings  = $userstatis['followings'] ;
      $fans  = $userstatis['fans'] ;
      $mytags  = $userstatis['mytags'] ;
      $factors = $userstatis['factors'];

      $trending= [];
      //取得本月第一天和最后一天
      $dateStart= Carbon::create($year, $month, 1, 0, 0, 0);
      $dateEnd= Carbon::create($year, $month+1, 1, 0, 0, 0);
      $threads = Thread::where('channel_id',$channel->id)
              ->where('user_id',$user->id)
              ->where('created_at','>=', $dateStart)
              ->where('created_at','<', $dateEnd);

      $threads = $threads->paginate(config('constants.threads_per_page'));
      return view('profiles.userstatthreadlist',[
        'profileuser' => $user,
        'threads' => $threads,
        'trending' => $trending,
        'indicators' => $indicators,
         'favoritecnt' => $favoriteCnt,
         'subs' => $subs,
         'besubs'=> $besubs,
         'finances' => $finances,
         'followings' => $followings,
         'fans' => $fans,
         'mytags' => $mytags,
         'factors'=>$factors
      ]);

    }



    protected function getActivity(User $user)
    {
        return $user->activity()->latest()->with('subject')->take(50)->get()->groupBy(function($activity){
        return $activity->created_at->format('Y-m-d');
      });
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

      $user = User::findOrFail(request('loginUserId'));
      $this->validate(request(),[
        'name' => 'required|string|max:255',
        'personal_profile' => 'string|max:50',
        'password' => 'required|string|min:6|confirmed'
      ]);

      $user->name = request('name');
      $user->personal_profile = request('personal_profile');
      if(request('locale')){
          $user->locale = request('locale');
      }


      if ($user->password !== request('password')) {

           $user->password = Hash::make(request('password'));
      }


      $user->save();
      session()->flash('message', 'Update successfully!');
      return back();


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

   
   protected function getuserstat_mysql(User $user)
   {
     //必须是管理员或者本人
     //判断cache中是否有数据,有就取cache,没有就取数据库，
     //默认保留5分钟
     if  (($user->isAdmin()) ||(auth()->check()&& !auth()->user()->islocked())){

     }else{
       return back()->withErrors('you are not authorized to use this function');
     }

     Cache::flush();
     $minutes= config('constants.profile_expire_minute');

     //按月统计发帖数
     $factors = Cache::remember($user->name.'_factors', $minutes, function () use($user) {
           return DB::table('threads')
             ->selectRaw('year(created_at) year1,month(created_at) month1,channel_id,count(id) published')
             ->where('user_id', '=', $user->id)
             ->groupBy('year1','month1','channel_id')
             ->get();
             });

     //总发帖数,访问数,收到的评论
     $indicators = Cache::remember($user->name.'_indicators', $minutes, function () use($user) {
           return DB::table('threads')
           ->selectRaw('count(id) publishcnt, sum(visits) visitcnt,sum(replies_count) replycnt')
           ->where('user_id', '=', $user->id)
           ->groupBy('user_id')
           ->get();
         });

     //评论收到的赞,
     $favoritecnt = Cache::remember($user->name.'_favoriteCnt', $minutes, function ()  use($user){
           return DB::table('favorites')
            ->join('replies', function ($join)
             {
                 $join->on('replies.id', '=', 'favorites.favorited_id');
            })
            ->where([
                ['favorites.favorited_type','like', '%Reply%'],
                ['replies.user_id','=', $user->id]
            ])
            ->select('favorites.id')
            ->get()
            ->count();
         });


     //理财统计  channel_id=3
    $finances = Cache::remember($user->name.'_finances', $minutes, function () use($user) {
        return DB::table('bilans')
               ->selectRaw('year(bilan_day) year,month(bilan_day) month,sum(case when inout_flag=0 then item_amount end) insum,sum(case when inout_flag=1 then item_amount end) outsum')
               ->where('user_id',$user->id)
               ->groupBy('year','month')
               ->get();
        });



     //您的收藏
     $subs = Cache::remember($user->name.'_subs', $minutes, function ()  use($user) {
           return DB::table('thread_subscriptions')
                ->where( 'user_id','=', $user->id)
                ->get();
         });

     //被收藏
     $besubs = Cache::remember($user->name.'_besubs', $minutes, function () use($user) {
           return DB::table('thread_subscriptions')
             ->join('threads', function ($join) {
                 $join->on('thread_subscriptions.thread_id', '=', 'threads.id');
             })
             ->where( 'threads.user_id','=', $user->id)
             ->selectRaw('thread_subscriptions.thread_id,count(thread_subscriptions.thread_id) subCnt')
             ->groupBy('thread_subscriptions.thread_id')
             ->get();
         });





       //你关注的人
       $followings = Cache::remember($user->name.'_followings', $minutes, function () use($user) {
             return Follow::with('myDetails')
             ->where('following_id','=',$user->id)
             ->get();
           });

       //你的粉丝
       $fans = Cache::remember($user->name.'_fans', $minutes, function () use($user) {
             return Follow::where('followed_id','=',$user->id)
             ->get();
           });



       //常用标签
       $mytags = Cache::remember($user->name.'_mytags', $minutes, function () use($user){
             return DB::table('threads')
             ->join('thread_tag', function ($join) {
                 $join->on('thread_tag.thread_id', '=', 'threads.id');
             })
               ->join('tags', function ($join) {
                   $join->on('tags.id', '=', 'thread_tag.tag_id');
               })
               ->where( 'threads.user_id','=', $user->id)
               ->selectRaw('tags.id , tags.name, count(threads.id) articlecnt ')
               ->groupBy('tags.id', 'tags.name')
               ->get();
           });


       $userstatis=[];
       $userstatis['indicators'] =   $indicators;
       $userstatis['favoritecnt'] =   $favoritecnt;
       $userstatis['subs'] =   $subs;
       $userstatis['besubs'] =   $besubs;
       $userstatis['finances'] =   $finances;
       $userstatis['followings'] =   $followings;
       $userstatis['fans'] =   $fans;
       $userstatis['mytags'] =   $mytags;
       $userstatis['factors'] =   $factors;

       return  $userstatis;

   }

}
