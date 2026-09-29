<?php

namespace App\Http\Controllers;

use App\Models\Linea;
use App\Models\Reserva;
use Illuminate\Http\Request;

class LineaController extends Controller
{
    public function index(Request $request)
    {
        $query = Linea::with('reserva');

        if ($request->filled('search')) {
            $search = '%' . mb_strtolower(trim($request->input('search')), 'UTF-8') . '%';

            $query->where(function ($q) use ($search) {
                $q->whereRaw('CAST(telefono AS CHAR) LIKE ?', [$search])
                  ->orWhereRaw('LOWER(clave) LIKE ?', [$search])
                  ->orWhereRaw('CAST(id AS CHAR) LIKE ?', [$search])
                  ->orWhereHas('reserva', function ($qReserva) use ($search) {
                      $qReserva->whereRaw('CAST(id AS CHAR) LIKE ?', [$search]);
                  });
            });
        }

        $lineas = $query->latest('id')->paginate(10);

        return view('linea.index', compact('lineas'));
    }

    public function create()
    {
        $reservas = Reserva::all();
        return view('linea.create', compact('reservas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idReserva' => 'required|exists:w_reserva,id',
            'telefono'  => 'required|integer',
            'clave'     => 'required|string|max:10',
        ]);

        Linea::create($request->all());

        return redirect()->route('lineas.index')->with('success', 'Línea creada correctamente.');
    }

    public function edit(Linea $linea)
    {
        $reservas = Reserva::all();
        return view('linea.edit', compact('linea', 'reservas'));
    }

    public function update(Request $request, Linea $linea)
    {
        $request->validate([
            'idReserva' => 'required|exists:w_reserva,id',
            'telefono'  => 'required|integer',
            'clave'     => 'required|string|max:10',
        ]);

        $linea->update($request->all());

        return redirect()->route('lineas.index')->with('success', 'Línea actualizada correctamente.');
    }

    public function destroy(Linea $linea)
    {
        $linea->delete();
        return redirect()->route('lineas.index')->with('success', 'Línea eliminada correctamente.');
    }
}