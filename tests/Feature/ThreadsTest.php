<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }
    /** @test */
    public function browse_threads(){

        $response = $this->get('/threads');
        $response->assertStatus(200);
    }


    /** @test */
    public function thread_title(){
        $thread = factory('App\Models\Thread')->create();
        $response = $this->get('/threads/');
        $response->assertSee($thread->title);
    }


}
