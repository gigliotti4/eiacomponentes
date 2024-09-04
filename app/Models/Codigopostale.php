<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codigopostale extends Model
{
    use HasFactory;

    protected $table = 'codigos_postales';

    protected $fillable = ['cp', 'provincia', 'localidad', 'zona'];

    // Relación con zona postal (un código postal pertenece a una zona)
    public function zonaPostal()
    {
        return $this->belongsTo(ZonaPostale::class, 'zona');
    }
}
