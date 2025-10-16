@extends('layouts.app')

@section('title', 'Crear Producto')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Crear Nuevo Producto</h4>
            </div>
            <div class="card-body">
                <!-- Formulario para crear producto -->
                <form action="{{ route('productos.store') }}" method="POST">
                    @csrf
                    
                    <!-- Número Serial -->
                    <div class="mb-3">
                        <label for="numero_serial" class="form-label">Número Serial *</label>
                        <input type="text" 
                               class="form-control @error('numero_serial') is-invalid @enderror" 
                               id="numero_serial" 
                               name="numero_serial" 
                               value="{{ old('numero_serial') }}"
                               placeholder="Ejemplo: PROD-001"
                               required>
                        
                        @error('numero_serial')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nombre del Producto -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Producto *</label>
                        <input type="text" 
                               class="form-control @error('nombre') is-invalid @enderror" 
                               id="nombre" 
                               name="nombre" 
                               value="{{ old('nombre') }}"
                               placeholder="Ejemplo: Chocolate con Leche"
                               required>
                        
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Categoría -->
                    <div class="mb-3">
                        <label for="categoria_id" class="form-label">Categoría *</label>
                        <select class="form-select @error('categoria_id') is-invalid @enderror" 
                                id="categoria_id" 
                                name="categoria_id" 
                                required>
                            <option value="">-- Seleccione una categoría --</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria_producto }}" 
                                        {{ old('categoria_id') == $categoria->id_categoria_producto ? 'selected' : '' }}>
                                    {{ $categoria->nombre_categoria }}
                                </option>
                            @endforeach
                        </select>
                        
                        @error('categoria_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <small class="form-text text-muted">
                            Si no encuentra la categoría, puede 
                            <a href="{{ route('categorias.create') }}" target="_blank">crear una nueva aquí</a>
                        </small>
                    </div>

                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio *</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" 
                                   class="form-control @error('precio') is-invalid @enderror" 
                                   id="precio" 
                                   name="precio" 
                                   value="{{ old('precio') }}"
                                   step="0.01"
                                   min="0"
                                   placeholder="0.00"
                                   required>
                            
                            @error('precio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Stock -->
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock (Cantidad disponible) *</label>
                        <input type="number" 
                               class="form-control @error('stock') is-invalid @enderror" 
                               id="stock" 
                               name="stock" 
                               value="{{ old('stock', 0) }}"
                               min="0"
                               required>
                        
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Guardar Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
