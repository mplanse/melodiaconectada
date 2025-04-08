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

    return response()->json(['restaurantes' => $restaurantes]);
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
            'idUsuario' => 'required|integer|exists:usuarios,idUsuario',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
        ]);

        $usuario = \App\Models\Usuario::find($validatedData['idUsuario']);

        if ($usuario && $usuario->musico) {
            $musico = $usuario->musico;
            $musico->lat = $validatedData['lat'];
            $musico->long = $validatedData['long'];
            $musico->save();

            return response()->json([
                'message' => 'Ubicación actualizada correctamente',
                'musico' => $musico,
            ]);
        } else {
            return response()->json([
                'message' => 'El usuario no es un músico registrado',
            ], 404);
        }
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
