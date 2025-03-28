<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class PerfilController extends Controller
{
    public function edit()
    {
        $usuario = Auth::user();
        return view('editar-perfil', compact('usuario'));
    }

    public function update(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            'nombre' => 'required|string|max:45',
            'mail' => 'required|email|max:45|unique:usuarios,mail,' . $usuario->idUsuario . ',idUsuario',
            'descripcion' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->mail = $request->mail;
        $usuario->descripcion = $request->descripcion;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('perfil.edit')->with('success', 'Perfil actualizado correctamente.');
    }
}
