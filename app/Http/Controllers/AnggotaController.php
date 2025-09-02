<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //SELECT * FROM members;
        $members = Member::all();
        return view('admin.anggota.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastId = DB::table('members')->max('id') ?? 0;
        $newId = $lastId + 1;

        $pref = 'MEMBER';
        $date = now()->format('d-m-Y');
        $counter = str_pad($newId, 5, '0', STR_PAD_LEFT);
        $code = "{$pref}-{$date}-{$counter}";

        return view('admin.anggota.create', compact('code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rulles = [
            'nomor_anggota' => ['required'],
            'nik' => ['required', 'numeric'],
            'nama_anggota' => ['required'],
            'no_hp' => ['required', 'unique:members'],
            'email' => ['required', 'unique:members'],
        ];
        $validators = Validator::make($request->all(), $rulles);
        if ($validators->fails()) {
            return back()->withErrors($validators)->withInput();
        }
        Member::create([
            'nomor_anggota' => $request->nomor_anggota,
            'nik' => $request->nik,
            'nama_anggota' => $request->nama_anggota,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);
        return redirect()->to('anggota/index');
    }
    public function softDelete(string $id)
    {
        $member = Member::find($id);
        $member->delete();
        return redirect()->to('anggota/index');
    }
    public function indexRestore()
    {
        $member_r = Member::onlyTrashed()->get();
        return view('admin.anggota.restore.restore', compact('member_r'));
    }
    public function restore(string $id)
    {

        $member = Member::withTrashed()->find($id);
        $member->restore();
        return redirect()->to('anggota/index');
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
        //IBARATNYA : SELECT * FROM members WHERE id = $id
        $member = Member::find($id);
        return view('admin.anggota.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member = Member::find($id);
        $rulles = [
            'nomor_anggota' => ['required'],
            'nik' => ['required', 'numeric'],
            'nama_anggota' => ['required'],
            'no_hp' => ['required'],
            'email' => ['required'],
        ];
        $validators = Validator::make($request->all(), $rulles);
        if ($validators->fails()) {
            return back()->withErrors($validators)->withInput();
        }
        // $member->fill($request->all());
        $member->nomor_anggota = $request->nomor_anggota;
        $member->nik = $request->nik;
        $member->nama_anggota = $request->nama_anggota;
        $member->no_hp = $request->no_hp;
        $member->email = $request->email;
        $member->save();
        return redirect()->to('anggota/index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Member::withTrashed()->find($id);
        $member->forceDelete();
        return redirect()->to('anggota/index');
    }
}
