<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Rede;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RedeController extends Controller
{
    public function edit($id)
    {
        $redes = Rede::findOrFail($id);
        return view('admin.redes.edit', compact('redes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // Validaciones aquí
        ]);

        $red = Rede::findOrFail($id);
        $red->update($request->all());

        return redirect()->route('redes.edit', $id)->with('success', 'Redes actualizada exitosamente.');
    }
}
