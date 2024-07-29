<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'vision',
        'texto_vision',
        'mision',
        'texto_mision',
        'valores',
        'texto_valores',
        'icono_vision',
        'icono_mision',
        'icono_valores',
    ];
}
