<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
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
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return redirect()->route('admin.empresa.edit', ['id' => $id])->with('error', 'Registro no encontrado.');
        }

        return view('admin.empresa.editar', compact('empresa'));
    }

    public function update(Request $request, $id)
    {
        $empresa = Empresa::find($id);
        if(!is_null($id))
            $empresa = Empresa::find($id);
        else{
            $empresa          = new Empresa();
            
        }
        if ($request->hasFile('imagen'))
        { 
            $empresa->imagen = $request->file('imagen')->store('public/empresa');
        }

        if ($request->hasFile('icono_mision'))
        { 
            $empresa->icono_mision = $request->file('icono_mision')->store('public/empresa');
        }
        if ($request->hasFile('icono_vision'))
        { 
            $empresa->icono_vision = $request->file('icono_vision')->store('public/empresa');
        }
        if ($request->hasFile('icono_valores'))
        { 
            $empresa->icono_valores = $request->file('icono_valores')->store('public/empresa');
        }

     
    
        
        $empresa->titulo = $request->titulo;
        $empresa->descripcion = $request->descripcion;
        $empresa->vision = $request->vision;
        $empresa->texto_vision = $request->texto_vision;
        $empresa->mision = $request->mision;
        $empresa->texto_mision = $request->texto_mision;
        $empresa->valores = $request->valores;
        $empresa->texto_valores = $request->texto_valores;
        $empresa->save();
    
        return redirect()->route('admin.empresa.edit', ['id' => $id])->with('success', 'Registro actualizado exitosamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
