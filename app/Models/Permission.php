<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'permissions';
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'key_code'
    ];

    public function permissionChildren()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }
}