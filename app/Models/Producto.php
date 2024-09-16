<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['orden', 'codigo', 'nombre', 'descripcion', 'imagen', 'galeria', 'precio', 'descuento', 'descuento_dos', 'cantidad', 'cantidad_dos', 'categoria_id'];

    protected $casts = [
        'galeria' => 'array',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function colores()
    {
        return $this->belongsToMany(Color::class, 'color_producto');
    }

    public function relaciones()
{
    return $this->belongsToMany(Producto::class, 'prelaciones', 'producto_id', 'relacionado_id');
}

    
    public function obtenerPrecioConDescuento($cantidadComprada)
    {
        $precio = $this->precio;

        if ($cantidadComprada >= $this->cantidad_dos) {
            // Aplicar el segundo descuento si la cantidad es mayor o igual a "cantidad_dos"
            $precioConDescuento = $precio - ($precio * ($this->descuento_dos / 100));
        } elseif ($cantidadComprada >= $this->cantidad) {
            // Aplicar el primer descuento si la cantidad es mayor o igual a "cantidad"
            $precioConDescuento = $precio - ($precio * ($this->descuento / 100));
        } else {
            // No hay descuento
            $precioConDescuento = $precio;
        }

        return round($precioConDescuento, 2); // Redondear a 2 decimales
    }



}
