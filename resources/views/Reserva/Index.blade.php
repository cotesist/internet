@extends('layouts.app')

@section('title', 'Reservas')
@section('content_header', 'Gestión de Reservas')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-outline card-primary mb-4 shadow-sm">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h3 class="card-title fw-bold mb-0">Reservas Registradas</h3>
            
            <div class="d-flex align-items-center gap-2">
                <!-- Formulario de Búsqueda -->
                <form action="{{ route('reservas.index') }}" method="GET" class="d-flex me-2">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Buscar cliente, servicio, plan..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit" title="Buscar">
                            <i class="bi bi-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('reservas.index') }}" class="btn btn-outline-danger" title="Limpiar filtro">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>
                </form>

                <a href="{{ route('reservas.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Nueva Reserva
                </a>
            </div>
        </div>
        
        <div class="card-body p-0">
            <!-- Barra de desplazamiento horizontal cuando no quepa en pantalla -->
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
                    <thead>
                        <tr>
                            <th># ID</th>
                            <th>Cliente</th>
                            <th>Servicio</th>
                            <th>Equipo (ONT)</th>
                            <th>Plan R</th>
                            <th>Plan W</th>
                            <th>Estado</th>
                            <th>Serie</th>
                            <th>Fibra</th>
                            <th>TV</th>
                            <th>Línea</th>
                            <th>Fecha Reg.</th>
                            <th>Fecha Update</th>
                            <th>Fecha Anul.</th>
                            <th>Usuario</th>
                            <th class="text-center" style="min-width: 120px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservas as $reserva)
                            <tr>
                                <td><span class="fw-bold">#{{ $reserva->id }}</span></td>
                                <td>{{ $reserva->cliente->nombre ?? 'ID: '.$reserva->idCliente }}</td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $reserva->servicio->nombre ?? 'Serv #'.$reserva->idServicio }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $reserva->ont->nombre ?? 'Eq #'.$reserva->idEquipo }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $reserva->planR->nombre ?? 'PlanR #'.$reserva->idPlanr }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $reserva->planW->nombre ?? 'PlanW #'.$reserva->idPlanw }}
                                    </span>
                                </td>
                                <td>
                                    @if($reserva->estado == 1)
                                        <span class="badge bg-success">Activo ({{ $reserva->estado }})</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Estado ({{ $reserva->estado }})</span>
                                    @endif
                                </td>
                                <td><code>{{ $reserva->serie }}</code></td>
                                <td>{{ $reserva->fibra }}</td>
                                <td>{{ $reserva->tv }}</td>
                                <td>{{ $reserva->linea }}</td>
                                <td><small class="text-muted">{{ $reserva->fecha_registro }}</small></td>
                                <td><small class="text-muted">{{ $reserva->fecha_update }}</small></td>
                                <td><small class="text-muted">{{ $reserva->fecha_anulacion }}</small></td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <i class="bi bi-person me-1"></i>{{ $reserva->user->nombre ?? $reserva->user->name ?? 'User #'.$reserva->idUser }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('reservas.edit', $reserva) }}" class="btn btn-outline-info" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('reservas.destroy', $reserva) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Eliminar" onclick="return confirm('¿Eliminar esta reserva?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="16" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    No se encontraron reservas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($reservas->hasPages())
            <div class="card-footer clearfix">
                <div class="float-end">
                    {{ $reservas->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
@endsection