<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Post;
use App\Comment;
use App\User;

class PostTest extends TestCase
{
    use DatabaseTransactions;
    
    protected $post;
    protected $user;
    
    protected function setUp() {
        parent::setUp();
        $this->post = factory(Post::class)->create([
            'title' => 'This is a title.',
            'description' => 'This is a description',
            'views'    =>   5
        ]);
        
        
        $this->user = factory(User::class)->create([
            'username' => 'testcase',
            'first_name' => 'testfirstname',
            'surname' =>    'testsurname'
        ]);
    }
    
    /** @test */
    public function post_has_title() {
        $this->assertEquals('This is a title.', $this->post->title);
    }
    
    /** @test */
    public function post_has_description() {
        $this->assertEquals('This is a description', $this->post->description);
    }
    
    /** @test */
    public function post_has_views() {
        $this->assertEquals(5, $this->post->views);
    }
    
    /** @test */
    public function post_has_many_comments() {
        $comments = factory( Comment::class, 3 )->create();
        $this->post->comments()->saveMany( $comments );
        $this->assertEquals( 3, $this->post->comments()->count() );
    }
    
    /** @test */
    public function post_is_created_by_user() {   
        $this->post->user()->associate( $this->user );
        $this->post->save();
        $this->assertEquals( 'testcase', $this->post->user->username );
    }
}
