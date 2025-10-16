<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CategoriaProducto extends Model
{
    use HasFactory;

 
    protected $table = 'categoria_producto';

    protected $primaryKey = 'id_categoria_producto';


    protected $fillable = [
        'nombre_categoria'
    ];

     public $timestamps = false;

    /* 
      Esto me permite hacer: $categoria->productos
      para obtener todos los productos de una categoría
     */
    public function productos()
    {
        return $this->hasMany(
            Producto::class,           // Modelo relacionado
            'categoria_id',            // Clave foránea en la tabla productos
            'id_categoria_producto'    // Clave primaria en esta tabla
        );
    }
}
