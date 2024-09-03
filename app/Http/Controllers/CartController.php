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

class CartController extends Controller
{

    private $access_token = "APP_USR-718838766436740-060309-eb7974cf39ee66d95053449994254c83-621563634";
    private $public_key = "APP_USR-0a769e86-ff65-4388-991f-e4038f5679c7";

    public function carrito(){
        
        $cart = Cart::content();
        $informacion = Carritoinfo::find(1);
        if(Auth::guard('web')->check()){
            $cp = Auth::guard('web')->user()->cp;
            $result = Codigopostale::where('cp', $cp)->get()->first();
            if($result){
                $zona = Codigopostale::where('cp', $cp)->get()->first()->zona;
                $costo = Zonapostale::where('nombre', $zona)->get()->first()->costo;
            } else {
                $costo = 'Consultar';
                $cp = '';
            }
        } else {
            $costo = 'Consultar';
            $cp = '';
        }
        
        return view('frontend/carrito', compact('cart', 'informacion', 'costo', 'cp'));
    }

    public function pedido(Request $request){
        $contenido = file_get_contents('https://apis.datos.gob.ar/georef/api/provincias?orden=nombre');
        $datos = json_decode($contenido, true);
        $provincias = $datos['provincias'];
        if(Auth::guard('web')->check() && $request->cp_envio != Auth::guard('web')->user()->cp){
            $cp = $request->cp_envio;
            $dato = Codigopostale::where('cp', $cp )->first();
            $prov = $dato->provincia;
            $loc = $dato->localidad;
        } else {
            $prov = '02';
            $loc = '';
        }
        $contenido = file_get_contents('https://apis.datos.gob.ar/georef/api/localidades?provincia='.$prov.'&orden=nombre&max=1000');
        $datos = json_decode($contenido, true);
        $localidades = $datos['localidades'];
        $datos = $request;
        $informacion = Carritoinfo::find(1);
        if(Auth::guard('web')->check()){
            $user = Auth::guard('web')->user();
        } else {
            $user = null;
        }
        $credito = $this->generar_credito($datos);
        return view('frontend/pedido', compact('datos', 'provincias', 'localidades', 'user', 'informacion', 'loc', 'credito'));
    }

    public function generar_credito(Request $request){
        MercadoPagoConfig::setAccessToken($this->access_token);
        $product1 = array(
            "title" => "Productos",
            "currency_id" => "ARS",
            "quantity" => 1,
            "unit_price" => floatval(Carrito::subtotal_final()) * (1 - (Carrito::find(1)->desc_mp / 100))
        );
        
        //$product2 = array(
        //    "id" => "9012345678",
        //    "title" => "Product 2 Title",
        //    "description" => "Product 2 Description",
        //    "currency_id" => "ARS",
        //    "quantity" => 5,
        //    "unit_price" => 19.90
        //);
        
        // Mount the array of products that will integrate the purchase amount
        $items = array($product1);
        
        $paymentMethods = [
            "excluded_payment_methods" => [],
            "excluded_payment_types"=> array(
                array(
                    "id" => "ticket"
                ),
                array(
                  "id" => "debit_card"  
                ),
            ),
            "installments" => 12,
            "default_installments" => 1
        ];
        
        $backUrls = array(
            'success' => route('registrar.pedido'),
            'failure' => ""
        );
        
        $costo_envio = (int) $request->costo_envio;
        if($request->tipo_envio == 'Envíos CABA y GBA'){
            $shipment = array(
                "cost" => $costo_envio,
                "mode" => "not_specified",
            );
            
        } else{
            $shipment = array();
        }
        
        
        $request = [
            "items" => $items,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "NAME_DISPLAYED_IN_USER_BILLING",
            "external_reference" => "1234567890",
            "expires" => false,
            "auto_return" => 'approved',
            "shipments" => $shipment,
        ];
        
        $client = new PreferenceClient();
        
        $preference = $client->create($request);
        return $preference;
    }

    public function cartdetailsconsumidor()
    {
        $logo = Logo::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
        $informacion = Carritoinfo::first(); // Si sólo hay un contacto, puedes usar first()
        $cartItems = Cart::content();
        $cartSubotal = $this->cartSubtotal();
        $cartTotal = $this->cartTotal();
        $cartCount = Cart::content()->count();
        return view('page.cart-consumidor.carrito', compact('cartItems','redes', 'contacto', 'logo', 'cartSubotal', 'cartTotal', 'cartCount', 'informacion'));
    }


    public function detailsconsumidor()
    {
        $logo = Logo::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
        $cartItems = Cart::content();
        $cartSubotal = $this->cartSubtotal();
        $cartTotal = $this->cartTotal();
        $cartCount = Cart::content()->count();
        return view('page.cart-consumidor.details-consumidor', compact('cartItems','redes', 'contacto', 'logo', 'cartSubotal', 'cartTotal', 'cartCount'));
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
        $subtotal = number_format((float) $subtotal, 2, ',', '.');

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

 

    public function update(Request $request)
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


    // CartController.php
    public function addcomerciante(Request $request)
    {
        try {
            // Add the product to the cart
            Cart::add($request->producto_id, $request->nombre, $request->cantidad, $request->precio, [
                'imagen' => $request->imagen,
                'categoria' => $request->categoria,
                'codigo' => $request->codigo,
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


    public function processOrder(Request $request)
    {

        $validated = $request->validate([
            'envio' => 'nullable|string',
            'codigo_postal' => 'nullable|string|max:10',
        ]);
        $logo = Logo::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
        $cartItems = Cart::content();
        $cartSubotal = $this->cartSubtotal();
        $cartTotal = $this->cartTotal();
        $carritoinfo =Carritoinfo::first();
           // Get the updated cart count
           $cartCount = Cart::content()->count();
        // Guardar los datos validados en una variable
        $datos = $validated;

    // Pasar la variable a la vista
    return view('page.cart-consumidor.details-consumidor', compact('datos', 'cartItems','redes', 'contacto', 'logo', 'cartSubotal', 'cartTotal', 'carritoinfo','cartCount'));
    }
    


    public function processCheckout2(Request $request)
{

    // Valida los datos del formulario
    $validated = $request->validate([
        'nombreApellido' => 'nullable|string|max:255',
        'dniCuit' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'celular' => 'nullable|string|max:20',
        'direccion' => 'nullable|string|max:255',
        'localidad' => 'nullable|string|max:255',
        'provincia' => 'nullable|string|max:255',
        'codigoPostal' => 'nullable|string|max:10',
        'texto' => 'nullable|string',
        'metododepago' => 'nullable|string',
        'envio' => 'nullable',
    ]);
    // dd($validated);

    try {
        // Procesa la compra, guardando la información en la base de datos
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
        $subtotal = Cart::subtotal(2, '.', ''); // Subtotal del carrito
        $discount = 0; // Inicialmente sin descuento

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
        $cartItems = Cart::content(); // Obtén los productos del carrito
        $order->cart_items = json_encode($cartItems); // Guarda los items en formato JSON
        
       dd($order);
        // Guardar el pedido
        $order->save();

        // Limpiar el carrito después del procesamiento
        Cart::clear();

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Compra realizada con éxito.');
    } catch (\Exception $e) {
        // Registrar el error
        Log::error('Error al procesar la compra: ' . $e->getMessage());

        // Redirigir con un mensaje de error
        return redirect()->back()->with('error', 'Hubo un error al procesar su compra. Inténtelo de nuevo.');
    }
}



}
