@extends('layouts.app')

@section('title', 'Categorías de Productos')

@section('content')
<div class="row mb-3">
    <div class="col">
        <h1><i class="bi bi-tags"></i> Categorías de Productos</h1>
    </div>
    <div class="col text-end">
        <a href="{{ route('categorias.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Categoría
        </a>
    </div>
</div>

<!-- Tabla de categorías -->
<div class="card">
    <div class="card-body">
        @if($categorias->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre de Categoría</th>
                            <th>Productos</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id_categoria_producto }}</td>
                            <td>{{ $categoria->nombre_categoria }}</td>
                            <td>
                                <span class="badge bg-info">
                                    {{ $categoria->productos_count }} producto(s)
                                </span>
                            </td>
                            <td class="text-center">
                                <!-- Botón Ver -->
                                <a href="{{ route('categorias.show', $categoria->id_categoria_producto) }}" 
                                   class="btn btn-sm btn-info" 
                                   title="Ver detalles">
                                    <i class="bi bi-eye"></i>
                                </a>
                                
                                <!-- Botón Editar -->
                                <a href="{{ route('categorias.edit', $categoria->id_categoria_producto) }}" 
                                   class="btn btn-sm btn-warning" 
                                   title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                
                                <!-- Botón Eliminar -->
                                <form action="{{ route('categorias.destroy', $categoria->id_categoria_producto) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('¿Está seguro de eliminar esta categoría?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> No hay categorías registradas.
                <a href="{{ route('categorias.create') }}">Crear la primera categoría</a>
            </div>
        @endif
    </div>
</div>
@endsection
