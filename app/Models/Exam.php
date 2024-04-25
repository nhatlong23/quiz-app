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
}
