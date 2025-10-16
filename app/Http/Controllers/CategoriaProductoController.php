<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use Illuminate\Http\Request;



class CategoriaProductoController extends Controller
{
    public function index()
    {
        $categorias = CategoriaProducto::withCount('productos')->get();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_categoria' => 'required|string|max:100|unique:categoria_producto,nombre_categoria'
        ], [
            'nombre_categoria.required' => 'El nombre de la categoría es obligatorio',
            'nombre_categoria.unique' => 'Esta categoría ya existe',
            'nombre_categoria.max' => 'El nombre no puede tener más de 100 caracteres'
        ]);
        CategoriaProducto::create($validated);
        return redirect()->route('categorias.index')
            ->with('success', 'Categoría creada exitosamente');
    }

    public function show($id)
    {
        $categoria = CategoriaProducto::with('productos')->findOrFail($id);
        return view('categorias.show', compact('categoria'));
    }

    public function edit($id)
    {
        $categoria = CategoriaProducto::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $categoria = CategoriaProducto::findOrFail($id);
        $validated = $request->validate([
            'nombre_categoria' => 'required|string|max:100|unique:categoria_producto,nombre_categoria,' . $id . ',id_categoria_producto'
        ], [
            'nombre_categoria.required' => 'El nombre de la categoría es obligatorio',
            'nombre_categoria.unique' => 'Esta categoría ya existe',
            'nombre_categoria.max' => 'El nombre no puede tener más de 100 caracteres'
        ]);
        $categoria->update($validated);
        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada exitosamente');
    }

    public function destroy($id)
    {
        $categoria = CategoriaProducto::findOrFail($id);
        if ($categoria->productos()->count() > 0) {
            return redirect()->route('categorias.index')
                ->with('error', 'No se puede eliminar la categoría porque tiene productos asociados');
        }
        $categoria->delete();
        return redirect()->route('categorias.index')
            ->with('success', 'Categoría eliminada exitosamente');
    }
}
