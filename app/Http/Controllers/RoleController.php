<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Roles::orderBy('id', 'DESC')->get();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Roles::create([
            'name' => $request->name,
        ]);
        Alert::success('BERHASIL!', 'Data berhasil ditambah');
        return redirect('role');
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
        $edit = Roles::find($id);
        return view('admin.role.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $roles = Roles::find($id);
        $roles->name = $request->name;
        $roles->save();
        Alert::success('BERHASIL!', 'Data berhasil diubah');
        return redirect()->to('role');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Roles::find($id)->delete();
        Alert::success('BERHASIL!', 'Data berhasil dihapus');
        return redirect()->to('role');

    }
}
