<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('orden')->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'orden' => 'required|string',
            'nombre' => 'required|string|max:255',
        ]);

        Categoria::create($request->all());
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);
        $request->validate([
            'orden' => 'required|string',
            'nombre' => 'required|string|max:255',
        ]);

        $categoria->update($request->all());
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();
        return redirect()->route('admin.categorias.index')->with('danger', 'Categoría eliminada exitosamente.');
    }
}
