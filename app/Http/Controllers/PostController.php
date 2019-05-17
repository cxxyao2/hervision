<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Jobs\SendPostEmail;  
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
    public function index() {
        return view('jobs.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|min:6',
            'body'=> 'required|min:6',
        ]);
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        
        Log::info("request cycle begin");
       
        $this->dispatch((new SendPostEmail($post))->delay(60*5));; // 队列
        
        Log::info("request cycle ends");
       // SendPostEmail::dispatch($post)->delay(now()->addMinutes(5));
      
       
        return redirect()->back()->with('flash', 'Your post has been submitted successfully');
    }

}
