@extends('layouts.app')

@section('title', 'Editar Plan W')
@section('content_header', 'Editar Plan W')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-outline card-info shadow-sm">
            <div class="card-header">
                <h3 class="card-title fw-bold mb-0">Editar Plan W #{{ $planW->id }}</h3>
            </div>

            <form action="{{ route('planes_w.update', $planW) }}" method="POST">
                @csrf
                @method('PUT')
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
                        <label for="nombre" class="form-label">Nombre del Plan <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $planW->nombre) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="profile" class="form-label">Profile <span class="text-danger">*</span></label>
                        <input type="text" name="profile" id="profile" class="form-control @error('profile') is-invalid @enderror" value="{{ old('profile', $planW->profile) }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="velocidad_up" class="form-label">Velocidad Subida (Mbps) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="velocidad_up" id="velocidad_up" class="form-control @error('velocidad_up') is-invalid @enderror" value="{{ old('velocidad_up', $planW->velocidad_up) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="velocidad_down" class="form-label">Velocidad Bajada (Mbps) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="velocidad_down" id="velocidad_down" class="form-control @error('velocidad_down') is-invalid @enderror" value="{{ old('velocidad_down', $planW->velocidad_down) }}" required>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="{{ route('planes_w.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-info text-white">
                        <i class="bi bi-pencil-square me-1"></i> Actualizar Plan W
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection