<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'slug',
        'content',
        'images',
        'status'
    ];

    public function relatedPosts()
    {
        return $this->where('status', $this->status)
            ->where('id', '!=', $this->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }
}
