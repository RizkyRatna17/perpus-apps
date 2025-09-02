<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Locations;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::orderBy('id', 'DESC')->get();

        return view('admin.buku.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Locations::all();
        $categories = Categories::all();

        return view('admin.buku.create', compact('locations', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'id_lokasi' => ['required'],
            'id_kategori' => ['required'],
            'judul' => ['required'],
            'pengarang' => ['required'],
            'penerbit' => ['required'],
            'tahun_terbit' => ['required'],
            'keterangan' => ['nullable'],
            'stok' => ['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        Books::create([
            'id_lokasi' => $request->id_lokasi,
            'id_kategori' => $request->id_kategori,
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'keterangan' => $request->keterangan,
            'stok' => $request->stok,

        ]);
        return redirect()->to('buku/index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $books = Books::find($id);
        $categories = Categories::all();
        $locations = Locations::all();
        return view('admin.buku.edit', compact('books', 'categories', 'locations'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $books = Books::find($id);
        $rules = [
            'id_lokasi' => ['required'],
            'id_kategori' => ['required'],
            'judul' => ['required'],
            'pengarang' => ['required'],
            'penerbit' => ['required'],
            'tahun_terbit' => ['required'],
            'keterangan' => ['nullable'],
            'stok' => ['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $books->id_lokasi = $request->id_lokasi;
        $books->id_kategori = $request->id_kategori;
        $books->judul = $request->judul;
        $books->pengarang = $request->pengarang;
        $books->penerbit = $request->penerbit;
        $books->tahun_terbit = $request->tahun_terbit;
        $books->keterangan = $request->keterangan;
        $books->stok = $request->stok;
        $books->save();

        return redirect()->to('buku/index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $books = Books::find($id);
        $books->delete();
        return redirect()->to('buku/index');

    }
}
