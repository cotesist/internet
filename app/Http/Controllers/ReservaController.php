<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
public function index(Request $request)
{
    $reservas = Reserva::with(['cliente', 'servicio', 'ont', 'planR', 'planW'])
        ->buscar($request->input('search'))
        ->latest('fecha_registro')
        ->paginate(10);

    return view('reserva.index', compact('reservas'));
}

    public function create()
    {
        $clientes = Cliente::all();
        return view('reserva.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idCliente'  => 'required|exists:w_cliente,id',
            'idServicio' => 'required|integer',
            'idEquipo'   => 'required|integer',
            'idPlanr'    => 'required|integer',
            'idPlanw'    => 'required|integer',
            'estado'     => 'required|integer',
            'serie'      => 'required|string|max:50',
            'fibra'      => 'required|string|max:250',
            'tv'         => 'required|integer',
            'linea'      => 'required|integer',
        ]);

        $data = $request->all();
        $data['idUser'] = 8;
        $data['fecha_anulacion'] = now();

        Reserva::create($data);

        return redirect()->route('reservas.index')->with('success', 'Reserva registrada exitosamente.');
    }

    public function edit(Reserva $reserva)
    {
        $clientes = Cliente::all();
        return view('reserva.edit', compact('reserva', 'clientes'));
    }

    public function update(Request $request, Reserva $reserva)
    {
        $request->validate([
            'idCliente'  => 'required|exists:w_cliente,id',
            'idServicio' => 'required|integer',
            'idEquipo'   => 'required|integer',
            'idPlanr'    => 'required|integer',
            'idPlanw'    => 'required|integer',
            'estado'     => 'required|integer',
            'serie'      => 'required|string|max:50',
            'fibra'      => 'required|string|max:250',
            'tv'         => 'required|integer',
            'linea'      => 'required|integer',
        ]);

        $reserva->update($request->all());

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada exitosamente.');
    }

    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada exitosamente.');
    }
}