<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('guest',['except' => 'destroy']);
    }


    //login
    public function create()
    {
      if(!session()->has('url.intended'))
      {
          session(['url.intended' => url()->previous()]);

      }
      return view('sessions.create');
      //return redirect("/");
    }

    public function destroy()
    {
      auth()->logout();
      session()->flash('success','成功退出~');
      return redirect('login');

      //return redirect()->back();
      //return redirect("/");
    }

    public function store()
    {
      if (! auth()->attempt(request(['email','password'])))
      {
        return back()->withErrors([
            'message' => '请输入正确的用户名和密码'
        ]);
      }

    
       $backRoute = session('url.intended');
       $backRoute = ($backRoute ? $backRoute :'/');
       return redirect($backRoute); //
        //return redirect()->home();
    }
}
