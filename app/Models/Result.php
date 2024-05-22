<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'result';
    protected $fillable = [
        'students_id',
        'exam_id',
        'point',
        'status',
    ];

    //1 ket qua thuoc 1 thi sinh
    public function result_student()
    {
        return $this->belongsTo(Student::class, 'students_id');
    }
    //1 ket qua thuoc 1 bai thi
    public function result_exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
    public function resultQuestions()
    {
        return $this->hasMany(ResultQuestion::class, 'students_id', 'students_id');
    }
}
