<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['orden', 'nombre', 'descripcion', 'imagen', 'galeria', 'precio', 'descuento', 'categoria_id'];

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
