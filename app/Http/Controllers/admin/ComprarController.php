<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comprar;
use Illuminate\Support\Facades\Storage;

class ComprarController extends Controller
{
    public function index()
    {
        $comprar = Comprar::all();
        return view('admin.comprar.index', compact('comprar'));
    }

    public function create()
    {
        return view('admin.comprar.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'orden' => 'nullable|string',
            'icono' => 'required|image',
            'numero' => 'required|image',
            'texto' => 'required|string'
        ]);

        // Subir imágenes
        if ($request->hasFile('icono')) {
            $data['icono'] = $request->file('icono')->store('iconos', 'public');
        }
        if ($request->hasFile('numero')) {
            $data['numero'] = $request->file('numero')->store('numeros', 'public');
        }

        Comprar::create($data);
        return redirect()->route('admin.comprar.index');
    }

    public function edit($id)
    {
        $comprar = Comprar::findOrFail($id);
        return view('admin.comprar.edit', compact('comprar'));
    }

    public function update(Request $request, $id)
    {
        $comprar = Comprar::findOrFail($id);
        $data = $request->validate([
            'orden' => 'nullable|string',
            'icono' => 'nullable|image',
            'numero' => 'nullable|image',
            'texto' => 'required|string'
        ]);

        // Subir nuevas imágenes si se han subido
        if ($request->hasFile('icono')) {
            Storage::disk('public')->delete($comprar->icono); // Eliminar la imagen anterior
            $data['icono'] = $request->file('icono')->store('iconos', 'public');
        }
        if ($request->hasFile('numero')) {
            Storage::disk('public')->delete($comprar->numero); // Eliminar la imagen anterior
            $data['numero'] = $request->file('numero')->store('numeros', 'public');
        }

        $comprar->update($data);
        return redirect()->route('admin.comprar.index');
    }

    public function destroy($id)
    {
        $comprar = Comprar::findOrFail($id);
        // Eliminar las imágenes asociadas
        Storage::disk('public')->delete($comprar->icono);
        Storage::disk('public')->delete($comprar->numero);

        $comprar->delete();
        return redirect()->route('admin.comprar.index');
    }
}
