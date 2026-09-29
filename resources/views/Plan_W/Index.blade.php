@extends('layouts.app')

@section('title', 'Planes W')
@section('content_header', 'Gestión de Planes W')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-outline card-primary mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title fw-bold mb-0">Listado de Planes W</h3>
                <form action="{{ route('planes_w.index') }}" method="GET" class="d-flex align-items-center">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Buscar " value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit" title="Buscar">
                            <i class="bi bi-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('planes_w.index') }}" class="btn btn-outline-danger" title="Limpiar búsqueda">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        @endif
                    </div>
                </form>             
            <a href="{{ route('planes_w.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Nuevo Plan W
            </a>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 80px"># ID</th>
                            <th>Nombre</th>
                            <th>Profile</th>
                            <th>Subida (Up)</th>
                            <th>Bajada (Down)</th>
                            <th style="width: 150px" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($planesW as $plan)
                            <tr>
                                <td><span class="fw-bold">#{{ $plan->id }}</span></td>
                                <td>{{ $plan->nombre }}</td>
                                <td><code>{{ $plan->profile }}</code></td>
                                <td><span class="badge bg-info text-dark"><i class="bi bi-arrow-up"></i> {{ $plan->velocidad_up }} Mbps</span></td>
                                <td><span class="badge bg-success"><i class="bi bi-arrow-down"></i> {{ $plan->velocidad_down }} Mbps</span></td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('planes_w.edit', $plan) }}" class="btn btn-outline-info" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('planes_w.destroy', $plan) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Eliminar" onclick="return confirm('¿Eliminar este plan?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    No hay Planes W registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($planesW->hasPages())
            <div class="card-footer border-top clearfix">
                <div class="float-end">
                    {{ $planesW->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
@endsection