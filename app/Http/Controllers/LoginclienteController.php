<?php

namespace App\Http\Controllers;
use App\Models\Logincliente;
use Illuminate\Http\Request;
use App\Models\Contacto;
use App\Models\Logo;
use App\Models\Rede;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginclienteController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        // Verificar el estado del usuario
        $user = Logincliente::where('username', $request->username)->first();
        
        if ($user) {
            // Verificar si el estado del usuario es 1
            if ($user->estado == 1) {
                return redirect()->back()->withInput($request->only('username', 'remember'))->withErrors([
                    'username' => 'Ya puede hacer su pedido.',
                ]);
            }
    
            // Intentar autenticación
            if (Auth::guard('logincliente')->attempt(['username' => $request->username, 'password' => $request->password], $request->filled('remember'))) {
                return redirect()->intended(route('index'));
            }
        }
        
        // Si el usuario no existe o las credenciales son incorrectas
        return redirect()->back()->withInput($request->only('username', 'remember'))->withErrors([
            'username' => 'Estas credenciales no coinciden con nuestros registros.',
        ]);
    }
    
    

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }



    public function vistaregistro()
    { 
        $logo = Logo::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
        return view('page.zonacliente.registrarse' ,compact('redes', 'contacto', 'logo'));
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $cliente = $this->create($request->all());

        // Puedes agregar lógica adicional, como iniciar sesión al usuario después de registrarse
         // Almacenar un mensaje de éxito en la sesión
        session()->flash('success', 'Registro exitoso. ¡Bienvenido!, Espere que sea activado por EIA Componentes');

        return redirect()->route('registrarse'); // Cambia 'home' por la ruta deseada
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:loginclientes'],
            'razon_social' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'string', 'max:20'],
            'codigopostal' => ['required', 'string', 'max:10'],
            'telefono' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:loginclientes'],
            'direccion' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Logincliente::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'razon_social' => $data['razon_social'],
            'dni' => $data['dni'],
            'codigopostal' => $data['codigopostal'],
            'telefono' => $data['telefono'],
            'email' => $data['email'],
            'direccion' => $data['direccion'],
            'password' => Hash::make($data['password']),
            'estado' => 0,
        ]);
    }







}
