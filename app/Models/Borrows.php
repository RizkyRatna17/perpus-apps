<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrows extends Model
{
    use SoftDeletes;

    protected $fillable =[
        'id_anggota',
        'trans_number',
        'return_date',
        'note',
        'status',
    ];
    protected $date =['delete_at'];

    public function detailBorrows(){
        return $this->hasMany(DetailBorrows::class, 'id_borrow','id');
    }

    public function member(){
        return $this->belongsTo(Member::class, 'id_anggota', 'id');
    }
}
