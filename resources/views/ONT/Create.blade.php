@extends('layouts.app')

@section('title', 'Nueva ONT')
@section('content_header', 'Crear Equipo ONT')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-outline card-primary shadow-sm">
            <div class="card-header">
                <h3 class="card-title fw-bold mb-0">Registrar Equipo ONT</h3>
            </div>

            <form action="{{ route('onts.store') }}" method="POST">
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
                        <label for="nombre" class="form-label">Nombre del Equipo / Identificador <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" placeholder="Ej. ONT Huawei Principal" required>
                    </div>

                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca <span class="text-danger">*</span></label>
                        <input type="text" name="marca" id="marca" class="form-control @error('marca') is-invalid @enderror" value="{{ old('marca') }}" placeholder="Ej. Huawei, ZTE, FiberHome" required>
                    </div>

                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo <span class="text-danger">*</span></label>
                        <input type="text" name="modelo" id="modelo" class="form-control @error('modelo') is-invalid @enderror" value="{{ old('modelo') }}" placeholder="Ej. HG8145V5" required>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="{{ route('onts.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Guardar ONT
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection