<?php
namespace App\Http\Controllers;
use CodersFree\Shoppingcart\Facades\Cart;
use App\Models\Producto;
use App\Models\Contacto;
use App\Models\Logo;
use App\Models\Rede;
use App\Models\Categoria;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Exception;

class CartController extends Controller
{


    
    public function indexcarrito()
    {
        $logo = Logo::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
        $categorias = Categoria::orderBy('orden', 'asc')->get();
        $productos = Producto::orderBy('orden', 'asc')->get();
        $colores = Color::orderBy('orden', 'asc')->get();
        return view('page.cart-comerciante.carrito', compact('redes', 'contacto', 'logo', 'categorias', 'productos', 'colores'));
    }
    // CartController.php
    public function addcomerciante(Request $request)
    {
        try {
            // Add the product to the cart
            Cart::add($request->producto_id, $request->nombre, $request->cantidad, $request->precio, [
                'imagen' => $request->imagen,
                'categoria' => $request->categoria,
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

    public function addconsumidor(Request $request)
    {
        try {
            // Add the product to the cart
            Cart::add($request->producto_id, $request->nombre, $request->cantidad, $request->precio, [
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

    // public function cartSubtotal()
    //     {
    //         $subtotal = 0;

    //         foreach(Cart::content() as $product) {
    //             $productSubtotal = $product->price * $product->qty; // Assuming price and qty are attributes
    //             $subtotal += $productSubtotal;
    //         }
    //         // Format the subtotal as a float for consistency
    //         $subtotal = number_format((float) $subtotal, 2, ',', '.');

    //         return $subtotal;
    //     }

    // public function cartTotal()
    // {
    //     $total = 0;
    
    //     foreach(Cart::content() as $product) {
    //         $productTotal = $product->price * $product->qty; // Assuming price and qty are attributes
    //         $total += $productTotal;
    //     }
    
    //     // Format the total as a float for consistency
    //     $total = number_format((float) $total, 2, ',', '.');
    
    //     return $total;
    // }


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



    // public function cartdetailscomerciante()
    // {
    //     $logo = Logo::first();
    //     $redes = Rede::first();
    //     $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
    //     $cartItems = Cart::content();
    //     $cartSubotal = $this->cartSubtotal();
    //     $cartTotal = $this->cartTotal();
    //     return view('page.cart-comerciante.index', compact('cartItems','redes', 'contacto', 'logo', 'cartSubotal', 'cartTotal'));
    // }
    public function detailscomerciante()
    {
        $logo = Logo::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
        $cartItems = Cart::content();
        $cartSubotal = $this->cartSubtotal();
        $cartTotal = $this->cartTotal();
        return view('page.cart-comerciante.index', compact('cartItems','redes', 'contacto', 'logo', 'cartSubotal', 'cartTotal'));
    }

    public function cartdetailsconsumidor()
    {
        $logo = Logo::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
        $cartItems = Cart::content();
        $cartSubotal = $this->cartSubtotal();
        $cartTotal = $this->cartTotal();
        $cartCount = Cart::content()->count();
        return view('page.cart-consumidor.carrito', compact('cartItems','redes', 'contacto', 'logo', 'cartSubotal', 'cartTotal', 'cartCount'));
    }


    public function detailsconsumidor()
    {
        $logo = Logo::first();
        $redes = Rede::first();
        $contacto = Contacto::first(); // Si sólo hay un contacto, puedes usar first()
        $cartItems = Cart::content();
        $cartSubotal = $this->cartSubtotal();
        $cartTotal = $this->cartTotal();
        return view('page.cart-consumidor.details-consumidor', compact('cartItems','redes', 'contacto', 'logo', 'cartSubotal', 'cartTotal'));
    }
 

}
