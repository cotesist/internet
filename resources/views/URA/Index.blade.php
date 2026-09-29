@extends('layouts.app')

@section('title', 'URAs')
@section('content_header', 'Gestión de URAs')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-outline card-primary mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title fw-bold mb-0">Listado de URAs</h3>
                <form action="{{ route('uras.index') }}" method="GET" class="d-flex align-items-center">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Buscar " value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit" title="Buscar">
                            <i class="bi bi-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('uras.index') }}" class="btn btn-outline-danger" title="Limpiar búsqueda">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        @endif
                    </div>
                </form>             
            <a href="{{ route('uras.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Nueva URA
            </a>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 80px"># ID</th>
                            <th>Nombre</th>
                            <th>Ubicación</th>
                            <th>Fecha Registro</th>
                            <th>Última Actualización</th>
                            <th>Usuario</th>
                            <th style="width: 150px" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($uras as $ura)
                            <tr>
                                <td><span class="fw-bold">#{{ $ura->id }}</span></td>
                                <td>{{ $ura->nombre }}</td>
                                <td>{{ $ura->ubicacion ?? 'N/A' }}</td>
                                <td>{{ $ura->fecha_reg ? $ura->fecha_reg->format('Y-m-d H:i') : 'N/A' }}</td>
                                <td>{{ $ura->fecha_up ? $ura->fecha_up->format('Y-m-d H:i') : 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $ura->usuario->nombre ?? 'Usuario #' . $ura->id_user }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('uras.edit', $ura) }}" class="btn btn-outline-info" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('uras.destroy', $ura) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Eliminar" onclick="return confirm('¿Eliminar esta URA?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    No hay URAs registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($uras->hasPages())
            <div class="card-footer border-top clearfix">
                <div class="float-end">
                    {{ $uras->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
@endsection