<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'exam';
    protected $fillable = [
        'code',
        'content',
        'audio',
        'max_questions',
        'password',
        'opening_time',
        'closing_time',
        'duration',
        'subjects_id',
        'blocks_id',
        'status',
    ];

    //1 bai thi thuoc 1 mon hoc
    public function exam_subject()
    {
        return $this->belongsTo(Subject::class, 'subjects_id');
    }

    //1 bai thi thuoc 1 khoi
    public function exam_block()
    {
        return $this->belongsTo(Block::class, 'blocks_id');
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

    public function getFormattedOpeningTimeAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['opening_time'])->format('H:i:s d.m.Y');
    }

    public function getFormattedClosingTimeAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['closing_time'])->format('H:i:s d.m.Y');
    }
}
