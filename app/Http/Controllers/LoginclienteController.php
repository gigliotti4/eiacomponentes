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


    public function index()
    {
        $clientes = Logincliente::all();
        return view('admin.loginclientes.index', compact('clientes'));
    }

    public function createcliente()
    {
        // Esto simplemente retorna la vista con el formulario para crear un cliente
        return view('admin.loginclientes.create');
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
            'role' => ['required', 'string', 'in:fabricante,minorista,mayorista'], // Restrict role to specific values
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
            'role' => $data['role'] // Add role field
        ]);
    }
    

    public function store(Request $request)
{
    $data = $request->all();

    $validator = Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255', 'unique:loginclientes'],
        'razon_social' => ['required', 'string', 'max:255'],
        'dni' => ['required', 'string', 'max:20'],
        'codigopostal' => ['required', 'string', 'max:10'],
        'telefono' => ['required', 'string', 'max:20'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:loginclientes'],
        'direccion' => ['required', 'string', 'max:255'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'role' => ['required', 'string', 'in:fabricante,minorista,mayorista'], // Validar el rol
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    Logincliente::create([
        'name' => $data['name'],
        'username' => $data['username'],
        'razon_social' => $data['razon_social'],
        'dni' => $data['dni'],
        'codigopostal' => $data['codigopostal'],
        'telefono' => $data['telefono'],
        'email' => $data['email'],
        'direccion' => $data['direccion'],
        'password' => Hash::make($data['password']),
        'role' => $data['role'], // Asignar el rol
        'estado' => 0, // Estado inicial
    ]);

    return redirect()->route('admin.loginclientes.index')->with('success', 'Cliente creado con éxito.');
    }


    public function edit($id)
    {
        $cliente = Logincliente::find($id);
        return view('admin.loginclientes.edit', compact('cliente'));
    }


    public function update(Request $request, $id)
    {
        $cliente = Logincliente::findOrFail($id);
    
        $data = $request->all();
    
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:loginclientes,username,' . $cliente->id],
            'razon_social' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'string', 'max:20'],
            'codigopostal' => ['required', 'string', 'max:10'],
            'telefono' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:loginclientes,email,' . $cliente->id],
            'direccion' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:fabricante,minorista,mayorista'], // Validate role
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $cliente->name = $data['name'];
        $cliente->username = $data['username'];
        $cliente->razon_social = $data['razon_social'];
        $cliente->dni = $data['dni'];
        $cliente->codigopostal = $data['codigopostal'];
        $cliente->telefono = $data['telefono'];
        $cliente->email = $data['email'];
        $cliente->direccion = $data['direccion'];
        $cliente->role = $data['role']; // Update role
    
        if (!empty($data['password'])) {
            $cliente->password = Hash::make($data['password']);
        }
    
        $cliente->save();
    
        return redirect()->route('admin.loginclientes.index')->with('success', 'Cliente actualizado con éxito.');
    }
    



    public function destroy($id)
    {
        $cliente = Logincliente::findOrFail($id);
        $cliente->delete();
    
        return redirect()->route('admin.loginclientes.index')->with('success', 'Cliente eliminado con éxito.');
    }
    



}
