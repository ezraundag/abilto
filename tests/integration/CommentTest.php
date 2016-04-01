<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Comment;
use App\Post;
use App\User;

class CommentTest extends TestCase
{
    use DatabaseTransactions;
    
    protected $comment;
    protected $post;
    
    protected function setUp() {
        parent::setUp();
        
        $this->comment = factory(Comment::class)->create([
            'comment' => 'This is a comment.'
        ]);
        
        $this->post = factory(Post::class)->create([
            'title' => 'This is a post.',
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
    public function has_comment() {
        $this->assertEquals('This is a comment.', $this->comment->comment);
    }
    
    /** @test */
    public function comment_belongs_to_a_post() {
        $this->comment->post()->associate( $this->post );
        $this->comment->save();
        $this->assertEquals('This is a post.', $this->comment->post->title );
    }
    
    /** @test */
    public function comment_is_entered_by_a_user() {
        $this->comment->user()->associate( $this->user );
        $this->assertEquals('testcase', $this->comment->user->username );
    }
    
    /** @test */
    public function comment_has_many_comments() {
        $comments = factory(Comment::class,8)->create();
        $this->comment->comments()->saveMany( $comments );
        $this->assertEquals( 8, $this->comment->comments()->count() );
    }
    
    /** @test */
    public function comment_has_a_parent_comment() {
        $comment = factory(Comment::class)->create();
        $this->comment->comments()->save( $comment );
        $this->assertEquals( $this->comment->id, $comment->comment_id );
    }
}
