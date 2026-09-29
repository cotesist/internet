<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'usuario'  => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Buscamos directamente el usuario
        $user = User::where('usuario', $request->usuario)->first();

        // Verificamos coincidencia directa o ignoramos el algoritmo Bcrypt por ahora
        if ($user && $user->password_hash === $request->password && $user->isActive == 1) {
            
            // Iniciamos sesión manualmente ignorando la verificación de Hash
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'Bienvenido al sistema');
        }

        return back()->withErrors([
            'usuario' => 'El usuario o la contraseña son incorrectos, o la cuenta está inactiva.',
        ])->onlyInput('usuario');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}