<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $locations = Locations::orderBy('id', 'DESC')->get();
        return view('admin.lokasi.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lokasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Locations::create([
            'kode_lokasi' => $request->kode_lokasi,
            'label' => $request->label,
            'rak' => $request->rak
        ]);
        return redirect()->to('lokasi/index');
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
        $location = Locations::find($id);
        return view('admin.lokasi.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $location = Locations::find($id);
        $rules = [
            'kode_lokasi' => ['required'],
            'label' => ['required'],
            'rak' => ['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $location->kode_lokasi = $request->kode_lokasi;
        $location->label = $request->label;
        $location->rak = $request->rak;
        $location->save();
        return redirect()->to('lokasi/index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { $location = Locations::find($id);
        $location->delete();
        return redirect()->to('lokasi/index');

    }
}
