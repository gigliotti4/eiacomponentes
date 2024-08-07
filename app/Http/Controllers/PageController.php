<?php

namespace App\Http\Controllers;
use App\Models\Inicio;
use App\Models\Empresa;
use App\Models\Contacto;
use App\Models\Logo;
use App\Models\Rede;
use App\Models\Slider;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Color;
use App\Models\Inyeccion;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactoMail;
use App\Mail\PresupuestoMail;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use CodersFree\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;

class PageController extends Controller
{


    public function index(){
    // Obtener los datos de los modelos
    $logo = Logo::first();
    $inicio = Inicio::first();
    $redes = Rede::first();
    $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
    $sliders = Slider::where('seccion', 'inicio')->get();
    $cartCount = Cart::content()->count();
    // Pasar los datos a la vista
    return view('page.index', compact('inicio', 'redes', 'contacto', 'sliders', 'logo', 'cartCount'));
    }


    public function empresa(){
    // Obtener los datos de los modelos
    $logo = Logo::first();
    $empresa = Empresa::first();
    $redes = Rede::first();
    $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
    $sliders = Slider::where('seccion', 'empresa')->get();
    $cartCount = Cart::content()->count();
    // Pasar los datos a la vista
    return view('page.empresa', compact('empresa', 'redes', 'contacto', 'logo', 'sliders', 'cartCount'));
    
    }

    public function inyecciones(){
        // Obtener los datos de los modelos
        $logo = Logo::first();
        $inyecciones = Inyeccion::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
       $sliders = Slider::where('seccion', 'inyecciones')->get();
        // Pasar los datos a la vista
        return view('page.inyecciones', compact('inyecciones', 'redes', 'contacto', 'logo', 'sliders'));
        
        }
    
    public function categorias(){
        // Obtener los datos de los modelos
        $logo = Logo::first();
        $empresa = Empresa::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
        $categorias = Categoria::orderBy('orden', 'asc')->get();
        $productos = Producto::orderBy('orden', 'asc')->get();
        $colores = Color::orderBy('orden', 'asc')->get();
        $cartCount = Cart::content()->count();
       // $sliders = Slider::where('seccion', 'inicio')->get();
        // Pasar los datos a la vista
        return view('page.categorias', compact('empresa', 'redes', 'contacto', 'logo', 'categorias', 'productos', 'colores', 'cartCount'));
        
        }

        public function producto($id){
            // Obtener los datos de los modelos
            $logo = Logo::first();
            $empresa = Empresa::first();
            $redes = Rede::first();
            $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
            $categorias = Categoria::orderBy('orden', 'asc')->get();
            $producto = Producto::find($id);
            $colores = Color::orderBy('orden', 'asc')->get();
            $cartCount = Cart::content()->count();
           // $sliders = Slider::where('seccion', 'inicio')->get();
            // Pasar los datos a la vista
            return view('page.producto', compact('empresa', 'redes', 'contacto', 'logo', 'categorias', 'producto', 'colores', 'cartCount'));
            
            }


        public function filtroProducto(Request $request)
        {
              // Obtener los datos de los modelos
        $logo = Logo::first();
        $empresa = Empresa::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
            // Obtiene todas las categorías de la base de datos
            $categorias = Categoria::all();

            // Obtiene todos los colores de la base de datos
            $colores = Color::all();

            // Crea una consulta base para el modelo Producto
            $query = Producto::query();

            // Verifica si el parámetro 'categoria_id' está presente en la solicitud
            if ($request->filled('categoria_id')) {
                // Si 'categoria_id' está presente, filtra los productos por esta categoría
                $query->where('categoria_id', $request->categoria_id);
            }

            // Verifica si el parámetro 'color_id' está presente en la solicitud
            if ($request->filled('color_id')) {
                // Si 'color_id' está presente, filtra los productos que tienen el color especificado
                $query->whereHas('colores', function ($q) use ($request) {
                    // Añade una condición para que el ID del color coincida con 'color_id'
                    $q->where('color_id', $request->color_id);
                });
            }

            // Ejecuta la consulta y obtiene todos los productos que cumplen con los filtros aplicados
            $productos = $query->get();

            // Devuelve la vista 'productos.index' con las categorías, colores y productos obtenidos
            return view('page.categorias', compact('categorias', 'colores', 'productos', 'redes', 'contacto', 'logo'));
        }
   

    public function contacto(){
        // Obtener los datos de los modelos
        $logo = Logo::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
        // Pasar los datos a la vista
        return view('page.contacto', compact('redes', 'contacto', 'logo'));
    }

    public function presupuesto(){
        // Obtener los datos de los modelos
        $logo = Logo::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
    
        // Pasar los datos a la vista
        return view('page.presupuesto', compact('redes', 'contacto', 'logo'));
    }

    public function newsletter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletters,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Newsletter::create([
            'email' => $request->email,
        ]);

        return response()->json(['success' => '¡Te has suscrito exitosamente!']);
    }

        public function sendContactoMail(Request $request)
        {
            // Validar el formulario antes de verificar reCAPTCHA
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required',
                'g-recaptcha-response' => 'required'
            ]);

            // Verificar reCAPTCHA
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response')
            ])->object();

            if ($response->success && $response->score >= 0.7) {
                try {
                    // Enviar el correo electrónico
                    Mail::to('gigliottilucas4@gmail.com')->send(new ContactoMail($validated));

                    return response()->json(['message' => 'Mensaje enviado exitosamente.']);
                } catch (\Exception $e) {
                    // Capturar y manejar cualquier excepción que ocurra durante el proceso
                    return response()->json(['error' => 'Error al enviar el mensaje.'], 500);
                }
            } else {
                return response()->json(['error' => 'No se pudo enviar la solicitud. Verificación de reCAPTCHA fallida.'], 422);
            }
        }



    
    public function sendPresupuestoMail(Request $request)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response')
        ])->object();
    
        if ($response->success && $response->score >= 0.7) {
            try {
                $validated = $request->validate([
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required',
                    'message' => 'required',
                    'file' => 'required|file|max:10240', // Validar el archivo (máximo 10MB)
                ]);
    
                // Guardar el archivo en el almacenamiento
                $filePath = $request->file('file')->store('presupuestos');
                // Enviar el correo con el archivo adjunto
                Mail::to('gigliottilucas4@gmail.com')->send(new PresupuestoMail($validated, $filePath));
    
                return response()->json(['message' => 'Presupuesto enviado exitosamente.']);
    
            } catch (\Exception $e) {
                // Capturar y manejar cualquier excepción que ocurra durante el proceso
                return response()->json(['error' => 'Error al enviar el mensaje.'], 500);
            }
        } else {
            return response()->json(['error' => 'No se pudo enviar la solicitud']);
        }
    }
    
    
}
