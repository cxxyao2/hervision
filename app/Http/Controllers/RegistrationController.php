<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mail\PleaseConfirmYourEmail;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    //
    public function create()
    {
        return view('Registration.create');
    }

    public function store()
    {

      //validated
      $this->validate(request(),[
          'name' => 'required|unique:users,name',
          'email' => 'required|email|unique:users,email',
          'password' => 'required|confirmed'
      ]);
      //create users
      $user =  new User;
      $user->name = request('name');
      $user->email = request('email');
      $user->password = bcrypt(request('password'));
      $user->confirmation_token = str_random(25);
      $user->save();
      //lgoin in
      auth()->login($user);

      //  邮件已经测试成功 todo
      // Mail::to($user)->send(new Welcome($user));
      // Mail::to($user)->send(new WelcomeAgain($user));
     Mail::to($user)->send(new PleaseConfirmYourEmail($user));


      //session & flash messages
      session()->flash('message','谢谢登录!');


      //redirect
      return redirect('/home');
      //return redirect()->home();
    }

    public function confirm() {
        try {
            User::where('confirmation_token', request('token'))
            ->firstOrFail()
            ->confirm();
        } catch ( \Exception $e) {
            return redirect('/home')
            ->with('flash', 'unknown token');
        }

         return redirect('/home')
         ->with('flash', 'Your account is now confirmed! You may post to the forum');

    }
}
