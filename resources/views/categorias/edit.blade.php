@extends('layouts.app')

@section('title', 'Editar Categoría')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-warning">
                <h4 class="mb-0"><i class="bi bi-pencil"></i> Editar Categoría</h4>
            </div>
            <div class="card-body">
                <!-- Formulario para editar categoría -->
                <form action="{{ route('categorias.update', $categoria->id_categoria_producto) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="nombre_categoria" class="form-label">Nombre de la Categoría *</label>
                        <input type="text" 
                               class="form-control @error('nombre_categoria') is-invalid @enderror" 
                               id="nombre_categoria" 
                               name="nombre_categoria" 
                               value="{{ old('nombre_categoria', $categoria->nombre_categoria) }}"
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
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save"></i> Actualizar Categoría
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
