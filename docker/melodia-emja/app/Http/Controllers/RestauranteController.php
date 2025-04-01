<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Models\Restaurante;
use App\Models\Musico;
class RestauranteController extends Controller
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

    public function contrato()
{
    return $this->hasOne(Contrato::class, 'idRestaurante', 'idRestaurante');
}

public function mostrarFormularioContrato()
{
    $musicos = Musico::all(); // Obtener todos los músicos disponibles
    return view('formularioContrato', compact('musicos'));
}

public function crearContrato(Request $request)
{
    $request->validate([
        'idMusico' => 'required|exists:musicos,idMusico',
        'idRestaurante' => 'required|exists:restaurantes,idRestaurante',
        'fechaContrato' => 'required|date',
        'precioContrato' => 'required|numeric|min:0'
    ]);

    // Verificar que el restaurante o el músico no tengan contrato activo
    $restaurante = Restaurante::find($request->idRestaurante);
    $musico = Musico::find($request->idMusico);

    if ($restaurante->contrato()->exists() || $musico->contrato()->exists()) {
        return redirect()->back()->with('error', 'Este restaurante o músico ya tienen un contrato.');
    }


    $contrato = Contrato::create([
        'idMusico' => $request->idMusico,
        'idRestaurante' => $request->idRestaurante,
        'fechaContrato' => $request->fechaContrato,
        'activo' => true,
        'precioContrato' => $request->precioContrato
    ]);

    return redirect()->route('contrato.formulario')->with('success', 'Contrato creado correctamente');
}

public function cancelarContrato($idContrato)
{
    $contrato = Contrato::findOrFail($idContrato);
    $contrato->activo = false;
    $contrato->save();

    return redirect()->route('contrato.formulario')->with('success', 'Contrato cancelado correctamente');
}
}
