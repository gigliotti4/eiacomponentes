<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductoController extends Controller
{
    // Otros métodos...

    public function index()
    {
        $productos = Producto::all();   
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $colores = Color::all();
        return view('admin.productos.create', compact('categorias', 'colores'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'orden' => 'required|string',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'galeria' => 'nullable|array',
            'galeria.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'precio' => 'numeric',
            'categorias' => 'required|array',
            'categorias.*' => 'exists:categorias,id',
            'colores' => 'nullable|array',
            'colores.*' => 'exists:colors,id',
        ]);

        $data = $request->all();

        // Manejo de la carga de la imagen principal
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('galeria', $imageName, 'public');
            $data['imagen'] = $imagePath;
        }

        // Manejo de la carga de la galería de imágenes
        if ($request->hasFile('galeria')) {
            $galeria = [];
            foreach ($request->file('galeria') as $image) {
                $imageName = $image->getClientOriginalName();
                $imagePath = $image->storeAs('productos', $imageName, 'public');
                $galeria[] = $imagePath;
            }
            $data['galeria'] = json_encode($galeria);
        }

        $producto = Producto::create($data);

        // Asignar categorías al producto
        $producto->categorias()->sync($request->categorias);

        // if ($request->has('colores')) {
        //     $producto->colores()->sync($request->colores);
        // }

        //     // Buscar productos relacionados dentro de la misma categoría
        //     $relacionados = Producto::where('categoria_id', $producto->categoria_id)
        //     ->where('id', '!=', $producto->id)
        //     ->inRandomOrder()
        //     ->limit(4) // Limita a 3 productos relacionados
        //     ->get();

        // // Asigna productos relacionados
        // foreach ($relacionados as $relacionado) {
        // $producto->relaciones()->attach($relacionado->id);
        // }


        return redirect()->route('admin.productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        $colores = Color::all();
        return view('admin.productos.edit', compact('producto', 'categorias', 'colores'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'orden' => 'required|string',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'galeria' => 'nullable|array',
            'galeria.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'precio' => 'required|numeric',
            'categorias' => 'required|array',
            'categorias.*' => 'exists:categorias,id',
            'colores' => 'nullable|array',
            'colores.*' => 'exists:colors,id',
        ]);

        $data = $request->all();

        // Manejo de la carga de la imagen principal
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('productos', $imageName, 'public');
            $data['imagen'] = $imagePath;
        }

        // Manejo de la carga de la galería de imágenes
        if ($request->hasFile('galeria')) {
            $galeria = [];
            foreach ($request->file('galeria') as $image) {
                $imageName = $image->getClientOriginalName();
                $imagePath = $image->storeAs('galeria', $imageName, 'public');
                $galeria[] = $imagePath;
            }
            $data['galeria'] = json_encode($galeria);
        }

        $producto->update($data);

         // Asignar categorías al producto
    $producto->categorias()->sync($request->categorias);

        // if ($request->has('colores')) {
        //     $producto->colores()->sync($request->colores);
        // } else {
        //     $producto->colores()->detach();
        // }

        //    // Obtener 3 productos aleatorios de la misma categoría, excluyendo el producto actual
        //     $relacionados = Producto::where('categoria_id', $producto->categoria_id)
        //     ->where('id', '!=', $producto->id)
        //     ->inRandomOrder()
        //     ->limit(4)
        //     ->pluck('id')->toArray();

        // // Sincronizar los productos relacionados
        // $producto->relaciones()->sync($relacionados);

        return redirect()->route('admin.productos.index')->with('success', 'Producto "' . $producto->nombre . '" actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        return redirect()->route('admin.productos.index')->with('danger', 'Producto eliminada exitosamente.');
    }

    public function eliminarImagen($id, $key)
    {
        $producto = Producto::findOrFail($id);
        $galeria = json_decode($producto->galeria, true);

        if (isset($galeria[$key])) {
            // Eliminar la imagen del almacenamiento
            Storage::disk('public')->delete($galeria[$key]);

            // Eliminar la imagen del array y guardar el producto actualizado
            unset($galeria[$key]);
            $producto->galeria = json_encode(array_values($galeria)); // Reindexar array
            $producto->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Imagen no encontrada']);
    }
    
}

