<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Producto
 * 
 * Representa la tabla 'producto' en la base de datos
 * Este modelo gestiona los productos de la dulcería
 */
class Producto extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'producto';

    // Nombre de la clave primaria personalizada
    protected $primaryKey = 'id_producto';

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'numero_serial',
        'nombre',
        'precio',
        'stock',
        'categoria_id'
    ];

    
     public $timestamps = false;

    // Casting de atributos: convierte automáticamente los tipos de datos
    protected $casts = [
        'precio' => 'decimal:2',  // Precio con 2 decimales
        'stock' => 'integer'       // Stock como entero
    ];

    /**
     * Relación: Un producto pertenece a una categoría
     * 
     * Esto nos permite hacer: $producto->categoria
     * para obtener la categoría del producto
     */
    public function categoria()
    {
        return $this->belongsTo(
            CategoriaProducto::class,     // Modelo relacionado
            'categoria_id',               // Clave foránea en esta tabla
            'id_categoria_producto'       // Clave primaria en tabla categorias
        );
    }
}
