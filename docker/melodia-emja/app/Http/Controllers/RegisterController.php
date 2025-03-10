<?php
namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function show()
    {
        return view('autenticacion.register');
    }

    public function register(Request $request)
    {
        
        $request->validate([
            'username' => 'required|string|max:255|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
            'mail' => 'required|string|email|max:255|unique:usuarios',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $usuario = Usuario::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'mail' => $request->mail,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'roles_idRol' => 2, // Por defecto, asignamos un rol de usuario normal
        ]);

        Auth::login($usuario);

        return redirect('/home');
    }
}
