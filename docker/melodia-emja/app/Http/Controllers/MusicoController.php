<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Musico;

class MusicoController extends Controller
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
        //
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

      // Obtener contratos del músico
      public function verContrato($idMusico)
{
    $musico = Musico::with('contrato.restaurante')->find($idMusico);
    if (!$musico || !$musico->contrato) {
        return response()->json(['error' => 'Este músico no tiene contrato'], 404);
    }
    return response()->json($musico->contrato);
}

}
