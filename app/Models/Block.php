<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'blocks';
    protected $fillable = [
        'name',
        'desc',
        'status'
    ];
}
