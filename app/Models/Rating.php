<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'ratings';
    protected $fillable = [
        'blogs_id',
        'rating',
        'ip_rating',
    ];
}
