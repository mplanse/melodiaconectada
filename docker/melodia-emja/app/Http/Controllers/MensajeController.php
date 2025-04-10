<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\Usuario;
use App\Models\Origen;
use App\Models\Destino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MensajeController extends Controller
{
    public function index(Request $request)
    {
        $currentUserId = Auth::id();
        $usuarios = Usuario::where('idUsuario', '!=', $currentUserId)->get();

        if ($request->filled('user_id')) {
            $otherUserId = $request->input('user_id');
            $otherUser   = Usuario::findOrFail($otherUserId);
            $mensajes = Mensaje::whereRaw(
                '(origen_usuarios_idUsuario = ? AND destino_usuarios_idUsuario = ?) OR (origen_usuarios_idUsuario = ? AND destino_usuarios_idUsuario = ?)',
                [$currentUserId, $otherUserId, $otherUserId, $currentUserId]
            )
            ->orderBy('timestamp', 'asc')
            ->get();

            return view('mensajes.conversation', compact('mensajes', 'usuarios', 'currentUserId', 'otherUserId', 'otherUser'));
        }

        return view('mensajes.index', compact('usuarios', 'currentUserId'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'origen_usuarios_idUsuario'  => 'required|integer|exists:usuarios,idUsuario',
            'destino_usuarios_idUsuario' => 'required|integer|exists:usuarios,idUsuario',
            'texto_mensaje'              => 'required|string|max:255',
        ]);

        Origen::firstOrCreate(['usuarios_idUsuario' => $data['origen_usuarios_idUsuario']]);
        Destino::firstOrCreate(['usuarios_idUsuario' => $data['destino_usuarios_idUsuario']]);

        Mensaje::create([
            'origen_usuarios_idUsuario'  => $data['origen_usuarios_idUsuario'],
            'destino_usuarios_idUsuario' => $data['destino_usuarios_idUsuario'],
            'texto_mensaje'              => $data['texto_mensaje'],
            'timestamp'                  => now(),
        ]);

        return redirect()->route('mensajes.index', ['user_id' => $data['destino_usuarios_idUsuario']]);
    }

    public function conversation($userId)
    {
        $currentUserId = Auth::id();
        $otherUser     = Usuario::findOrFail($userId);
        $mensajes = Mensaje::whereRaw(
            '(origen_usuarios_idUsuario = ? AND destino_usuarios_idUsuario = ?) OR (origen_usuarios_idUsuario = ? AND destino_usuarios_idUsuario = ?)',
            [$currentUserId, $userId, $userId, $currentUserId]
        )
        ->orderBy('timestamp', 'asc')
        ->get();
        $usuarios = Usuario::where('idUsuario', '!=', $currentUserId)->get();

        return view('mensajes.conversation', compact('mensajes', 'usuarios', 'currentUserId', 'otherUser', 'userId', 'otherUserId'));
    }
}
