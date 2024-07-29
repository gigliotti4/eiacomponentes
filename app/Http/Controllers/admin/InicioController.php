<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Inicio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class InicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Inicio $inicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contenido = Inicio::find($id);
        return view('admin.inicio.editar', compact('contenido', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $contenido = Inicio::find($id);
    
        if(is_null($contenido)) {
            $contenido = new Inicio();
        }
    
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreArchivo = Str::slug($request->titulo) . '.' . $imagen->getClientOriginalExtension();
            $path = $imagen->storeAs('public/inicio', $nombreArchivo);
            $contenido->imagen = $path;
        } else {
            $contenido->imagen = $contenido->imagen; // Mantener la imagen existente si no se cambia
        }
        
        $contenido->titulo = $request->titulo;
        $contenido->descripcion = $request->descripcion;
        $contenido->save();
    
        return redirect()->route('admin.inicio.edit', ['id' => $id])->with('success', "Registro actualizado exitosamente");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inicio $inicio)
    {
        //
    }
}
