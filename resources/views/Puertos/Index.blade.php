@extends('layouts.app')

@section('title', 'Puertos')
@section('content_header', 'Gestión de Puertos')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-outline card-primary mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title fw-bold mb-0">Listado de Puertos</h3>
            <form action="{{ route('puertos.index') }}" method="GET" class="d-flex align-items-center">
                <div class="input-group input-group-sm">
                    <input type="text" name="search" class="form-control" placeholder="Buscar..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit" title="Buscar">
                        <i class="bi bi-search"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('puertos.index') }}" class="btn btn-outline-danger" title="Limpiar búsqueda">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    @endif
                </div>
            </form>             
            <a href="{{ route('puertos.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Nuevo Puerto
            </a>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 80px"># ID</th>
                            <th>Equipo</th>
                            <th>Cliente / Reserva</th>
                            <th>PON</th>
                            <th>Puerto</th>
                            <th>Estado</th>
                            <th style="width: 150px" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($puertos as $puerto)
                            <tr>
                                <td><span class="fw-bold">#{{ $puerto->id }}</span></td>
                                <td>{{ $puerto->equipo->nombre ?? 'Equipo #' . $puerto->idEquipo }}</td>
                                <td>
                                    @if($puerto->reserva)
                                        <div class="bg-primary text-white p-2 rounded shadow-sm d-inline-block">
                                            <span class="fw-bold d-block text-white">
                                                <i class="bi bi-person-fill me-1"></i>{{ $puerto->reserva->cliente->nombre ?? 'Cliente N/A' }}
                                            </span>
                                            <small class="text-white-50 d-block">
                                                <i class="bi bi-journal-bookmark me-1"></i>Reserva #{{ $puerto->idReserva }}
                                            </small>
                                        </div>
                                    @else
                                        <span class="badge bg-secondary">Sin Reserva</span>
                                    @endif
                                </td>
                                <td><code>{{ $puerto->pon }}</code></td>
                                <td><span class="fw-semibold">{{ $puerto->puerto }}</span></td>
                                <td>
                                    @if($puerto->estado == 1)
                                        <span class="badge bg-success">Activo</span>
                                    @elseif($puerto->estado == 0)
                                        <span class="badge bg-secondary">Inactivo</span>
                                    @else
                                        <span class="badge bg-info text-dark">Estado {{ $puerto->estado }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('puertos.edit', $puerto->id) }}" class="btn btn-outline-info" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('puertos.destroy', $puerto->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Eliminar" onclick="return confirm('¿Desea eliminar este puerto?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="bi bi-ethernet fs-2 d-block mb-2"></i>
                                    No hay puertos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($puertos->hasPages())
            <div class="card-footer border-top clearfix">
                <div class="float-end">
                    {{ $puertos->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
@endsection