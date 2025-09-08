<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Books;
use App\Models\Member;
use App\Models\Borrows;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\DetailBorrows;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrows = Borrows::with('member', 'detailBorrows')->orderBy('id', 'desc')->get();
        return view('admin.pinjam.index', compact('borrows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //    get data dari model (get sama all sama)
        $kode = "PJM";
        $today = Carbon::now()->format('Ymd');
        $prefix = $kode . "-" . $today;
        $lastTransaction = Borrows::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
        if ($lastTransaction) {
            $lastNumber = (int) substr($lastTransaction->trans_number, -3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }
        $trans_number = $prefix . $newNumber;
        $members = Member::get();
        $categories = Categories::get();
        return view('admin.pinjam.create', compact('members', 'categories', 'trans_number'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        // dia bakal nyimpen data dulu sampe berhasil

        try {
            $insertBorrow = Borrows::create([
                'id_anggota' => $request->id_anggota,
                'trans_number' => $request->trans_number,
                'return_date' => $request->return_date,
                'note' => $request->note,
            ]);
            foreach ($request->id_buku as $key => $value) {
                DetailBorrows::create([
                    'id_borrow' => $insertBorrow->id,
                    'id_buku' => $request->id_buku[$key],
                ]);
            }
            DB::commit();
            Alert::success('BERHASIL!', 'Transaksi berhasil dibuat');


            return redirect()->route('print-peminjam', ['id' => $insertBorrow->id]);

        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Upsss!!', $th->getMessage());

            //    return redirect()->to('transaction');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $borrow = Borrows::with('detailBorrows.book', 'member')->find($id);
        return view('admin.pinjam.show', compact('borrow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $borrow = Borrows::find($id);
        $borrow->detailBorrows()->delete();
        $borrow->delete();
        return redirect()->to('transaction');

    }
    public function getBukuByIdCategory($id_category)
    {
        try {
            $books = Books::where('id_kategori', $id_category)->get();
            return response()->json([
                'status' => 'success',
                'message' => 'fetch book success',
                'data' => $books
            ]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }
    }

    public function print($id_borrow)
    {
        $borrow = Borrows::with('member', 'detailBorrows.book')->find($id_borrow);
        return view('admin.pinjam.print', compact('borrow'));
    }

    public function returnBook(Request $request, $id)
    {
        $borrow = Borrows::findOrFail($id); // hasilnya 404
        //  $borrow = Borrows::find($id); //hasilnya blank

        if (!$borrow->actual_return_date) {
            $fine = 0;
        }
        $returnDate = \Carbon\Carbon::parse($borrow->return_date)->startOfDay();
        $actualReturnDate = \Carbon\Carbon::parse($borrow->actual_return_date)->startOfDay();

        if ($actualReturnDate->greaterThan($returnDate)) {
            $late = $returnDate->diffInDays($actualReturnDate);
            $fine = $late * 10000;
        }
        // $borrow->actual_return_date = now();
        $borrow->actual_return_date = Carbon::now();
        $borrow->fine = $fine;
        $borrow->status = 0;
        $borrow->save();
        Alert::success('Berhasil', 'Buku berhasil dikembalikan');
        return redirect()->to('transaction');

    }
}
