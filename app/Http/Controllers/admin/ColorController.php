<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use Illuminate\Support\Facades\Storage;


class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colores = Color::all();
        return view('admin.colores.index', compact('colores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.colores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'orden' => 'required|string',
            'nombre' => 'required|string|max:255',
            'color' => 'required|string',
          
        ]);

        $color = new Color();
        $color->orden = $request->orden;
        $color->nombre = $request->nombre;
        $color->color = $request->color;


        $color->save();

        return redirect()->route('admin.colores.index')->with('success', 'Color creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        return view('admin.colores.show', compact('color'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $color = Color::find($id);
        return view('admin.colores.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $color = Color::find($id);
        $request->validate([
            'orden' => 'required|string',
            'nombre' => 'required|string|max:255',
            'color' => 'required|string',
           
        ]);

        $color->orden = $request->orden;
        $color->nombre = $request->nombre;
        $color->color = $request->color;

        $color->save();

        return redirect()->route('admin.colores.index')->with('success', 'Color actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $color = Color::find($id);
        $color->delete();
        return redirect()->route('admin.colores.index')->with('success', 'Color eliminado exitosamente');
    }
}
