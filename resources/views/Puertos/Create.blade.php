@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registrar Nuevo Puerto</h2>

    <form action="{{ route('puertos.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="idEquipo" class="form-label">Equipo</label>
                <select name="idEquipo" id="idEquipo" class="form-select @error('idEquipo') is-invalid @enderror" required>
                    <option value="">-- Seleccione un Equipo --</option>
                    @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id }}" {{ old('idEquipo') == $equipo->id ? 'selected' : '' }}>
                            {{ $equipo->nombre }} ({{ $equipo->ip }})
                        </option>
                    @endforeach
                </select>
                @error('idEquipo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="idReserva" class="form-label">Reserva / Cliente</label>
                <select name="idReserva" id="idReserva" class="form-select @error('idReserva') is-invalid @enderror" required>
                    <option value="">-- Seleccione una Reserva --</option>
                    @foreach($reservas as $reserva)
                        <option value="{{ $reserva->id }}" {{ old('idReserva') == $reserva->id ? 'selected' : '' }}>
                            Reserva #{{ $reserva->id }} - Cliente: {{ $reserva->cliente->nombre ?? 'N/A' }}
                        </option>
                    @endforeach
                </select>
                @error('idReserva')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="pon" class="form-label">PON</label>
                <input type="number" name="pon" id="pon" class="form-control @error('pon') is-invalid @enderror" value="{{ old('pon') }}" required>
                @error('pon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="puerto" class="form-label">Puerto</label>
                <input type="number" name="puerto" id="puerto" class="form-control @error('puerto') is-invalid @enderror" value="{{ old('puerto') }}" required>
                @error('puerto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
                    <option value="1" {{ old('estado', '1') == '1' ? 'selected' : '' }}>Activo (1)</option>
                    <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo (0)</option>
                </select>
                @error('estado')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-success">Guardar Puerto</button>
        <a href="{{ route('puertos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection