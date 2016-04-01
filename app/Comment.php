<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
      'comment'
    ];
    
    /**
     * Get the comments for a comment.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    /**
     * Get the comment to a comment.
     */
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
    
    /**
     * Get the post that owns the comment.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
