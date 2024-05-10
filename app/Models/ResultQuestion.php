<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultQuestion extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'result_question';
    protected $fillable = [
        'question_id',
        'students_id',
        'exam_id',
        'selected_option',
        'is_correct',
    ];
    
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'students_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}
