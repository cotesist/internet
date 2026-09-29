@extends('layouts.app')

@section('title', 'Nueva Observación')
@section('content_header', 'Crear Observación')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-outline card-primary shadow-sm">
            <div class="card-header">
                <h3 class="card-title fw-bold mb-0">Registrar Observación</h3>
            </div>

            <form action="{{ route('observaciones.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="idReserva" class="form-label">Reserva <span class="text-danger">*</span></label>
                        <select name="idReserva" id="idReserva" class="form-select @error('idReserva') is-invalid @enderror" required>
                            <option value="">-- Seleccionar Reserva --</option>
                            @foreach($reservas as $reserva)
                                <option value="{{ $reserva->id }}" {{ old('idReserva') == $reserva->id ? 'selected' : '' }}>
                                    Reserva #{{ $reserva->id }} - Cliente: {{ $reserva->cliente->nombre ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha y Hora <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', date('Y-m-d\TH:i')) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="texto" class="form-label">Detalle / Texto <span class="text-danger">*</span></label>
                        <textarea name="texto" id="texto" rows="4" class="form-control @error('texto') is-invalid @enderror" placeholder="Escribe aquí la observación..." required>{{ old('texto') }}</textarea>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="{{ route('observaciones.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Guardar Observación
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection