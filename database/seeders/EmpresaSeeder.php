<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear un único registro para la tabla 'empresas'
        Empresa::create([
            'titulo' => 'Título de la empresa',
            'descripcion' => 'Descripción de la empresa',
            'imagen' => 'public/empresa/ejemplo.jpg', // Ruta de la imagen de ejemplo
            'vision' => 'Visión de la empresa',
            'texto_vision' => 'Texto de la visión de la empresa',
            'mision' => 'Misión de la empresa',
            'texto_mision' => 'Texto de la misión de la empresa',
            'valores' => 'Valores de la empresa',
            'texto_valores' => 'Texto de los valores de la empresa',
            'icono_vision' => 'public/icons/icon_vision.png', // Ruta del icono de visión de ejemplo
            'icono_mision' => 'public/icons/icon_mision.png', // Ruta del icono de misión de ejemplo
            'icono_valores' => 'public/icons/icon_valores.png', // Ruta del icono de valores de ejemplo
        ]);
    }
}
