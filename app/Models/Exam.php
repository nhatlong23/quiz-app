<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'exam';
    protected $fillable = [
        'content',
        'audio',
        'max_questions',
        'password',
        'opening_time',
        'closing_time',
        'duration',
        'subjects_id',
        'status',
    ];

    //1 bai thi thuoc 1 mon hoc
    public function exam_subject()
    {
        return $this->belongsTo(Subject::class, 'subjects_id');
    }

    public function questions()
    {
        return $this->hasManyThrough(
            Question::class, // Model của bảng cuối cùng
            StandardizeQuestion::class, // Model của bảng trung gian
            'exam_id', // Khóa ngoại trong bảng trung gian
            'id', // Khóa chính trong bảng đích
            'id', // Khóa chính của model hiện tại
            'questions_id' // Khóa ngoại của model đích
        );
    }
}
