@extends('layouts.app')

@section('title', 'Detalles del Producto')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0"><i class="bi bi-info-circle"></i> Detalles del Producto</h4>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9">{{ $producto->id_producto }}</dd>

                    <dt class="col-sm-3">Número Serial:</dt>
                    <dd class="col-sm-9"><code>{{ $producto->numero_serial }}</code></dd>

                    <dt class="col-sm-3">Nombre:</dt>
                    <dd class="col-sm-9">{{ $producto->nombre }}</dd>

                    <dt class="col-sm-3">Categoría:</dt>
                    <dd class="col-sm-9">
                        <span class="badge bg-secondary">
                            {{ $producto->categoria->nombre_categoria }}
                        </span>
                    </dd>

                    <dt class="col-sm-3">Precio:</dt>
                    <dd class="col-sm-9">
                        <strong class="text-success">${{ number_format($producto->precio, 2) }}</strong>
                    </dd>

                    <dt class="col-sm-3">Stock:</dt>
                    <dd class="col-sm-9">
                        @if($producto->stock > 10)
                            <span class="badge bg-success">{{ $producto->stock }} unidades</span>
                        @elseif($producto->stock > 0)
                            <span class="badge bg-warning">{{ $producto->stock }} unidades</span>
                        @else
                            <span class="badge bg-danger">{{ $producto->stock }} unidades (Agotado)</span>
                        @endif
                    </dd>

                    @if($producto->created_at)
                    <dt class="col-sm-3">Fecha de creación:</dt>
                    <dd class="col-sm-9">{{ $producto->created_at->format('d/m/Y H:i') }}</dd>
                    @endif

                    @if($producto->updated_at)
                    <dt class="col-sm-3">Última actualización:</dt>
                    <dd class="col-sm-9">{{ $producto->updated_at->format('d/m/Y H:i') }}</dd>
                    @endif
                </dl>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <div>
                        <a href="{{ route('productos.edit', $producto->id_producto) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('productos.destroy', $producto->id_producto) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('¿Está seguro de eliminar este producto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
