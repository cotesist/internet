@extends('layouts.app')

@section('title', 'Observaciones')
@section('content_header', 'Gestión de Observaciones')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-outline card-primary mb-4 shadow-sm">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h3 class="card-title fw-bold mb-0">Listado de Observaciones</h3>
            
            <div class="d-flex align-items-center gap-2">
                <!-- Formulario de Búsqueda -->
                <form action="{{ route('observaciones.index') }}" method="GET" class="d-flex me-2">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Buscar..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit" title="Buscar">
                            <i class="bi bi-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('observaciones.index') }}" class="btn btn-outline-danger" title="Limpiar filtro">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>
                </form>

                <a href="{{ route('observaciones.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Nueva Observación
                </a>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 80px"># ID</th>
                            <th>Reserva</th>
                            <th>Texto</th>
                            <th>Fecha</th>
                            <th style="width: 150px" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($observaciones as $obs)
                            <tr>
                                <td><span class="fw-bold">#{{ $obs->id }}</span></td>
                                <td>{{ $obs->reserva->cliente->nombre ?? 'N/A' }}</td>
                                <td>{{ Str::limit($obs->texto, 60) }}</td>
                                <td>{{ $obs->fecha ? $obs->fecha->format('Y-m-d H:i') : 'N/A' }}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('observaciones.edit', $obs) }}" class="btn btn-outline-info" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('observaciones.destroy', $obs) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Eliminar" onclick="return confirm('¿Eliminar esta observación?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    No hay observaciones registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($observaciones->hasPages())
            <div class="card-footer border-top clearfix">
                <div class="float-end">
                    {{ $observaciones->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
@endsection