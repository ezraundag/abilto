<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
      'title',
      'description'
    ];
    
    /**
     * Get the comments for the blog post.
     * 
     * @return Collection Comment
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    /**
     * Get the user that owns the post.
     * 
     * #return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Returns count of comments to a post
     * 
     * @return int
     */
    public function commentsCount() {
        return $this->comments()->count();
    }
    
}
