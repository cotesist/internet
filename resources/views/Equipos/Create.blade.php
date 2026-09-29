@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registrar Nuevo Equipo</h2>

    <form action="{{ route('equipos.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre del Equipo</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="ip" class="form-label">Dirección IP</label>
                <input type="text" name="ip" class="form-control" value="{{ old('ip') }}" placeholder="192.168.1.1" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="idUra" class="form-label">URA</label>
                <select name="idUra" class="form-select" required>
                    <option value="">Seleccione una URA</option>
                    @foreach($uras as $ura)
                        <option value="{{ $ura->id }}">{{ $ura->nombre ?? 'URA '.$ura->id }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="idServicio" class="form-label">Servicio</label>
                <select name="idServicio" class="form-select" required>
                    <option value="">Seleccione un Servicio</option>
                    @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id }}">{{ $servicio->nombre ?? 'Servicio '.$servicio->id }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="latitud" class="form-label">Latitud</label>
                <input type="text" name="latitud" class="form-control" value="{{ old('latitud') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="longitud" class="form-label">Longitud</label>
                <input type="text" name="longitud" class="form-control" value="{{ old('longitud') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="user" class="form-label">Usuario Acceso</label>
                <input type="text" name="user" class="form-control" value="{{ old('user') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="passw" class="form-label">Contraseña Acceso</label>
                <input type="password" name="passw" class="form-control" required>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Guardar Equipo</button>
        <a href="{{ route('equipos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection