@extends('layouts.app')

@section('title', 'Nuevo Cliente')
@section('content_header', 'Registrar Cliente')

@section('content')
    <div class="card card-outline card-primary mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title fw-bold"><i class="bi bi-person-plus me-2"></i> Formulario de Registro</h3>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Volver al listado
            </a>
        </div>

        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="bi bi-exclamation-triangle me-2"></i>Por favor corrige los siguientes errores:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label fw-bold">Nombre Completo <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Ej: DAYSI LAHOR PASQUIER" required>
                    </div>

                    <div class="col-md-3">
                        <label for="telefono" class="form-label fw-bold">Teléfono Fijo <span class="text-danger">*</span></label>
                        <input type="number" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}" placeholder="Ej: 6453562" required>
                    </div>

                    <div class="col-md-3">
                        <label for="celular" class="form-label fw-bold">Celular</label>
                        <input type="number" name="celular" id="celular" class="form-control" value="{{ old('celular') }}" placeholder="Ej: 72851724">
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Guardar Cliente</button>
            </div>
        </form>
    </div>
@endsection