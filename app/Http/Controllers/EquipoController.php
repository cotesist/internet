<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Ura;
use App\Models\Servicio;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index(Request $request)
    {
        $query = Equipo::with(['ura', 'servicio']);

        if ($request->filled('search')) {
            $search = '%' . mb_strtolower(trim($request->input('search')), 'UTF-8') . '%';

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(nombre) LIKE ?', [$search])
                  ->orWhereRaw('LOWER(ip) LIKE ?', [$search])
                  ->orWhereRaw('LOWER(user) LIKE ?', [$search])
                  ->orWhereRaw('CAST(id AS CHAR) LIKE ?', [$search])
                  ->orWhereHas('ura', function ($qUra) use ($search) {
                      $qUra->whereRaw('LOWER(nombre) LIKE ?', [$search]);
                  })
                  ->orWhereHas('servicio', function ($qServ) use ($search) {
                      $qServ->whereRaw('LOWER(nombre) LIKE ?', [$search]);
                  });
            });
        }

        $equipos = $query->latest('id')->paginate(10);

        return view('equipos.index', compact('equipos'));
    }

    public function create()
    {
        $uras = Ura::all();
        $servicios = Servicio::all();
        return view('equipos.create', compact('uras', 'servicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idUra' => 'required|exists:w_ura,id',
            'idServicio' => 'required|exists:w_servicio,id',
            'ip' => 'required|string|max:50',
            'nombre' => 'required|string|max:250',
            'latitud' => 'required|string|max:250',
            'longitud' => 'required|string|max:250',
            'user' => 'required|string|max:250',
            'passw' => 'required|string|max:250',
        ]);

        Equipo::create($request->all());

        return redirect()->route('equipos.index')->with('success', 'Equipo creado correctamente.');
    }

    public function edit(Equipo $equipo)
    {
        $uras = Ura::all();
        $servicios = Servicio::all();
        return view('equipos.edit', compact('equipo', 'uras', 'servicios'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $request->validate([
            'idUra' => 'required|exists:w_ura,id',
            'idServicio' => 'required|exists:w_servicio,id',
            'ip' => 'required|string|max:50',
            'nombre' => 'required|string|max:250',
            'latitud' => 'required|string|max:250',
            'longitud' => 'required|string|max:250',
            'user' => 'required|string|max:250',
            'passw' => 'required|string|max:250',
        ]);

        $equipo->update($request->all());

        return redirect()->route('equipos.index')->with('success', 'Equipo actualizado correctamente.');
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete();
        return redirect()->route('equipos.index')->with('success', 'Equipo eliminado correctamente.');
    }
}