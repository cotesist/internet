@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registrar Nuevo Servicio</h2>

    <form action="{{ route('servicios.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Servicio</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Ej. Fibra Óptica / IPTV" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar Servicio</button>
        <a href="{{ route('servicios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection