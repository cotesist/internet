@extends('layouts.app')

@section('title', 'Nuevo Plan R')
@section('content_header', 'Crear Plan R')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-outline card-primary shadow-sm">
            <div class="card-header">
                <h3 class="card-title fw-bold mb-0">Registrar Nuevo Plan R</h3>
            </div>

            <form action="{{ route('planes_r.store') }}" method="POST">
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
                        <label for="nombre" class="form-label">Nombre del Plan <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" placeholder="Ej. Plan Residencial 100M" required>
                    </div>

                    <div class="mb-3">
                        <label for="profile" class="form-label">Profile <span class="text-danger">*</span></label>
                        <input type="text" name="profile" id="profile" class="form-control @error('profile') is-invalid @enderror" value="{{ old('profile') }}" placeholder="Ej. PROFILE_RES_100M" required>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="{{ route('planes_r.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Guardar Plan R
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection