<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Follow extends Model
{
  protected $guarded =[];

  //获取你关注的人的信息
  public function myDetails()
  {
    return $this->belongsTo('App\User','followed_id');
  }


}
