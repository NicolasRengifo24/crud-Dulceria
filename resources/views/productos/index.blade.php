@extends('layouts.app')

@section('title', 'Productos')

@section('content')
<div class="row mb-3">
    <div class="col">
        <h1>
            <img src="{{ asset('images/dulce.png') }}" alt="Dulce" style="width: 40px; height: 40px; margin-right: 10px;">
            Dulces y Productos
        </h1>
    </div>
    <div class="col text-end">
        <a href="{{ route('productos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Agrega Un Producto 
        </a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        @if($productos->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Número Serial</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                        <tr>
                            <td>{{ $producto->id_producto }}</td>
                            <td><code>{{ $producto->numero_serial }}</code></td>
                            <td>{{ $producto->nombre }}</td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $producto->categoria->nombre_categoria }}
                                </span>
                            </td>
                            <td>${{ number_format($producto->precio, 2) }}</td>
                            <td>
                                @if($producto->stock > 10)
                                    <span class="badge bg-success">{{ $producto->stock }}</span>
                                @elseif($producto->stock > 0)
                                    <span class="badge bg-warning">{{ $producto->stock }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $producto->stock }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('productos.show', $producto->id_producto) }}" 
                                   class="btn btn-sm btn-info" 
                                   title="Ver detalles">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('productos.edit', $producto->id_producto) }}" 
                                   class="btn btn-sm btn-warning" 
                                   title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('productos.destroy', $producto->id_producto) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('¿Está seguro de eliminar este producto?')">
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
                <i class="bi bi-info-circle"></i> No hay productos registrados.
                <a href="{{ route('productos.create') }}">Crear el primer producto</a>
            </div>
        @endif
    </div>
</div>
@endsection
