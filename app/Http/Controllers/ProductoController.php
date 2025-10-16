<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\CategoriaProducto;
use Illuminate\Http\Request;


class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = CategoriaProducto::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_serial' => 'required|string|max:50|unique:producto,numero_serial',
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categoria_producto,id_categoria_producto'
        ], [
            'numero_serial.required' => 'El número de serial es obligatorio',
            'numero_serial.unique' => 'Este número de serial ya existe',
            'nombre.required' => 'El nombre del producto es obligatorio',
            'precio.required' => 'El precio es obligatorio',
            'precio.numeric' => 'El precio debe ser un número',
            'precio.min' => 'El precio no puede ser negativo',
            'stock.required' => 'El stock es obligatorio',
            'stock.integer' => 'El stock debe ser un número entero',
            'stock.min' => 'El stock no puede ser negativo',
            'categoria_id.required' => 'Debe seleccionar una categoría',
            'categoria_id.exists' => 'La categoría seleccionada no existe'
        ]);
        Producto::create($validated);
        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente');
    }

    public function show($id)
    {
                $producto = Producto::with('categoria')->findOrFail($id);
                return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
                $producto = Producto::findOrFail($id);
                $categorias = CategoriaProducto::all();
                return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $validated = $request->validate([
            'numero_serial' => 'required|string|max:50|unique:producto,numero_serial,' . $id . ',id_producto',
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categoria_producto,id_categoria_producto'
        ], [
            'numero_serial.required' => 'El número de serial es obligatorio',
            'numero_serial.unique' => 'Este número de serial ya existe',
            'nombre.required' => 'El nombre del producto es obligatorio',
            'precio.required' => 'El precio es obligatorio',
            'precio.numeric' => 'El precio debe ser un número',
            'precio.min' => 'El precio no puede ser negativo',
            'stock.required' => 'El stock es obligatorio',
            'stock.integer' => 'El stock debe ser un número entero',
            'stock.min' => 'El stock no puede ser negativo',
            'categoria_id.required' => 'Debe seleccionar una categoría',
            'categoria_id.exists' => 'La categoría seleccionada no existe'
        ]);

        $producto->update($validated);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente');
    }
}
