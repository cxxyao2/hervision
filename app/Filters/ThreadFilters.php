<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

class ThreadFilters extends Filters
{

  protected $filters = ['username','popular','unanswered','month','year','channel'];

  protected function username( $username)
  {
      $user = User::where('name',$username)->firstOrFail();
      return $this->builder->where('user_id',$user->id);

  }

  protected function channel( $channel_id)
  {
    return $this->builder->where('channel_id',$channel_id);

  }



  protected function popular()
  {
    $this->builder->getQuery()->orders = [];
    return $this->builder->orderBy('replies_count','desc');
  }


  protected function unanswered(){
    return $this->builder->where('replies_count',0);
  }


  protected function month( $month){
      //return $this->builder->whereMonth('created_at',Carbon::parse($month)->month);
      return $this->builder->whereMonth('created_at',$month);

  }


  protected function year( $year){
      return $this->builder->whereYear('created_at',$year);

  }

}
