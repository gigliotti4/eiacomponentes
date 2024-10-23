<?php
namespace App\Http\Controllers;
use CodersFree\Shoppingcart\Facades\Cart;
use App\Models\Producto;
use App\Models\Contacto;
use App\Models\Logo;
use App\Models\Rede;
use App\Models\Categoria;
use App\Models\Color;
use App\Models\Carritoinfo;
use App\Models\Zonapostale;
use App\Models\Codigopostale;
use App\Models\OrderConsumidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Exception;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use App\Mail\Carritopedido;
use App\Mail\CarritoPresupuesto;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{


    public function calcularEnvio(Request $request)
    {
        // Validar que se haya ingresado un código postal
        $request->validate([
             'codigo_postal' => 'required|exists:codigos_postales,cp'
         ]);

        // Buscar la zona asociada al código postal
        $codigoPostal = Codigopostale::where('cp', $request->codigo_postal)->first();
        if ($codigoPostal) {
            
            $zona = $codigoPostal->zona;
            // Encuentra el costo de la zona
            $zonaPostal = Zonapostale::where('nombre', $zona)->first();
            $costo = $zonaPostal->costo;
            //dd($costo);
            //  $costo = number_format((float) $costo, 2, ',', '.');
            // Devolver el costo como respuesta
            return response()->json(['costo' => $costo], 200);
        }

        return response()->json(['error' => 'Código postal no encontrado'], 404);
    }


    public function processOrder(Request $request)
    {
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL); // Para local
    
        // Validar la entrada del formulario
        $validated = $request->validate([
            'envio' => 'nullable|string',
            'codigo_postal' => 'nullable|string|max:10',
            'costo_envio' => 'nullable|numeric' // Validar el costo de envío
        ]);
    
        $logo = Logo::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
        $cartItems = Cart::content();
    
     // Obtener el subtotal y asegurarse de que sea un número flotante (con decimales)
        $cartSubtotal = $this->cartSubtotal();

        // Obtener el costo de envío desde el request, asegurarse de que sea un número flotante
        $costoEnvio = (float) $request->input('costo_envio', 0);
       // dd($cartSubtotal, $costoEnvio);
        // Sumar el costo de envío al total del carrito
        $cartTotal =  $cartSubtotal +  $costoEnvio;
     //   dd($cartTotal);
        $carritoinfo = Carritoinfo::first();
    
        // Get the updated cart count
        $cartCount = Cart::content()->count();
    
        // Guardar los datos validados en una variable
        $datos = $validated;
    
        try {
            // Configurar el token de MercadoPago
            MercadoPagoConfig::setAccessToken(env('MP_ACCESS_TOKEN'));
    
            // Construir el array de items a partir de los productos del carrito
            $items = [];
            foreach ($cartItems as $cartItem) {
                // Obtener el producto desde la base de datos
                $producto = Producto::find($cartItem->id);
    
                // Calcular el precio basado en la cantidad comprada usando el método del modelo
                $precioConDescuento = $producto->obtenerPrecioConDescuento($cartItem->qty);
    
                // Crear el array de items para MercadoPago con el precio ajustado
                $items[] = [
                    "id" => $cartItem->id, // ID único del producto
                    "title" => $cartItem->name, // Nombre del producto
                    "description" => $cartItem->options->colores ?? 'Sin color', // Descripción del producto
                    "quantity" => (int) $cartItem->qty, // Cantidad
                    "unit_price" => (float) $precioConDescuento, // Precio unitario con descuento
                    "currency_id" => "ARS" // Moneda (ejemplo: ARS para pesos argentinos)
                ];
            }
    
            $paymentMethods = [
                "excluded_payment_methods" => [],
                "excluded_payment_types" => [
                    ["id" => "ticket"],
                    ["id" => "debit_card"],
                ],
                "installments" => 12,
                "default_installments" => 1
            ];
    
            // Crear el objeto "shipments" con el costo de envío obtenido del request
            $shipments = [
                "cost" => $costoEnvio,
                "mode" => "not_specified" // Puedes cambiar el modo de envío si es necesario
            ];
    
            // Crear la solicitud de preferencia de pago
            $requestPayload = [
                "items" => $items,
                "payment_methods" => $paymentMethods,
                "statement_descriptor" => "NAME_DISPLAYED_IN_USER_BILLING",
                "external_reference" => "1234567890",
                "back_urls" => [
                    'success' => route('payment.success'),
                    'failure' => route('payment.failure'),
                    'pending' => route('payment.pending'),
                ],
                "expires" => false,
                "auto_return" => "approved",
                "site_id" => "MLA",
                "shipments" => $shipments // Agregar el costo de envío
            ];
    
            // Realizar la solicitud de creación de preferencia
            $client = new PreferenceClient();
            $payment = $client->create($requestPayload);
           // dd($payment); // Muestra los detalles de la respuesta de MercadoPago
    
        } catch (MPApiException $e) {
            echo "Código de estado: " . $e->getApiResponse()->getStatusCode() . "\n";
            echo "Contenido de la respuesta: " . json_encode($e->getApiResponse()->getContent()) . "\n";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    
        // Pasar la variable a la vista
        return view('page.cart-consumidor.details-consumidor', compact('datos', 'cartItems', 'redes', 'contacto', 'logo', 'cartSubtotal', 'cartTotal', 'carritoinfo', 'cartCount', 'payment', 'costoEnvio'));
    }
    


    public function success(Request $request)
    {
        // Lógica para manejar un pago exitoso
        $logo = Logo::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
        $cartCount = Cart::content()->count();
        
        return view('page.payments.success', compact('logo', 'redes', 'contacto', 'cartCount')); // Asegúrate de crear la vista payments/success.blade.php
    }
    public function failure(Request $request)
    {
        // Lógica para manejar un pago fallido
        return view('page.payments.failure'); // Asegúrate de crear la vista payments/failure.blade.php
    }

    public function pending(Request $request)
    {
        // Lógica para manejar un pago pendiente
        return view('page.payments.pending'); // Asegúrate de crear la vista payments/pending.blade.php
    }

public function processCheckout2(Request $request)
    {

     
         // Valida los datos del formulario
    $validated = $request->validate([
        'nombreApellido' => 'required|string|max:255',
        'dniCuit' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'celular' => 'required|string|max:20',
        'direccion' => 'required|string|max:255',
        'localidad' => 'required|string|max:255',
        'provincia' => 'required|string|max:255',
        'codigoPostal' => 'required|string|max:10',
        'texto' => 'required|string',
        'metododepago' => 'required|string',
        'envio' => 'required',
    ]);

  
    try {
        $order = new Orderconsumidor();
        $order->nombre_apellido = $validated['nombreApellido'];
        $order->dni_cuit = $validated['dniCuit'];
        $order->email = $validated['email'];
        $order->celular = $validated['celular'];
        $order->direccion = $validated['direccion'];
        $order->localidad = $validated['localidad'];
        $order->provincia = $validated['provincia'];
        $order->codigo_postal = $validated['codigoPostal'];
        $order->texto_adicional = $validated['texto'];
        $order->metodo_pago = $validated['metododepago'];
        $order->envio = $validated['envio'];

        // Calcula el subtotal, descuento y total
        $subtotal = $this->cartSubtotal();
        $discount = 0;

        // Aplica el descuento según el método de pago
        switch ($validated['metododepago']) {
            case 'transferencia':
                $discount = $subtotal * 0.05; // 5% de descuento
                break;
            case 'efectivo':
                $discount = $subtotal * 0.10; // 10% de descuento
                break;
            default:
                $discount = 0;
        }

        // Calcular el total después del descuento
        $total = $subtotal - $discount;

        // Guardar los valores en el modelo Orderconsumidor
        $order->subtotal = $subtotal;
        $order->descuento = $discount;
        $order->total = $total;

        // Convierte los items del carrito en JSON y guárdalos
        $cartItems = Cart::content();
        $order->cart_items = json_encode($cartItems);
    //  dd($order);
        // Guardar el pedido en la base de datos antes del pago
        $order->save();
      //  dd($order);
      // Enviar el correo al cliente con los detalles del pedido
      Mail::to($order->email)->send(new Carritopedido($order));

        // Si no es crédito, limpia el carrito y procesa el pedido
      //  Cart::clear();

        return redirect()->back()->with('success', 'Compra realizada con éxito.');
    } catch (\Exception $e) {
        // Registrar el error
        Log::error('Error al procesar la compra: ' . $e->getMessage());

        // Redirigir con un mensaje de error
        return redirect()->back()->with('danger', 'Hubo un error al procesar su compra. Inténtelo de nuevo.');
    }
    }
    
    // private $access_token = "APP_USR-718838766436740-060309-eb7974cf39ee66d95053449994254c83-621563634";
    // private $public_key = "APP_USR-0a769e86-ff65-4388-991f-e4038f5679c7";



    // public function pedido(Request $request){
    //     $contenido = file_get_contents('https://apis.datos.gob.ar/georef/api/provincias?orden=nombre');
    //     $datos = json_decode($contenido, true);
    //     $provincias = $datos['provincias'];
    //     if(Auth::guard('web')->check() && $request->cp_envio != Auth::guard('web')->user()->cp){
    //         $cp = $request->cp_envio;
    //         $dato = Codigopostale::where('cp', $cp )->first();
    //         $prov = $dato->provincia;
    //         $loc = $dato->localidad;
    //     } else {
    //         $prov = '02';
    //         $loc = '';
    //     }
    //     $contenido = file_get_contents('https://apis.datos.gob.ar/georef/api/localidades?provincia='.$prov.'&orden=nombre&max=1000');
    //     $datos = json_decode($contenido, true);
    //     $localidades = $datos['localidades'];
    //     $datos = $request;
    //     $informacion = Carritoinfo::find(1);
    //     if(Auth::guard('web')->check()){
    //         $user = Auth::guard('web')->user();
    //     } else {
    //         $user = null;
    //     }
    //     $credito = $this->generar_credito($datos);
    //     return view('frontend/pedido', compact('datos', 'provincias', 'localidades', 'user', 'informacion', 'loc', 'credito'));
    // }

    // public function generar_credito(Request $request){
    //     MercadoPagoConfig::setAccessToken($this->access_token);
    //     $product1 = array(
    //         "title" => "Productos",
    //         "currency_id" => "ARS",
    //         "quantity" => 1,
    //         "unit_price" => floatval(Carrito::subtotal_final()) * (1 - (Carrito::find(1)->desc_mp / 100))
    //     );
        
        
    //     // Mount the array of products that will integrate the purchase amount
    //     $items = array($product1);
        
    //     $paymentMethods = [
    //         "excluded_payment_methods" => [],
    //         "excluded_payment_types"=> array(
    //             array(
    //                 "id" => "ticket"
    //             ),
    //             array(
    //               "id" => "debit_card"  
    //             ),
    //         ),
    //         "installments" => 12,
    //         "default_installments" => 1
    //     ];
        
    //     $backUrls = array(
    //         'success' => route('registrar.pedido'),
    //         'failure' => ""
    //     );
        
    //     $costo_envio = (int) $request->costo_envio;
    //     if($request->tipo_envio == 'Envíos CABA y GBA'){
    //         $shipment = array(
    //             "cost" => $costo_envio,
    //             "mode" => "not_specified",
    //         );
            
    //     } else{
    //         $shipment = array();
    //     }
        
        
    //     $request = [
    //         "items" => $items,
    //         "payment_methods" => $paymentMethods,
    //         "back_urls" => $backUrls,
    //         "statement_descriptor" => "NAME_DISPLAYED_IN_USER_BILLING",
    //         "external_reference" => "1234567890",
    //         "expires" => false,
    //         "auto_return" => 'approved',
    //         "shipments" => $shipment,
    //     ];
        
    //     $client = new PreferenceClient();
        
    //     $preference = $client->create($request);
    //     return $preference;
    // }




    public function cartdetailsconsumidor()
    {
     

        $logo = Logo::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
        $informacion = Carritoinfo::first(); // Si sólo hay un contacto, puedes usar first()
        $cartItems = Cart::content();
        $cartSubtotal = $this->cartSubtotal();
        $cartTotal = $this->cartTotal();
        $cartCount = Cart::content()->count();
        return view('page.cart-consumidor.carrito', compact('cartItems','redes', 'contacto', 'logo', 'cartSubtotal', 'cartTotal', 'cartCount', 'informacion'));
    }


    public function detailsconsumidor()
    {

        $logo = Logo::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
        $cartItems = Cart::content();
        $cartSubtotal = $this->cartSubtotal();
        $cartTotal = $this->cartTotal();
        $cartCount = Cart::content()->count();
        return view('page.cart-consumidor.details-consumidor', compact('cartItems','redes', 'contacto', 'logo', 'cartSubtotal', 'cartTotal', 'cartCount'));
    }

    
   
    public function addconsumidor(Request $request)
    {
        try {
            // Add the product to the cart
            Cart::add($request->producto_id, $request->nombre, $request->qty, $request->precio, [
                'imagen' => $request->imagen,
                'categoria' => $request->categoria,
                'cantidad' => $request->cantidad, // Agregar cantidad
                'descuento' => $request->descuento, // Agregar descuento
                'cantidad_dos' => $request->cantidad_dos, // Agregar cantidad_dos
                'descuento_dos' => $request->descuento_dos, // Agregar descuento_dos
                'colores' => [
                    'color_seleccionado' => $request->color
                ]
            ])->associate(Producto::class);
            // Get the updated cart count
            $cartCount = Cart::content()->count();

            // Return a successful JSON response with the cart count
            return response()->json([
                'success' => 'Producto agregado al carrito.',
                'cartCount' => $cartCount,
            ]);
        } catch (ValidationException $e) {
            // Handle validation exceptions
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            // Log any other exceptions and return an error response
            Log::error('Error adding product to cart: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al agregar el producto al carrito.'], 500);
        }
    }


    public function updateconsumidor(Request $request)
    {
        try {
            $rowId = $request->input('rowId');
            $quantity = $request->input('qty');

            Cart::update($rowId, $quantity);

            return response()->json([
                'subtotal' => Cart::get($rowId)->subtotal,
                'cartSubtotal' => Cart::subtotal(),
                'cartTotal' => Cart::total(),
            ]);
        } catch (Exception $e) {
            Log::error('Error updating cart: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al actualizar el carrito.'], 500);
        }
    }



    public function removeconsumidor(Request $request)
    {
        try {
                Cart::remove($request->rowId);

                return response()->json([
                    'success' => 'Producto eliminado del carrito.',
                    'cartTotal' => $this->cartTotal(),
                    'subtotal' => $this->cartSubtotal(),
                    'quantity' => Cart::content()->count(),
                ]);
            } catch (Exception $e) {
                Log::error('Error removing product from cart: ' . $e->getMessage());
                return response()->json(['error' => 'Hubo un error al eliminar el producto del carrito.'], 500);
        }
    }

    public function cartSubtotal()
    {
        $subtotal = 0;

        foreach(Cart::content() as $product) {
            $quantity = $product->qty;
            $price = $product->price;
            $discount = 0;

            // Apply discounts based on quantity thresholds
            if ($quantity >= $product->options->cantidad_dos) {
                $discount = $product->options->descuento_dos;
            } elseif ($quantity >= $product->options->cantidad) {
                $discount = $product->options->descuento;
            }

            // Calculate the product subtotal with the applied discount
            $productSubtotal = ($price - ($price * ($discount / 100))) * $quantity;
            $subtotal += $productSubtotal;
        }

        // Format the subtotal as a float for consistency
        //$subtotal = number_format((float) $subtotal, 2, ',', '.');

        return $subtotal;
    }

    public function cartTotal()
    {
        $total = 0;

        foreach (Cart::content() as $product) {
            $quantity = $product->qty;
            $price = $product->price;
            $discount = 0;

            // Apply discounts based on quantity thresholds
            if ($quantity >= $product->options->cantidad_dos) {
                $discount = $product->options->descuento_dos;
            } elseif ($quantity >= $product->options->cantidad) {
                $discount = $product->options->descuento;
            }

            // Calculate the product total with the applied discount
            $productTotal = ($price - ($price * ($discount / 100))) * $quantity;
            $total += $productTotal;
        }

        // Format the total as a float for consistency
        $total = number_format((float) $total, 2, ',', '.');

        return $total;
    }

 

  



    public function remove(Request $request)
    {
        try {
                Cart::remove($request->rowId);

                return response()->json([
                    'success' => 'Producto eliminado del carrito.',
                    'cartTotal' => $this->cartTotal(),
                    'subtotal' => $this->cartSubtotal(),
                    'quantity' => Cart::content()->count(),
                ]);
            } catch (Exception $e) {
                Log::error('Error removing product from cart: ' . $e->getMessage());
                return response()->json(['error' => 'Hubo un error al eliminar el producto del carrito.'], 500);
        }
    }



 


    public function indexcomerciante()
    {
        $logo = Logo::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
        $categorias = Categoria::orderBy('orden', 'asc')->get();
        $productos = Producto::orderBy('orden', 'asc')->get();
        $colores = Color::orderBy('orden', 'asc')->get();
        $carritoinfo =Carritoinfo::first();
        return view('page.cart-comerciante.index', compact('redes', 'contacto', 'logo', 'categorias', 'productos', 'colores', 'carritoinfo'));
    }

    public function detailscomerciante()
    {
      
        $logo = Logo::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
        $cartItems = Cart::content();
        $cartSubotal = $this->cartSubtotal();
        $cartTotal = $this->cartTotal();
        $carritoinfo =Carritoinfo::first();
        return view('page.cart-comerciante.carrito', compact('cartItems','redes', 'contacto', 'logo', 'cartSubotal', 'cartTotal', 'carritoinfo'));
    }


    public function addcomerciante(Request $request)
    {
        try {
            // Validación de entrada
            $request->validate([
                'producto_id' => 'required|exists:productos,id',
                'nombre' => 'required|string',
                'cantidad' => 'required|integer|min:1',
                'precio' => 'required|numeric|min:0',
                'color' => 'nullable|string',
                'imagen' => 'required|string',
                'presentacion' => 'required|integer|min:1',
                'cantidad_minima' => 'required|integer|min:1',
            ]);
    
            // Agregar el producto al carrito
            Cart::add($request->producto_id, $request->nombre, $request->cantidad, $request->precio, [
                'imagen' => $request->imagen,
                'categoria' => $request->categoria,
                'codigo' => $request->codigo,
                'colores' => [
                    'color_seleccionado' => $request->color
                ],
                'presentacion' => $request->presentacion, // Guardar la presentación
                'cantidad_minima' => $request->cantidad_minima // Guardar la cantidad mínima
            ])->associate(Producto::class);
    
            // Obtener el número total de productos en el carrito
            $cartCount = Cart::content()->count();
    
            // Retornar respuesta JSON
            return response()->json([
                'success' => 'Producto agregado al carrito.',
                'cartCount' => $cartCount,
            ]);
        } catch (ValidationException $e) {
            // Manejar errores de validación
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            // Manejar cualquier otro error
            Log::error('Error adding product to cart: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al agregar el producto al carrito.'], 500);
        }
    }

    public function update(Request $request)
    {
        $cartItem = Cart::get($request->rowId);
    
        // Validar que la cantidad no sea menor a la cantidad mínima
        if ($request->qty < $cartItem->options->cantidad_minima) {
            return response()->json(['error' => 'La cantidad no puede ser menor a la cantidad mínima permitida.'], 422);
        }
    
        // Validar que la cantidad sea un múltiplo de la presentación
        if ($request->qty % $cartItem->options->presentacion !== 0) {
            return response()->json(['error' => 'La cantidad debe ser un múltiplo de la presentación del producto.'], 422);
        }
    
        // Actualizar la cantidad en el carrito
        Cart::update($request->rowId, $request->qty);
    
        // Devolver solo un mensaje de éxito sin los cálculos de subtotales
        return response()->json([
            'success' => 'Cantidad actualizada con éxito.',
        ]);
    }
    
    public function sendcomerciante(Request $request)
    { 
        
        $cartItems = Cart::content(); // Obtener los artículos del carrito
        $carritoinfo = ''; // Obtén la información relevante del carrito
        $role = Auth::guard('logincliente')->user()->role;
        $cliente = Auth::guard('logincliente')->user(); // Datos del cliente
        dd($cliente);
        // Envía el correo
        Mail::to($cliente->email)->send(new CarritoPresupuesto($cartItems, $carritoinfo, $role, $cliente));
    
        return back()->with('success', '¡Correo enviado con éxito!');
        

    }




}
