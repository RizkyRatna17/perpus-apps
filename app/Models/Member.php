<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'nomor_anggota',
        'nik',
        'nama_anggota',
        'no_hp',
        'email'
    ];
}
