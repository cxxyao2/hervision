<?php

namespace App\Http\Controllers;

use App\Trending;
use Illuminate\Http\Request;
use App\Models\Pollj;
use App\Models\Channel;
use App\Models\PollRecordj;
use App\Models\Thread;
use  Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PolljController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */



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
      $polljs = Pollj::latest()
      ->paginate(config('constants.threads_per_page')); //时间最晚的,放在前面

      return view('polls.index',compact('polljs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('polls.create');
    }


    public function store(Request $request)
    {

        $pollItemCount = 0;
        $this->validate(request(),[
            'polltitle' => 'required',
            'pollcontent' => 'required',
            'polldate' => 'required'

        ]);


        $pollj = new Pollj;
        $pollj->title = request("polltitle");
        $pollj->content =  request("pollcontent");
        $pollj->single_mul = request("single_mul");
        $max_select = request('mul_maxnum');
        if (empty($max_select)||is_null($max_select)){
          $max_select = 0;
        }
        $pollj->mul_maxnum= $max_select;//多选时最多选择几个
        $pollj->end_time = request("polldate");

        //获得一个选项数组,如果选项内容不为空,那么,写入到数据库
        if ( request('pollid') )
        {
            $pollItemCount = 1;
            foreach(request('pollid') as $key )
            {
                if ($key <> '')
                {
                  $pollj["option".$pollItemCount] = $key;
                  $pollj["option_votes".$pollItemCount] = 0; //票数
                  $pollItemCount = $pollItemCount + 1;
                }

            }
        }

        $pollj->user_id = auth()->id();
        $pollj->save();

        $body = request("pollcontent").
          "  <a href='/polls/" . $pollj->id . "/edit'> 点击参与投票 </a>";


        $thread = Thread::create([
          'user_id' => auth()->id(),
          'channel_id' => request('channel_id'),
          'title' => request("polltitle"),
          'body' => $body,
          'foreword' => $body,
          'replies_count' => 0,
          'visible_level' => 0,
          'can_comment'  => 0
        ]);


        $channel_slug = Channel::findOrFail(request('channel_id'))->slug;

        return redirect()->route('threads.index',['channel_id' => $channel_slug]);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $pollj = Pollj::find($id);
      $isNotVoted = DB::table('poll_recordjs')
            ->where([
           ['pollj_id','=', $id],
           ['user_id','=',auth()->id()]
           ])
           ->get()
           ->isEmpty();

      //截止日期未到
      $dateEndIni = Carbon::parse($pollj->end_time);
      $dateEnd = $dateEndIni->format('Y-m-d');
      $notExpired = $dateEnd >= (Carbon::now()->format('Y-m-d'));
      return view('polls.show',compact('pollj','isNotVoted','notExpired'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $pollj = POllj::find($id);
      $isNotVoted = DB::table('poll_recordjs')
            ->where([
           ['pollj_id','=', $id],
           ['user_id','=',auth()->id()]
           ])
           ->get()
           ->isEmpty();

      //截止日期未到
      $dateEndIni = Carbon::parse($pollj->end_time);
      $dateEnd = $dateEndIni->format('Y-m-d');
      $notExpired = $dateEnd >= (Carbon::now()->format('Y-m-d'));
      return view('polls.edit',compact('pollj','isNotVoted','notExpired'));
    }


    public function showPollTitle($id){
      $pollj = POllj::find($id);
      return view('polls.showPollTitle',compact('pollj'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pollj $pollj)
    {

      //必须最少选择1个
        $this->validate(request(),[
            'optionid' => 'required|array',
            'optionid.*' =>["required","min:1"]
        ]);


        $id = $pollj->id;
        $looper = 0;
        //多选时只统计到允许的最多选项

        foreach(request('optionid') as $key=>$value)
        {
            //多选的场合
              if ($pollj->single_mul == 1){
                if ( $looper >= $pollj->mul_maxnum){
                  break;
                }else{
                  $looper = $looper + 1;
                }
              }

             //取出数值
             $i = $value;
             $optionname = "option_votes".$i;
             $j = $pollj->$optionname;
             $j = $j + 1;
             //修改一列等于另外一列update (['order_status' => 5,'pay_money' => \DB::raw('total_price')]);
             Pollj::where(['id' => $id])->update ([ $optionname => $j]);


               $pollrecordj = new PollRecordj;
               $pollrecordj->pollj_id =  $id;
               $pollrecordj->user_id = auth()->id();
               $pollrecordj->optionid = $value;
               $pollrecordj->approve_disa = 1;
               $pollrecordj->save();
           }



        //显示投票结果
        //  return view('polls.edit',compact('pollj','isNotVoted','notExpired'));
            return back();
        //return redirect()->route('polls.show',compact('pollj'));


}








    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //detele /pollj/{id}
    }
}
