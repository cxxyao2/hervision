<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Thread;
Use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{

    /** @test */
    public function login(){
        $response = $this->post('api/login',['email' => 'tester@example.com',
        'password' => 'password']);
        $accessToken = $response->content();
        $strarr = json_decode($accessToken, true);
        $stoke = $strarr['data']['token'];
        $response->assertStatus(200);

    }


    /** @test */
    public function an_authorised_user_can_update_post()
    {

//         $user = User::find(31);
//         $this->be($user);

//         $thread = Thread::find(1);
//         $post =  Post::find(1);
//         $body = "首先是饥荒，接着是劳苦和疾病，争执和创伤，还有破天荒可怕的死亡；他颠倒着季侯的次序，轮流地降下了，狂雪和猛火，把那些无遮无盖的人们";

//         $request = $this->actingAs($user,'api')
//         ->put('api/thread/'.$thread->id.'/post/'.$post->id,
//         ['body' => $body]);

        $response = $request->send();

        $this->assertEquals(200, $response->getStatusCode());

    }

    /** @test */
    public function user_can_register() 
    {
        $response =  $this->post('/register', [
            'name' => 'steve199',
            'email' => 'seb199@steve130.com',
            'password' => '123456',
            'password_confirmation'=> '123456'
        ]);
       //  dd($response);
        $user = User::whereName('steve199')->first();
        $this->assertEquals(0,$user->confirmed);
        
        // let the user confirm their account
        $response = $this->get('/register/confirm?token='. $user->confirmation_token);

        // $response = $this->get(route('register.confirm',['token' =>$user->confirmation_token] ));    register.confirm web.php  /register/confirm
     
        $this->assertEquals(1,$user->fresh()->confirmed);

        $response->assertRedirect('/home');


        tap($user->fresh(), function ($user) {
            $this->assertEquals(1,$user->fresh()->confirmed);
            $this->assertNull($user->confirmation_token);
        });


    }
}
