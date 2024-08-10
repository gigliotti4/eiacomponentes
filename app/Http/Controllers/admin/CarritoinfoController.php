<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carritoinfo;
use Illuminate\Support\Facades\Storage;


class CarritoinfoController extends Controller
{

    public function edit($id)
    {
        $carritoinfo = CarritoInfo::find($id);
        return view('admin.carritoinfo.edit', compact('carritoinfo', 'id'));
    }

    public function update(Request $request, $id)
    {
        $carritoinfo = CarritoInfo::findOrFail($id);
        $carritoinfo->update($request->all());

        return redirect()->route('admin.carritoinfo.edit', ['id' => $id])->with('success', 'Información del carrito actualizada con éxito');
    }
}
