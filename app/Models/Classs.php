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
    //quan hệ 1 lớp học có nhiều học sinh
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function standardizeExams()
    {
        return $this->hasMany(Standardize_Exam::class, 'class_id', 'id');
    }
}
