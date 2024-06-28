<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = [
        'content',
        'name',
        'email',
        'blogs_id',
        'likes',
        'parent_comment_id',
        'status',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blogs_id');
    }
}
