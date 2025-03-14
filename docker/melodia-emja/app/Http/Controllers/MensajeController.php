<?php

namespace App\Http\Controllers;
use App\Models\Mensaje;
use App\Models\Usuario;
use Illuminate\Http\Request;

class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = $request->input('user_id', 1); // Default to user 1

        $usuarios = Usuario::all();

        $mensajes = Mensaje::where(function ($query) use ($userId) {
            $query->where('origen_usuarios_idUsuario', $userId)
                ->orWhere('destino_usuarios_idUsuario', $userId);
        })->orderBy('timestamp', 'desc')->get();

        return view('mensajes.index', compact('mensajes', 'usuarios', 'userId'));
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
        $validatedData = $request->validate([
            'origen_usuarios_idUsuario' => 'required|integer',
            'destino_usuarios_idUsuario' => 'required|integer',
            'mensaje' => 'required|string|max:255',
        ]);

        Mensaje::create($validatedData);

        return redirect()->route('mensajes.index', ['user_id' => $request->origen_usuarios_idUsuario]);
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
