<?php

namespace App\Models;
use App\User;
use App\Models\Pollj;

use Illuminate\Database\Eloquent\Model;

class PollRecordj extends Model
{

  public function user()
  {
    return $this->belongsTo(User::class);
  }


  public function pollj()
  {
    return $this->belongsTo(Pollj::class,'pollj_id');
  }

}
