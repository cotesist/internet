@extends('layouts.app')

@section('title', 'Nueva Línea')
@section('content_header', 'Crear Línea')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-outline card-primary shadow-sm">
            <div class="card-header">
                <h3 class="card-title fw-bold">Registrar Nueva Línea</h3>
            </div>

            <form action="{{ route('lineas.store') }}" method="POST">
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
                        <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                        <input type="number" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" placeholder="Ej. 71234567" required>
                    </div>

                    <div class="mb-3">
                        <label for="clave" class="form-label">Clave <span class="text-danger">*</span></label>
                        <input type="text" name="clave" id="clave" class="form-control @error('clave') is-invalid @enderror" value="{{ old('clave') }}" maxlength="10" placeholder="Máximo 10 caracteres" required>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="{{ route('lineas.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Guardar Línea
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection