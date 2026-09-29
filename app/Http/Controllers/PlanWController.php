<?php

namespace App\Http\Controllers;

use App\Models\PlanW;
use Illuminate\Http\Request;

class PlanWController extends Controller
{
    public function index(Request $request)
    {
        $query = PlanW::query();

        if ($request->filled('search')) {
            $search = '%' . mb_strtolower(trim($request->input('search')), 'UTF-8') . '%';

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(nombre) LIKE ?', [$search])
                  ->orWhereRaw('LOWER(profile) LIKE ?', [$search])
                  ->orWhereRaw('CAST(id AS CHAR) LIKE ?', [$search]);
            });
        }

        $planesW = $query->latest('id')->paginate(10);

        return view('plan_w.index', compact('planesW'));
    }

    public function create()
    {
        return view('plan_w.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'         => 'required|string|max:250',
            'profile'        => 'required|string|max:250',
            'velocidad_up'   => 'required|numeric|min:0',
            'velocidad_down' => 'required|numeric|min:0',
        ]);

        PlanW::create($request->all());

        return redirect()->route('planes_w.index')->with('success', 'Plan W creado exitosamente.');
    }

    public function edit(PlanW $planW)
    {
        return view('plan_w.edit', compact('planW'));
    }

    public function update(Request $request, PlanW $planW)
    {
        $request->validate([
            'nombre'         => 'required|string|max:250',
            'profile'        => 'required|string|max:250',
            'velocidad_up'   => 'required|numeric|min:0',
            'velocidad_down' => 'required|numeric|min:0',
        ]);

        $planW->update($request->all());

        return redirect()->route('planes_w.index')->with('success', 'Plan W actualizado exitosamente.');
    }

    public function destroy(PlanW $planW)
    {
        $planW->delete();
        return redirect()->route('planes_w.index')->with('success', 'Plan W eliminado.');
    }
}