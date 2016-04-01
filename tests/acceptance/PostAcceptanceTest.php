<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostAcceptanceTest extends TestCase
{
    use DatabaseTransactions;
    
     /** @test */
    public function submit_new_post()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user)
               ->withSession(['user_session_token' => $user->user_session_token])
               ->visit('/forum')
               ->type('Learn Laravel','title')
               ->type('Learn Laravel now','description')
               ->press('Post')
               ->see('Learn Laravel');
    }
}
