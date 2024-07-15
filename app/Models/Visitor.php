<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'visitors';
    protected $fillable = [
        'ip_address',
        'user_agent',
        'last_activity',
        'students_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'students_id');
    }
}
