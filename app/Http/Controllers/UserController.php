<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->orderBy('id', 'DESC')->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        Alert::success('BERHASIL!', 'Data berhasil ditambah');
        return redirect('user');
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
        $edit = User::find($id);
        return view('admin.user.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('passeord')) {
            $user->password = $request->password;

        }

        $user->save();
        Alert::success('BERHASIL!', 'Data berhasil diubah');
        return redirect()->to('user');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        Alert::success('BERHASIL!', 'Data berhasil dihapus');
        return redirect()->to('user');

    }

    public function editRole($id)
    {
        $roles = Roles::get();
        $user = User::find($id);
        return view('admin.user.add_role', compact('roles', 'user'));
    }

    public function updateRoles(Request $request, $id)
    {
        $user = User::find($id);
        $user->roles()->sync($request->roles ?? []);
        Alert::success('BERHASIL!', 'Data berhasil ditambahkan');
        return redirect()->to('user');

    }
}
