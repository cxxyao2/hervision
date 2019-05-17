<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAvatarController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function store(Request $request)
    {
      //'photo' => 'mimes:jpeg,bmp,png'
      $this->validate(request(),[
        'avatar' =>  'required|max:1024|image|mimes:jpeg,png'
      ]);

      auth()->user()->update([
        'avatar_path' => request()->file('avatar')->store('avatars','public')
      ]);

      return back();
    }
}
