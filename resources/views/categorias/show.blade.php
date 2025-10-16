@extends('layouts.app')

@section('title', 'Detalles de Categoría')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <!-- Información de la categoría -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0"><i class="bi bi-info-circle"></i> Detalles de la Categoría</h4>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9">{{ $categoria->id_categoria_producto }}</dd>

                    <dt class="col-sm-3">Nombre:</dt>
                    <dd class="col-sm-9">{{ $categoria->nombre_categoria }}</dd>

                    <dt class="col-sm-3">Productos:</dt>
                    <dd class="col-sm-9">
                        <span class="badge bg-info">{{ $categoria->productos->count() }} producto(s)</span>
                    </dd>
                </dl>

                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('categorias.edit', $categoria->id_categoria_producto) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                </div>
            </div>
        </div>

        <!-- Lista de productos de esta categoría -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-box-seam"></i> Productos de esta Categoría</h5>
            </div>
            <div class="card-body">
                @if($categoria->productos->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categoria->productos as $producto)
                                <tr>
                                    <td>{{ $producto->numero_serial }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>${{ number_format($producto->precio, 2) }}</td>
                                    <td>{{ $producto->stock }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted mb-0">No hay productos en esta categoría.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
