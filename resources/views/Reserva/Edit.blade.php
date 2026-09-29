@extends('layouts.app')

@section('title', 'Editar Reserva')
@section('content_header', 'Editar Reserva')

@section('content')
    <div class="card card-outline card-info mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title fw-bold"><i class="bi bi-pencil-square me-2"></i> Modificar Datos de Reserva #{{ $reserva->id }}</h3>
            <a href="{{ route('reservas.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Volver al listado
            </a>
        </div>

        <form action="{{ route('reservas.update', $reserva) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="bi bi-exclamation-triangle me-2"></i>Por favor corrige los siguientes errores:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row g-3">
                    <!-- Cliente -->
                    <div class="col-md-6">
                        <label for="idCliente" class="form-label fw-bold">Cliente <span class="text-danger">*</span></label>
                        <select name="idCliente" id="idCliente" class="form-select" required>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('idCliente', $reserva->idCliente) == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nombre }} (Tel: {{ $cliente->telefono }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Estado -->
                    <div class="col-md-3">
                        <label for="estado" class="form-label fw-bold">Estado <span class="text-danger">*</span></label>
                        <input type="number" name="estado" id="estado" class="form-control" value="{{ old('estado', $reserva->estado) }}" required>
                    </div>

                    <!-- Serie -->
                    <div class="col-md-3">
                        <label for="serie" class="form-label fw-bold">Serie <span class="text-danger">*</span></label>
                        <input type="text" name="serie" id="serie" class="form-control" value="{{ old('serie', $reserva->serie) }}" required>
                    </div>

                    <!-- Servicio -->
                    <div class="col-md-3">
                        <label for="idServicio" class="form-label fw-bold">Servicio <span class="text-danger">*</span></label>
                        <select name="idServicio" id="idServicio" class="form-select" required>
                            <option value="">-- Seleccionar Servicio --</option>
                            @foreach(\App\Models\Servicio::all() as $servicio)
                                <option value="{{ $servicio->id }}" {{ old('idServicio', $reserva->idServicio) == $servicio->id ? 'selected' : '' }}>
                                    {{ $servicio->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Equipo (ONT) -->
                    <div class="col-md-3">
                        <label for="idEquipo" class="form-label fw-bold">Equipo <span class="text-danger">*</span></label>
                        <select name="idEquipo" id="idEquipo" class="form-select" required>
                            <option value="">-- Seleccionar Equipo --</option>
                            @foreach(\App\Models\Ont::all() as $equipo)
                                <option value="{{ $equipo->id }}" {{ old('idEquipo', $reserva->idEquipo) == $equipo->id ? 'selected' : '' }}>
                                    {{ $equipo->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Plan R -->
                    <div class="col-md-3">
                        <label for="idPlanr" class="form-label fw-bold">Plan R <span class="text-danger">*</span></label>
                        <select name="idPlanr" id="idPlanr" class="form-select" required>
                            <option value="">-- Seleccionar Plan R --</option>
                            @foreach(\App\Models\PlanR::all() as $planr)
                                <option value="{{ $planr->id }}" {{ old('idPlanr', $reserva->idPlanr) == $planr->id ? 'selected' : '' }}>
                                    {{ $planr->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Plan W -->
                    <div class="col-md-3">
                        <label for="idPlanw" class="form-label fw-bold">Plan W <span class="text-danger">*</span></label>
                        <select name="idPlanw" id="idPlanw" class="form-select" required>
                            <option value="">-- Seleccionar Plan W --</option>
                            @foreach(\App\Models\PlanW::all() as $planw)
                                <option value="{{ $planw->id }}" {{ old('idPlanw', $reserva->idPlanw) == $planw->id ? 'selected' : '' }}>
                                    {{ $planw->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Fibra -->
                    <div class="col-md-6">
                        <label for="fibra" class="form-label fw-bold">Fibra <span class="text-danger">*</span></label>
                        <input type="text" name="fibra" id="fibra" class="form-control" value="{{ old('fibra', $reserva->fibra) }}" required>
                    </div>

                    <!-- TV -->
                    <div class="col-md-3">
                        <label for="tv" class="form-label fw-bold">TV <span class="text-danger">*</span></label>
                        <input type="number" name="tv" id="tv" class="form-control" value="{{ old('tv', $reserva->tv) }}" required>
                    </div>

                    <!-- Línea -->
                    <div class="col-md-3">
                        <label for="linea" class="form-label fw-bold">Línea <span class="text-danger">*</span></label>
                        <input type="number" name="linea" id="linea" class="form-control" value="{{ old('linea', $reserva->linea) }}" required>
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <a href="{{ route('reservas.index') }}" class="btn btn-outline-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-info text-white"><i class="bi bi-arrow-repeat me-1"></i> Actualizar Reserva</button>
            </div>
        </form>
    </div>
@endsection