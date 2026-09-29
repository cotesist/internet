@extends('layouts.app')

@section('title', 'Equipos')
@section('content_header', 'Gestión de Equipos')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-outline card-primary mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title fw-bold mb-0">Listado de Equipos</h3>
                <form action="{{ route('equipos.index') }}" method="GET" class="d-flex align-items-center">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Buscar " value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit" title="Buscar">
                            <i class="bi bi-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('equipos.index') }}" class="btn btn-outline-danger" title="Limpiar búsqueda">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        @endif
                    </div>
                </form>            
            <a href="{{ route('equipos.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Nuevo Equipo
            </a>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 80px"># ID</th>
                            <th>Nombre</th>
                            <th>IP</th>
                            <th>URA</th>
                            <th>Servicio</th>
                            <th>Ubicación (Lat, Long)</th>
                            <th>Usuario</th>
                            <th style="width: 150px" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($equipos as $equipo)
                            <tr>
                                <td><span class="fw-bold">#{{ $equipo->id }}</span></td>
                                <td>{{ $equipo->nombre }}</td>
                                <td><code>{{ $equipo->ip }}</code></td>
                                <td>{{ $equipo->ura->nombre ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $equipo->servicio->nombre ?? 'Sin Servicio' }}
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                        {{ $equipo->latitud && $equipo->longitud ? $equipo->latitud . ', ' . $equipo->longitud : 'N/A' }}
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $equipo->usuario->nombre ?? $equipo->user ?? 'Sistema' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-outline-info" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Eliminar" onclick="return confirm('¿Desea eliminar este equipo?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="bi bi-cpu fs-2 d-block mb-2"></i>
                                    No hay equipos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($equipos->hasPages())
            <div class="card-footer border-top clearfix">
                <div class="float-end">
                    {{ $equipos->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
@endsection