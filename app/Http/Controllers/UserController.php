<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;



class UserController extends Controller
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
     * Show profile of user
     * 
     */
    public function index() {
        return view('user.profile');
    }
    
    /**
     * Update user's profile fields
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        $this->validate($request, [
            'username' => 'required|max:10|unique:users,'.Auth::id(),
            'email' => 'required|email|max:255|unique:users,'.Auth::id(),            
            'first_name' => 'required',
            'surname' => 'required',
        ]);
        Auth::user()->update($request->all());
        return back();
    }
}
