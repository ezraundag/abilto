<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Post;
use App\User;
class CommentAcceptanceTest extends TestCase
{
    use DatabaseTransactions;
    
    protected $post;
    
    protected function setUp() {
        parent::setUp();
        $this->post = factory(Post::class)->create([
            'title' => 'Learn Laravel',
            'description' => 'Learn Laravel',
            'views'    =>   5
        ]);
        
    }    
    
     /** @test */
    public function submit_new_comment_to_post()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
               ->withSession(['user_session_token' => $user->user_session_token])
               ->visit('/post/'.$this->post->id)
               ->type('View video tutorials','comment')
               ->press('Post')
               ->see('View video tutorials');
    }
}
