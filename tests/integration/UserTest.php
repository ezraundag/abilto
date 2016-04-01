<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Post;
use App\Comment;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    
    protected $user;
    
    protected function setUp() {
        parent::setUp();
        $this->user = factory(User::class)->create([
            'username' => 'testcase',
            'first_name' => 'testfirstname',
            'surname' =>    'testsurname'
        ]);
    }
    
    /** @test */    
    public function user_has_user_name()
    {
        $this->assertEquals('testcase', $this->user->username);
    }    
    
    /** @test */    
    public function user_has_first_name()
    {
        $this->assertEquals('testfirstname', $this->user->first_name);
    }
    
    /** @test */    
    public function user_has_surname()
    {
        $this->assertEquals('testsurname', $this->user->surname);
    }
    
    /** @test */    
    public function user_has_many_posts()
    {
        $posts = factory( Post::class, 5 )->create();
        $this->user->posts()->saveMany( $posts );
        $this->assertCount( 5, $this->user->posts );
    }
    
    /** @test */    
    public function user_has_many_comments()
    {
        $comments = factory( Comment::class, 7 )->create();
        $this->user->comments()->saveMany( $comments );
        $this->assertCount( 7, $this->user->comments );
    }
    
    
}
