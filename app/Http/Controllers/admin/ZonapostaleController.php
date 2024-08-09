<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Zonapostale;
use App\Models\Codigopostale;
use Illuminate\Http\Request;

class ZonapostaleController extends Controller
{
    public function index(){
        $zonas = Zonapostale::orderBy('nombre')->get();
        return view('admin.zonaspostales.index', compact('zonas'));
    }

    public function create(){

        return view('admin.zonaspostales.create');
    }

    public function store(Request $request){
        if(Zonapostale::where('nombre', $request->nombre)->first()){
            return redirect()->back()->with('danger', 'Ya existe una zona con ese nombre');
        } else {
            $zona = new Zonapostale();
            $zona->nombre = $request->nombre;
            $zona->costo = $request->costo;
            $zona->save();
            return redirect()->route('admin.zonaspostales.index')->with('success', 'zona creada exitosamente.');
        }        
    }

    public function edit($id)
    {
        $zona = Zonapostale::find($id);
       
        return view('admin.zonaspostales.edit', compact('zona'));
    }

    public function update(Request $request){

        if(Zonapostale::where('nombre', $request->nombre)->where('id', '!=', $request->id)->first()){
            return redirect()->back()->with('warning', 'Ya existe una zona con ese nombre');
        } else {
            $zona = Zonapostale::find($request->id);
            $zona->nombre = $request->nombre;
            $zona->costo = $request->costo;
            $zona->save();
            return redirect()->route('admin.zonaspostales.index')->with('success', 'zona actualizada exitosamente.');
        }        
    }

    public function delete(Request $request){
        $zona = Zonapostale::find($request->id);
        
        $codigos = Codigopostale::where('zona', $zona->nombre)->get();
        foreach($codigos as $cp){
            $cp->zona = null;
            $cp->save();
        }
        $zona->delete();

        return redirect()->route('admin.zonaspostales.index')->with('danger', 'zona eliminada exitosamente.');
    }
}
