<?php

namespace App\Http\Controllers;

use App\Models\PlanR;
use Illuminate\Http\Request;

class PlanRController extends Controller
{
    public function index(Request $request)
    {
        $query = PlanR::query();

        if ($request->filled('search')) {
            $search = '%' . mb_strtolower(trim($request->input('search')), 'UTF-8') . '%';

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(nombre) LIKE ?', [$search])
                  ->orWhereRaw('LOWER(profile) LIKE ?', [$search])
                  ->orWhereRaw('CAST(id AS CHAR) LIKE ?', [$search]);
            });
        }

        $planesR = $query->latest('id')->paginate(10);

        return view('plan_r.index', compact('planesR'));
    }

    public function create()
    {
        return view('plan_r.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'  => 'required|string|max:250',
            'profile' => 'required|string|max:250',
        ]);

        PlanR::create($request->all());

        return redirect()->route('planes_r.index')->with('success', 'Plan R creado exitosamente.');
    }

    public function edit(PlanR $planR)
    {
        return view('plan_r.edit', compact('planR'));
    }

    public function update(Request $request, PlanR $planR)
    {
        $request->validate([
            'nombre'  => 'required|string|max:250',
            'profile' => 'required|string|max:250',
        ]);

        $planR->update($request->all());

        return redirect()->route('planes_r.index')->with('success', 'Plan R actualizado exitosamente.');
    }

    public function destroy(PlanR $planR)
    {
        $planR->delete();
        return redirect()->route('planes_r.index')->with('success', 'Plan R eliminado.');
    }
}