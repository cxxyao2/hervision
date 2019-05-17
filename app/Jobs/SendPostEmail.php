<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Models\Post;

class SendPostEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $post;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data= array(
            'title'=> $this->post->title,
            'body'=> $this->post->body,
           );
        // emails.post 对应的视图文件模板
        Mail::send('emails.post', $data, function($message){
            $message->from('408379dc23-077222@inbox.mailtrap.io', 'Queues');
            $message->to('cxxyao2@gmail.com')->subject('There is a new post');
        });

    }
}
