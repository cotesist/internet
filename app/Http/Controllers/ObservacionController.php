<?php

namespace App\Http\Controllers;

use App\Models\Observacion;
use App\Models\Reserva;
use Illuminate\Http\Request;

class ObservacionController extends Controller
{
    public function index(Request $request)
    {
        $query = Observacion::with('reserva');

        if ($request->filled('search')) {
            $search = '%' . mb_strtolower(trim($request->input('search')), 'UTF-8') . '%';

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(texto) LIKE ?', [$search])
                  ->orWhereRaw('CAST(id AS CHAR) LIKE ?', [$search])
                  ->orWhereHas('reserva', function ($qRes) use ($search) {
                      $qRes->whereHas('cliente', function ($qCli) use ($search) {
                          $qCli->whereRaw('LOWER(nombre) LIKE ?', [$search]);
                      });
                  });
            });
        }

        $observaciones = $query->latest('id')->paginate(10);

        return view('observacion.index', compact('observaciones'));
    }

    public function create()
    {
        $reservas = Reserva::all();
        return view('observacion.create', compact('reservas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idReserva' => 'nullable|exists:w_reserva,id',
            'texto'     => 'required|string',
            'fecha'     => 'required|date',
        ]);

        Observacion::create($request->all());

        return redirect()->route('observaciones.index')->with('success', 'Observación guardada correctamente.');
    }

    public function edit(Observacion $observacion)
    {
        $reservas = Reserva::all();
        return view('observacion.edit', compact('observacion', 'reservas'));
    }

    public function update(Request $request, Observacion $observacion)
    {
        $request->validate([
            'idReserva' => 'nullable|exists:w_reserva,id',
            'texto'     => 'required|string',
            'fecha'     => 'required|date',
        ]);

        $observacion->update($request->all());

        return redirect()->route('observaciones.index')->with('success', 'Observación actualizada correctamente.');
    }

    public function destroy(Observacion $observacion)
    {
        $observacion->delete();
        return redirect()->route('observaciones.index')->with('success', 'Observación eliminada.');
    }
}