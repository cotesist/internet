<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        // 1. Cargamos la relación del usuario creador
        $query = Cliente::with('user');

        // 2. Filtramos si se envía un término de búsqueda
        if ($request->filled('search')) {
            // Convertimos la búsqueda del usuario a minúsculas limpia de espacios
            $search = '%' . mb_strtolower(trim($request->input('search')), 'UTF-8') . '%';

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(nombre) LIKE ?', [$search])
                  ->orWhereRaw('LOWER(telefono) LIKE ?', [$search])
                  ->orWhereRaw('LOWER(celular) LIKE ?', [$search])
                  ->orWhereRaw('CAST(id AS CHAR) LIKE ?', [$search])
                  // Búsqueda en la relación con la tabla 'users'
                  ->orWhereHas('user', function ($qUser) use ($search) {
                      $qUser->whereRaw('LOWER(nombre) LIKE ?', [$search]);
                  });
            });
        }

        // 3. Ordenamos y paginamos los resultados
        $clientes = $query->latest('fecha_registro')->paginate(10);

        return view('cliente.index', compact('clientes'));
    }

    public function create()
    {
        return view('cliente.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:250',
            'telefono' => 'required|numeric',
            'celular'  => 'nullable|numeric',
        ]);

        Cliente::create([
            'nombre'   => $request->nombre,
            'telefono' => $request->telefono,
            'celular'  => $request->celular,
            'idUser'   => 8, // Valor por defecto temporal sin autenticación
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    public function edit(Cliente $cliente)
    {
        return view('cliente.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre'   => 'required|string|max:250',
            'telefono' => 'required|numeric',
            'celular'  => 'nullable|numeric',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado.');
    }
}