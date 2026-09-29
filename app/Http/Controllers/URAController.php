<?php

namespace App\Http\Controllers;

use App\Models\Ura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UraController extends Controller
{
    public function index(Request $request)
    {
        $query = Ura::with('usuario');

        if ($request->filled('search')) {
            $search = '%' . mb_strtolower(trim($request->input('search')), 'UTF-8') . '%';

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(nombre) LIKE ?', [$search])
                  ->orWhereRaw('LOWER(ubicacion) LIKE ?', [$search])
                  ->orWhereRaw('CAST(id AS CHAR) LIKE ?', [$search])
                  ->orWhereHas('usuario', function ($qUser) use ($search) {
                      $qUser->whereRaw('LOWER(nombre) LIKE ?', [$search]);
                  });
            });
        }

        $uras = $query->latest('id')->paginate(10);

        return view('ura.index', compact('uras'));
    }

    public function create()
    {
        return view('ura.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:250',
            'ubicacion' => 'nullable|string|max:250',
        ]);

        Ura::create([
            'nombre'    => $request->nombre,
            'ubicacion' => $request->ubicacion,
            'fecha_reg' => now(),
            'fecha_up'  => now(),
            'id_user'   => Auth::id(),
        ]);

        return redirect()->route('uras.index')->with('success', 'URA registrada exitosamente.');
    }

    public function edit(Ura $ura)
    {
        return view('ura.edit', compact('ura'));
    }

    public function update(Request $request, Ura $ura)
    {
        $request->validate([
            'nombre'    => 'required|string|max:250',
            'ubicacion' => 'nullable|string|max:250',
        ]);

        $ura->update([
            'nombre'    => $request->nombre,
            'ubicacion' => $request->ubicacion,
            'fecha_up'  => now(),
            'id_user'   => Auth::id(),
        ]);

        return redirect()->route('uras.index')->with('success', 'URA actualizada exitosamente.');
    }

    public function destroy(Ura $ura)
    {
        $ura->delete();
        return redirect()->route('uras.index')->with('success', 'URA eliminada.');
    }
}