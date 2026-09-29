@extends('layouts.app')

@section('title', 'Clientes')
@section('content_header', 'Gestión de Clientes')

@section('content')
    {{-- Alerta de éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tarjeta Principal --}}
    <div class="card card-outline card-primary mb-4 shadow-sm">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h3 class="card-title fw-bold mb-0">Listado de Clientes</h3>
            
            <div class="d-flex align-items-center gap-2">
                <!-- Buscador -->
                <form action="{{ route('clientes.index') }}" method="GET" class="d-flex align-items-center">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Buscar cliente..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit" title="Buscar">
                            <i class="bi bi-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('clientes.index') }}" class="btn btn-outline-danger" title="Limpiar búsqueda">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        @endif
                    </div>
                </form>

                <a href="{{ route('clientes.create') }}" class="btn btn-primary btn-sm text-nowrap">
                    <i class="bi bi-person-plus-fill me-1"></i> Nuevo Cliente
                </a>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 80px"># ID</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Celular</th>
                            <th>Registrado Por</th>
                            <th style="width: 150px" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientes as $cliente)
                            <tr>
                                <td><span class="fw-bold">#{{ $cliente->id }}</span></td>
                                <td>{{ $cliente->nombre }}</td>
                                <td>
                                    @if($cliente->telefono)
                                        <i class="bi bi-telephone text-secondary me-1"></i>{{ $cliente->telefono }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($cliente->celular)
                                        <i class="bi bi-phone text-secondary me-1"></i>{{ $cliente->celular }}
                                    @else
                                        <span class="badge bg-secondary">Sin celular</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <i class="bi bi-person me-1"></i>
                                        {{ $cliente->user->nombre ?? $cliente->user->name ?? 'Usuario #' . $cliente->idUser }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-outline-info" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar a {{ $cliente->nombre }}?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-people fs-2 d-block mb-2"></i>
                                    {{ request('search') ? 'No se encontraron clientes que coincidan con la búsqueda.' : 'No hay clientes registrados en el sistema.' }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Paginación mantención de query params --}}
        @if($clientes->hasPages())
            <div class="card-footer border-top clearfix">
                <div class="float-end">
                    {{ $clientes->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
@endsection