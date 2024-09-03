<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderConsumidor extends Model
{
    use HasFactory;

    protected $table = 'orderconsumidores';

    // Define the fields that are mass assignable
    protected $fillable = [
        'nombreApellido',
        'dniCuit',
        'email',
        'celular',
        'direccion',
        'localidad',
        'provincia',
        'codigoPostal',
        'texto',
        'metododepago',
        'envio',
    ];
}
