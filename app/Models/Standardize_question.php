<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standardize_question extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'standardize_question';
    protected $fillable = [
        'exam_id',
        'questions_id',
    ];
}
