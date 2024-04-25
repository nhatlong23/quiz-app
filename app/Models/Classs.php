<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classs extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'class';
    protected $fillable = [
        'name',
        'desc',
        'block_id',
        'number',
        'status'
    ];

    public function block_class()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }
}
