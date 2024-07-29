<?php

namespace App\Http\Controllers;
use App\Models\Inicio;
use App\Models\Empresa;
use App\Models\Contacto;
use App\Models\Logo;
use App\Models\Rede;
use App\Models\Slider;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactoMail;
use App\Mail\PresupuestoMail;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
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

    // Pasar los datos a la vista
    return view('page.index', compact('inicio', 'redes', 'contacto', 'sliders', 'logo'));
    }


    public function empresa(){
    // Obtener los datos de los modelos
    $logo = Logo::first();
    $empresa = Empresa::first();
    $redes = Rede::first();
    $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
   // $sliders = Slider::where('seccion', 'inicio')->get();
    // Pasar los datos a la vista
    return view('page.empresa', compact('empresa', 'redes', 'contacto', 'logo'));
    
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
        $sectores = Sectore::orderBy('orden', 'asc')->get();
        // Pasar los datos a la vista
        return view('page.presupuesto', compact('redes', 'contacto', 'logo', 'sectores'));
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
