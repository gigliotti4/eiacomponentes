<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zonapostale extends Model
{
    use HasFactory;

    protected $table = 'zonas_postales';

    protected $fillable = ['nombre', 'costo'];

       // Relación con códigos postales (una zona tiene muchos códigos postales)
       public function codigosPostales()
       {
           return $this->hasMany(CodigoPostale::class, 'zona');
       }
}
