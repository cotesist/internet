@extends('layouts.app')

@section('title', 'Líneas')
@section('content_header', 'Gestión de Líneas')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-outline card-primary mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title fw-bold">Listado de Líneas</h3>
                <form action="{{ route('lineas.index') }}" method="GET" class="d-flex align-items-center">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Buscar " value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit" title="Buscar">
                            <i class="bi bi-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('lineas.index') }}" class="btn btn-outline-danger" title="Limpiar búsqueda">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        @endif
                    </div>
                </form>            
            <a href="{{ route('lineas.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-telephone-plus me-1"></i> Nueva Línea
            </a>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 80px"># ID</th>
                            <th>Cliente / Reserva</th>
                            <th>Teléfono</th>
                            <th>Clave</th>
                            <th style="width: 150px" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lineas as $linea)
                            <tr>
                                <td><span class="fw-bold">#{{ $linea->id }}</span></td>
                                <td>
                                    @if($linea->reserva)
                                        <span class="fw-semibold">
                                            {{ $linea->reserva->cliente->nombre ?? 'Cliente N/A' }}
                                        </span>
                                        <small class="d-block text-muted">
                                            Reserva #{{ $linea->idReserva }}
                                        </small>
                                    @else
                                        <span class="badge bg-light text-dark border">Sin asignar</span>
                                    @endif
                                </td>
                                <td><code>{{ $linea->telefono }}</code></td>
                                <td><code>{{ $linea->clave }}</code></td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('lineas.edit', $linea) }}" class="btn btn-outline-info" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('lineas.destroy', $linea) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Eliminar" onclick="return confirm('¿Eliminar esta línea?')">
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
                                    No hay líneas registradas en el sistema.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($lineas->hasPages())
            <div class="card-footer border-top clearfix">
                <div class="float-end">
                    {{ $lineas->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
@endsection