<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function show()
    {
        return view('autenticacion.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'mail' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $usuario = Usuario::where('mail', $request->mail)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            return back()->withErrors(['login' => 'Credenciales incorrectas']);
        }

        Auth::login($usuario);

        return redirect('/eventos/index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
