<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'questions';
    protected $fillable = [
        'question',
        'picture',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'answer',
        'subject_id',
        'level_id',
        'block_id',
        'status',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }
}
