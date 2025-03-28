<?php

namespace App\Http\Controllers\Api;

use App\Models\Musico;
use App\Models\Restaurante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapController extends Controller
{

    public function obtenerCoordenadas()
    {
        $musicos = Musico::all();

        return response()->json(['musicos' => $musicos,]);
    }

    public function obtenerDirecciones()
{
    $restaurantes = Restaurante::all();

    // Procesar cada restaurante para agregar coordenadas (opcional)
    $restaurantesConDatos = $restaurantes->map(function ($restaurante) {
        return [
            'id' => $restaurante->usuarios_idUsuario,
            'direccion' => $restaurante->direccion,
        ];
    });

    return response()->json(['restaurantes' => $restaurantesConDatos]);
}
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     // Obtener los músicos con sus coordenadas y datos relacionados
    //     $musicos = Musico::with('usuario')->get();

    //     // Pasar los datos a la vista Blade
    //     return view('index', compact('musicos'));
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
        ]);

        $musico = Musico::create($validatedData);

        return response()->json([
            'message' => 'Marcador guardado correctamente',
            'musico' => $musico,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
