<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBorrows extends Model
{
    protected $fillable = [
        'id_borrow',
        'id_buku',
    ];

    //relation orm ke table borrows
    public function borrow()
    {
        return $this->belongsTo(Borrows::class, 'id_borrow', 'id');
    }
    public function book()
    {
        return $this->belongsTo(Books::class, 'id_buku', 'id');
    }

}
