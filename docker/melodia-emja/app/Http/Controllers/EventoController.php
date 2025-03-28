<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;
use App\Models\Evento; // Importa el modelo

class EventoController extends Controller
{
    /**
     * Mostrar una lista de eventos con paginación.
     */
    public function index()
    {
        $eventos = Evento::paginate(10);

        return view('eventos.index', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurantes = Restaurante::all();

        return view('eventos.create', compact('restaurantes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombreEvento' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'urlMultimedia' => 'nullable|url|max:255',
            'fecha' => 'required|date',
            'precio' => 'required|integer|min:0',
            'restaurantes_idRestaurante' => 'required|exists:restaurantes,idRestaurante',
        ]);

        // Crear el evento
        Evento::create([
            'nombreEvento' => $request->nombreEvento,
            'descripcion' => $request->descripcion,
            'urlMultimedia' => $request->urlMultimedia,
            'fecha' => $request->fecha,
            'precio' => $request->precio,
            'restaurantes_idRestaurante' => $request->restaurantes_idRestaurante,
        ]);

        // Redireccionar con un mensaje de éxito
        return redirect()->route('eventos.create')->with('success', '¡El evento ha sido creado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Evento::findOrFail($id);
        return response()->json($event);
    }
    public function evento_individual($id)
    {
        return view('eventos.evento_individual', compact('id'));
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
