@extends('layouts.app')

@section('title', 'Nueva URA')
@section('content_header', 'Crear URA')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-outline card-primary shadow-sm">
            <div class="card-header">
                <h3 class="card-title fw-bold mb-0">Registrar Nueva URA</h3>
            </div>

            <form action="{{ route('uras.store') }}" method="POST">
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
                        <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" placeholder="Ej. URA Sector Norte" required>
                    </div>

                    <div class="mb-3">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input type="text" name="ubicacion" id="ubicacion" class="form-control @error('ubicacion') is-invalid @enderror" value="{{ old('ubicacion') }}" placeholder="Ej. Av. Central Nro. 123">
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="{{ route('uras.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Guardar URA
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection