<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'students';
    protected $fillable = [
        'student_code',
        'name',
        'gender',
        'birth',
        'class_id',
        'school_year',
        'images',
        'password',
        'cccd',
        'phone',
        'email',
        'status',
    ];

    //1 thí sinh thuoc 1 lop
    public function student_class()
    {
        return $this->belongsTo(Classs::class, 'class_id');
    }
}
