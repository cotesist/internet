<?php

namespace App\Http\Controllers;

use App\Models\Ont;
use Illuminate\Http\Request;

class OntController extends Controller
{
    public function index(Request $request)
    {
        $query = Ont::query();

        if ($request->filled('search')) {
            $search = '%' . mb_strtolower(trim($request->input('search')), 'UTF-8') . '%';

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(nombre) LIKE ?', [$search])
                  ->orWhereRaw('LOWER(marca) LIKE ?', [$search])
                  ->orWhereRaw('LOWER(modelo) LIKE ?', [$search])
                  ->orWhereRaw('CAST(id AS CHAR) LIKE ?', [$search]);
            });
        }

        $onts = $query->latest('id')->paginate(10);

        return view('ont.index', compact('onts'));
    }

    public function create()
    {
        return view('ont.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'marca'  => 'required|string|max:150',
            'modelo' => 'required|string|max:150',
        ]);

        Ont::create($request->all());

        return redirect()->route('onts.index')->with('success', 'Equipo ONT registrado correctamente.');
    }

    public function edit(Ont $ont)
    {
        return view('ont.edit', compact('ont'));
    }

    public function update(Request $request, Ont $ont)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'marca'  => 'required|string|max:150',
            'modelo' => 'required|string|max:150',
        ]);

        $ont->update($request->all());

        return redirect()->route('onts.index')->with('success', 'Equipo ONT actualizado correctamente.');
    }

    public function destroy(Ont $ont)
    {
        $ont->delete();
        return redirect()->route('onts.index')->with('success', 'Equipo ONT eliminado.');
    }
}