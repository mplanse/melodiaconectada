<?php
namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function seleccionRol(Request $request)
    {
        $rolSeleccionado = $request->query('rol');
        $roles = Rol::all();
        return view('autenticacion.seleccionrol', compact('roles' , 'rolSeleccionado'));
    }

    public function show(Request $request)
    {
        $rolSeleccionado = $request->query('rol');
        if (!$rolSeleccionado) {
            return redirect()->route('seleccion.rol')->with('error', 'Debes seleccionar un rol.');
        }

        return view('autenticacion.register', compact('rolSeleccionado'));
    }

    public function register(Request $request)
    {

            $request->validate([
        'username' => 'required|string|max:255|unique:usuarios',
        'password' => 'required|string|min:8|confirmed',
        'mail' => 'required|string|email|max:255|unique:usuarios',
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'rol' => 'required|exists:roles,idRol',
    ]);

    $usuario = Usuario::create([
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'mail' => $request->mail,
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'roles_idRol' => $request->rol,
    ]);

    Auth::login($usuario);

    return redirect('/eventos')->with('success', 'Registro exitoso.');

    }
}
