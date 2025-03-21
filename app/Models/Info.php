<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'infos';
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'map',
        'about',
        'terms_of_service',
        'privacy_policy',
        'logo',
        'favicon',
    ];
}
