<?php

namespace App\Models;
use App\Models\PollRecordj;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Pollj extends Model
{
    //
    public function pollrecordj()
    {
      return $this->hasMany(PollRecordj::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }



}
