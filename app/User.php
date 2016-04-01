<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username','first_name','surname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * Get the comments of the user
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    /**
     * Get the posts of the user
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
