<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CodersFree\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class Carritoinfo extends Model
{
    use HasFactory;
    protected $table = 'carritoinfos';

    protected $fillable = [
        'desc_mp',
        'desc_lo',
        'desc_tb',
        'desc_fabricante',
        'desc_minorista',
        'desc_mayorista',
        'info_retiro_local',
        'info_envio_caba',
        'info_envio_caba2',
        'minimo',
        'info_expreso',
        'expreso_detalle',
        'info_tc',
        'info_tb',
        'info_pago_local',
        'texto_mp',
        'texto_tb',
        'datos_tb',
        'terminos_detalle',
        'terminos',
    ];
    
}
