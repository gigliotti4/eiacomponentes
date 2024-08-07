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
}
