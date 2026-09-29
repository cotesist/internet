@extends('layouts.app')

@section('title', 'Editar Plan R')
@section('content_header', 'Editar Plan R')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-outline card-info shadow-sm">
            <div class="card-header">
                <h3 class="card-title fw-bold mb-0">Editar Plan R #{{ $planR->id }}</h3>
            </div>

            <form action="{{ route('planes_r.update', $planR) }}" method="POST">
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
                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $planR->nombre) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="profile" class="form-label">Profile <span class="text-danger">*</span></label>
                        <input type="text" name="profile" id="profile" class="form-control @error('profile') is-invalid @enderror" value="{{ old('profile', $planR->profile) }}" required>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="{{ route('planes_r.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-info text-white">
                        <i class="bi bi-pencil-square me-1"></i> Actualizar Plan R
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection