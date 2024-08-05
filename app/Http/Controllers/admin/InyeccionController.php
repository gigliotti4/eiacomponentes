<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Inyeccion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class InyeccionController extends Controller
{
    public function edit($id)
    {
        $contenido = Inyeccion::find($id);
        return view('admin.inyecciones.editar', compact('contenido', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $contenido = Inyeccion::find($id);
    
        if(is_null($contenido)) {
            $contenido = new Inyeccion();
        }
    
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreArchivo = Str::slug($request->titulo) . '.' . $imagen->getClientOriginalExtension();
            $path = $imagen->storeAs('public/inyecciones', $nombreArchivo);
            $contenido->imagen = $path;
        } else {
            $contenido->imagen = $contenido->imagen; // Mantener la imagen existente si no se cambia
        }
        
        $contenido->titulo = $request->titulo;
        $contenido->descripcion = $request->descripcion;
        $contenido->save();
    
        return redirect()->route('admin.inyecciones.edit', ['id' => $id])->with('success', "Registro actualizado exitosamente");
    }
}
