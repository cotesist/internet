<?php

namespace App\Http\Controllers;

use App\Models\Puerto;
use App\Models\Equipo;
use App\Models\Reserva;
use Illuminate\Http\Request;

class PuertoController extends Controller
{
    public function index(Request $request)
    {
        $query = Puerto::with(['equipo', 'reserva.cliente']);

        if ($request->filled('search')) {
            $search = '%' . mb_strtolower(trim($request->input('search')), 'UTF-8') . '%';

            $query->where(function ($q) use ($search) {
                $q->whereRaw('CAST(pon AS CHAR) LIKE ?', [$search])
                  ->orWhereRaw('CAST(puerto AS CHAR) LIKE ?', [$search])
                  ->orWhereRaw('CAST(id AS CHAR) LIKE ?', [$search])
                  ->orWhereHas('equipo', function ($qEq) use ($search) {
                      $qEq->whereRaw('LOWER(nombre) LIKE ?', [$search]);
                  })
                  ->orWhereHas('reserva.cliente', function ($qCli) use ($search) {
                      $qCli->whereRaw('LOWER(nombre) LIKE ?', [$search]);
                  });
            });
        }

        $puertos = $query->latest('id')->paginate(10);

        return view('puertos.index', compact('puertos'));
    }

    public function create()
    {
        $equipos = Equipo::all();
        $reservas = Reserva::with('cliente')->get();

        return view('puertos.create', compact('equipos', 'reservas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idEquipo'  => 'required|integer|exists:w_equipo,id',
            'idReserva' => 'required|integer|exists:w_reserva,id',
            'pon'       => 'required|integer',
            'puerto'    => 'required|integer',
            'estado'    => 'required|integer',
        ]);

        Puerto::create($request->all());

        return redirect()->route('puertos.index')->with('success', 'Puerto registrado correctamente.');
    }

    public function edit(Puerto $puerto)
    {
        $equipos = Equipo::all();
        $reservas = Reserva::with('cliente')->get();

        return view('puertos.edit', compact('puerto', 'equipos', 'reservas'));
    }

    public function update(Request $request, Puerto $puerto)
    {
        $request->validate([
            'idEquipo'  => 'required|integer|exists:w_equipo,id',
            'idReserva' => 'required|integer|exists:w_reserva,id',
            'pon'       => 'required|integer',
            'puerto'    => 'required|integer',
            'estado'    => 'required|integer',
        ]);

        $puerto->update($request->all());

        return redirect()->route('puertos.index')->with('success', 'Puerto actualizado correctamente.');
    }

    public function destroy(Puerto $puerto)
    {
        $puerto->delete();
        return redirect()->route('puertos.index')->with('success', 'Puerto eliminado correctamente.');
    }
}