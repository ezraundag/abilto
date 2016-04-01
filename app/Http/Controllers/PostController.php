<?php

namespace App\Http\Controllers;
use Auth;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Http\Requests;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }   
    
    /**
     * Shows individual post page
     * 
     * @param Post $post
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Post $post) {
        return view('forum.post',[
            'post'  => $post->load(['comments' => function ($query) {
                            $query->orderBy('created_at', 'desc');
                        },'user'])
            ]);
    }
    
    /**
     * Submits comment to a post
     * 
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comment(Request $request, Post $post) {
        $this->validate($request, [
            'comment' => 'required'
        ]);
        $comment = Comment::create($request->all());
        $comment->user()->associate( Auth::user() );
        $post->comments()->save( $comment );
        return back();
    }
}
