@extends('layouts.app')

@section('title', 'Crear Categoría')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Crear Nueva Categoría</h4>
            </div>
            <div class="card-body">
                <!-- Formulario para crear categoría -->
                <form action="{{ route('categorias.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="nombre_categoria" class="form-label">Nombre de la Categoría *</label>
                        <input type="text" 
                               class="form-control @error('nombre_categoria') is-invalid @enderror" 
                               id="nombre_categoria" 
                               name="nombre_categoria" 
                               value="{{ old('nombre_categoria') }}"
                               placeholder="Ejemplo: Chocolates, Caramelos, Gomitas..."
                               required>
                        
                        @error('nombre_categoria')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        
                        <small class="form-text text-muted">
                            Ingrese un nombre único para la categoría (máximo 100 caracteres)
                        </small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Guardar Categoría
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
