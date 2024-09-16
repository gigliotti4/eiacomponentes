<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Zonapostale;
use App\Models\Codigopostale;
use Illuminate\Http\Request;

class CodigopostaleController extends Controller
{
    public function index(){
        $codigos = Codigopostale::all();
        $zonas = Zonapostale::orderBy('nombre')->get();
        return view('admin.codigospostales.index', compact('codigos', 'zonas'));
    }

    public function buscar(Request $request)
{
    $query = $request->get('query', '');

    if($request->ajax() && !empty($query)) {
        $codigos = Codigopostale::where('cp', 'like', '%'.$query.'%')
                    ->orWhere('provincia', 'like', '%'.$query.'%')
                    ->orWhere('localidad', 'like', '%'.$query.'%')
                    ->orWhere('zona', 'like', '%'.$query.'%')
                    ->get();
    } else {
        $codigos = Codigopostale::all();
    }

    return view('admin.codigospostales.table', compact('codigos'))->render();
}

    public function edit($id)
    {
        $codigos = Codigopostale::find($id);
        $zonas = Zonapostale::orderBy('nombre')->get();
        return view('admin.codigospostales.edit', compact('codigos', 'zonas'));
    }

    public function update(Request $request, $id){
       // Encontrar el código postal a actualizar
    $codigo = Codigopostale::findOrFail($id);

    // Actualizar los campos
    $codigo->cp = $request->input('cp');
    $codigo->provincia = $request->input('provincia');
    $codigo->localidad = $request->input('localidad');
    $codigo->zona = $request->input('zona');
    $codigo->save();

    return redirect()->route('admin.codigospostales.index')->with('success', 'Código Postal actualizado exitosamente.');
    }
}
