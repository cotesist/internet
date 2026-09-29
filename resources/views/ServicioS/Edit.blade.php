@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Servicio #{{ $servicio->id }}</h2>

    <form action="{{ route('servicios.update', $servicio->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Servicio</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $servicio->nombre) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Servicio</button>
        <a href="{{ route('servicios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection