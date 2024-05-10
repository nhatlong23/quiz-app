<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandardizeQuestion extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'standardize_question';
    protected $fillable = [
        'exam_id',
        'questions_id',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'questions_id', 'id');
    }
}
