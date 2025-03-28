<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
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
    // Obtener el usuario autenticado
    $usuario = auth()->user();

    // Obtener el restaurante asociado al usuario
    $restaurante = $usuario->restaurante;

    // if (!$restaurante) {
    //     return view('eventos.create')->with('error', 'No tienes un restaurante asociado. Por favor, crea un restaurante antes de crear un evento.');
    // }

    // Pasar el restaurante a la vista
    return view('eventos.crear_eventos', compact('restaurante'));
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
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar imagen (opcional, máximo 2MB)
        'fecha' => 'required|date',
        'precio' => 'required|integer|min:0',
        'restaurantes_idRestaurante' => 'required|exists:restaurantes,idRestaurante',
    ]);

    // Guardar la imagen en la tabla multimedia (si se proporcionó)
    $multimediaId = null;
    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen');
        $nombreImagen = time() . '_' . $imagen->getClientOriginalName(); // Generar un nombre único
        $rutaImagen = $imagen->storeAs('public/imagenes', $nombreImagen); // Guardar en storage/app/public/imagenes
        $rutaImagen = str_replace('public/', '', $rutaImagen); // Obtener la ruta relativa

        // Crear una entrada en la tabla multimedia
        $multimedia = Multimedia::create([
            'url' => $rutaImagen,
            'idPropietario' => auth()->id(), // Asociar con el usuario autenticado
        ]);

        // Obtener el ID de la entrada creada
        $multimediaId = $multimedia->idmultimedia;
    }

    // Crear el evento
    Evento::create([
        'nombreEvento' => $request->nombreEvento,
        'descripcion' => $request->descripcion,
        'urlMultimedia' => $multimediaId, // Guardar el ID de la entrada en multimedia
        'fecha' => $request->fecha,
        'precio' => $request->precio,
        'restaurantes_idRestaurante' => $restaurante->idRestaurante,
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
