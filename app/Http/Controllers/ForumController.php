<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class ForumController extends Controller
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
     * Show forums page
     * 
     */
    public function index() {
        $posts = Post::with('user', 'comments')->orderBy('created_at', 'desc')->get();
        return view('forum.forum', ['posts' => $posts] );
    }
    
    /**
     * Create a new post
     */
    public function create(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
        $post = Post::create($request->all());
        $post->user()->associate(Auth::user());
        $post->save();
        return back();
    }
}
