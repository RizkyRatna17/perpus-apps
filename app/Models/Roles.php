<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'user_id', 'user_roles');
    }
}
