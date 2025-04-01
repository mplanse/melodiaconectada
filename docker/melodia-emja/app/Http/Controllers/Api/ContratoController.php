<?php

namespace App\Http\Controllers\api;

use App\Models\Musico;
use App\Models\Contrato;
use App\Models\Restaurante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContratoResource;


class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contrato = Contrato::with(['musico', 'restaurante'])->get();

        return ContratoResource::collection($contrato) ;
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'idMusico' => 'required|exists:musicos,idMusico',
        //     'idRestaurante' => 'required|exists:restaurantes,idRestaurante',
        //     'fechaContrato' => 'required|date',
        //     'precioContrato' => 'required|numeric|min:0'
        // ]);

        $contrato = Contrato::create([
            'idMusico' => $request->idMusico,
            'idRestaurante' => $request->idRestaurante,
            'fechaContrato' => $request->fechaContrato,
            'activo' => true,  // Se activa por defecto
            'precioContrato' => $request->precioContrato
        ]);

        $contrato = Contrato::with(['musico', 'restaurante'])->find($contrato->idContrato);
        return response()->json(['message' => 'Contrato creado exitosamente', 'contrato' => $contrato], 201);

    }
    /**
     * Display the specified resource.
     */
    public function show(Contrato $contrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contrato $contrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrato $contrato)
    {
        $contrato->delete();
        return response()->json(['message' => 'Contrato eliminado con éxito']);
    }
}
