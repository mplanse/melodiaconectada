<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'usuaris_idusuaris' => 'required|exists:usuaris,idusuaris',
        ]);

        $file = $request->file('imagen');
        $filename = time() . '_' . $file->getClientOriginalName();
        $ruta = $file->storeAs('public/multimedia', $filename);

        $multimedia = Multimedia::create([
            'nombre' => $filename,
            'ruta' => $ruta,
            'usuaris_idusuaris' => $request->usuaris_idusuaris,
        ]);

        return response()->json(['message' => 'Imagen guardada', 'data' => $multimedia], 201);
    }

    public function getUserImages($id)
    {
        $imagenes = Multimedia::where('usuaris_idusuaris', $id)->get();
        return response()->json($imagenes);
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
        //
    }
}
