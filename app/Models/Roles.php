<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    //Table name
    protected $table = 'roles';

    protected $fillable = [
        'users',
        'role_name',
        'permission',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
