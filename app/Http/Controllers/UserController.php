<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'        => 'required|string|max:255',
            'usuario'       => 'required|string|max:100',
            'email'         => 'required|email|max:255|unique:users,email',
            'password_hash' => 'required|string|min:6',
            'tipo_usuario'  => 'required|in:admin,soporte,turno',
            'isActive'      => 'required|boolean',
        ]);

        User::create($request->all());

        return redirect()->route('users.index')->with('success', 'Usuario registrado correctamente.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nombre'        => 'required|string|max:255',
            'usuario'       => 'required|string|max:100',
            'email'         => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password_hash' => 'nullable|string|min:6',
            'tipo_usuario'  => 'required|in:admin,soporte,turno',
            'isActive'      => 'required|boolean',
        ]);

        $data = $request->except('password_hash');
        
        // Solo actualiza la contraseña si el campo no fue enviado vacío
        if ($request->filled('password_hash')) {
            $data['password_hash'] = $request->password_hash;
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        // Guardar el nombre/usuario que ejecuta el borrado antes del soft delete
        $user->userDeleted = Auth::user()->usuario ?? 'Sistema';
        $user->save();

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}