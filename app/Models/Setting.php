<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'settings';
    protected $fillable = [
        'name',
        'desc',
        'key_name',
        'key_value',
        'key_value_end',
    ];
}
