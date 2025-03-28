<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestauranteResource;
use App\Models\Restaurante;
use App\Models\Contrato;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class RestauranteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Restaurante=Restaurante::all();
        return RestauranteResource::collection($Restaurante);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurante $restaurante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurante $restaurante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurante $restaurante)
    {
        //
    }

    // Crear contrato
    public function crearContrato(Request $request)
    {
        $request->validate([
            'idMusico' => 'required|exists:musicos,idMusico',
            'idRestaurante' => 'required|exists:restaurantes,idRestaurante',
            'fechaContrato' => 'required|date',
            'precioContrato' => 'required|numeric|min:0'
        ]);

        $contrato = Contrato::create([
            'idMusico' => $request->idMusico,
            'idRestaurante' => $request->idRestaurante,
            'fechaContrato' => $request->fechaContrato,
            'activo' => true,
            'precioContrato' => $request->precioContrato
        ]);

        return response()->json(['message' => 'Contrato creado correctamente', 'contrato' => $contrato]);
    }

    // Cancelar contrato
    public function cancelarContrato($idContrato)
    {
        $contrato = Contrato::findOrFail($idContrato);
        $contrato->activo = false;
        $contrato->save();

        return response()->json(['message' => 'Contrato cancelado correctamente']);
    }
}
