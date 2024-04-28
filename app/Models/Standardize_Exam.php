<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standardize_Exam extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'standardize_exam';
    protected $fillable = [
        'exam_id',
        'class_id',
    ];
}
