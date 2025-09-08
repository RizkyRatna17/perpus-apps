<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Books;
use App\Models\Borrows;
use Illuminate\Http\Request;
use App\Models\DetailBorrows;

class HomeController extends Controller
{
    public function index()
    {
        $totalBooks = Books::count();
        $totalStock = Books::sum('stok');

        //buku yang dipinjam
        //Nyari dari table detail_buku ada tidak buku yang sedang dipinjam , kalo ada actual_date nya= null
        //tampilkan semua data dari detail_borrow punya relasi ke ke book on book.id =detail_borrow.id_book
        //join borrow on borrows.id = detail_borrow.id_borrow WHERE actual_date = null

        $borrowedBooks = DetailBorrows::with('book', 'borrow')->whereHas('borrow', function ($q) {
            $q->whereNull('actual_return_date');
        })->count();


        //Buku yang sudah dikembalikan
        $returnBooks = Borrows::where('status', 0)->whereNotNull('actual_return_date')->count();
        $notReturnBooks = Borrows::where('status', 1)->whereNull('actual_return_date')->count();

        $fines = Borrows::with('member')->where('fine', '>', 0)->get();
        $totalFines = Borrows::sum('fine');

        return view('admin.dashboard', compact('totalBooks', 'totalStock', 'borrowedBooks', 'returnBooks', 'notReturnBooks', 'fines', 'totalFines'));
    }
}
