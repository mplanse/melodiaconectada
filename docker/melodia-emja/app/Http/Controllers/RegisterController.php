<?php
namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Musico;
use App\Models\Usuario;
use App\Models\Restaurante;
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

        // Create user
        $usuario = Usuario::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'mail' => $request->mail,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'roles_idRol' => $request->rol,
        ]);

        // Create related record based on role (1 = Músico, 2 = Restaurante)
        if ($request->rol == 1) {
            // Create a record in the musicos table
            $musico = new Musico();
            $musico->idMusico = $usuario->idUsuario; // Use the user ID as the musico ID
            $musico->descripcion = $request->descripcion;
            $musico->save();
        } elseif ($request->rol == 2) {
            // Create a record in the restaurantes table
            $restaurante = new Restaurante();
            $restaurante->idRestaurante = $usuario->idUsuario; // Use the user ID as the restaurante ID
            $restaurante->direccion = $request->direccion ?? ''; // Add a field for direccion in your form
            $restaurante->save();
        }

        Auth::login($usuario);

        return redirect('/eventos')->with('success', 'Registro exitoso.');
    }
}
