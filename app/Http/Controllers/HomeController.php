<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Borrows;

use Illuminate\Http\Request;
use App\Models\DetailBorrows;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $totalBook = Books::count();
        $totalStock = Books::sum('stok');

        // nyari dari detail_Book ada tidak buku yang sedang di pinjam, actual_date = null;
        // select * from detailBorrows join book on book.id = detail_borrow.id_book
        // join borrow on borrow.id = detail_borrows.id_borrow WHERE actual_date = null
        $diPinjam = DetailBorrows::with('book', 'borrow')->whereHas('borrow', function ($q) {
            $q->whereNull('actual_return_date');
        })->count();
        // $sisaDipinjam =

        $returnBooks = Borrows::where('status', 0)->whereNotNull('actual_return_date')->count();
        $notReturnBooks = Borrows::where('status', 1)->whereNull('actual_return_date')->count();

        $fines = Borrows::with('member')->where('fine', '>', 0)->get();
        $totalFines = Borrows::sum('fine');
        return view('admin.dashboard', compact('title', 'totalBook', 'totalStock', 'diPinjam', 'returnBooks', 'notReturnBooks', 'fines', 'totalFines'));
    }

    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return redirect('/login');
    // }
}
