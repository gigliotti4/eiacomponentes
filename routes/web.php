<?php

use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [App\Http\Controllers\PageController::class, 'index'])->name('index');
Route::get('/empresa', [App\Http\Controllers\PageController::class, 'empresa'])->name('empresa');
Route::get('/contacto', [App\Http\Controllers\PageController::class, 'contacto'])->name('contacto');
Route::get('/inyecciones', [App\Http\Controllers\PageController::class, 'inyecciones'])->name('inyecciones');
Route::get('/categorias', [App\Http\Controllers\PageController::class, 'categorias'])->name('categorias');
Route::get('/producto/{id}', [App\Http\Controllers\PageController::class, 'producto'])->name('producto');
Route::get('/productos', [App\Http\Controllers\PageController::class, 'filtroProducto'])->name('filtroproducto');
Route::get('/presupuesto', [App\Http\Controllers\PageController::class, 'presupuesto'])->name('presupuesto');
Route::post('/contacto/send', [App\Http\Controllers\PageController::class, 'sendContactoMail'])->name('contacto.send');
Route::post('/presupuesto/send', [App\Http\Controllers\PageController::class, 'sendPresupuestoMail'])->name('presupuesto.send');
Route::post('/newsletter', [App\Http\Controllers\PageController::class, 'newsletter'])->name('newsletter.send');

Route::get('/registrarse', [App\Http\Controllers\LoginclienteController::class, 'vistaregistro'])->name('registrarse');
Route::post('/registrarse', [App\Http\Controllers\LoginclienteController::class, 'register']);
Route::post('/logincliente', [App\Http\Controllers\Auth\LoginclienteAuthController::class, 'store'])->name('logincliente');
Route::post('/loginclientelogout', [App\Http\Controllers\Auth\LoginclienteAuthController::class, 'logout'])->name('logincliente.logout');


Route::post('/add-to-cart-consumidor', [App\Http\Controllers\CartController::class, 'addconsumidor'])->name('cart.add.consumidor');
Route::get('/cart-details-consumidor', [App\Http\Controllers\CartController::class, 'cartdetailsconsumidor'])->name('cart.details.consumidor');
Route::get('/details-consumidor', [App\Http\Controllers\CartController::class, 'detailsconsumidor'])->name('details.consumidor');
Route::post('/cart-update', [App\Http\Controllers\CartController::class, 'updateconsumidor'])->name('cart.update.consumidor');
Route::post('/cart-remove', [App\Http\Controllers\CartController::class, 'removeconsumidor'])->name('cart.remove.consumidor');



Route::middleware(['logincliente'])->group(function () {
    Route::get('/cart-index', [App\Http\Controllers\CartController::class, 'indexcarrito'])->name('cart.index');
    Route::post('/add-to-cart', [App\Http\Controllers\CartController::class, 'addcomerciante'])->name('cart.add');
    Route::get('/cart-details', [App\Http\Controllers\CartController::class, 'cardetailscomerciante'])->name('cart.details');
    Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
});


Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::prefix('admin')->name('admin.')->group(function () {
        // Dashboard route
        Route::get('/dashboard', [App\Http\Controllers\admin\AdmController::class, 'dashboard'])->name('dashboard');
    
        // Slider routes
        Route::prefix('slider')->name('slider.')->group(function () {
            Route::get('{seccion}', [App\Http\Controllers\admin\SliderController::class, 'index'])->name('index');
            Route::get('{seccion}/create', [App\Http\Controllers\admin\SliderController::class, 'create'])->name('create');
            Route::post('{seccion}/store', [App\Http\Controllers\admin\SliderController::class, 'store'])->name('store');
            Route::get('{seccion}/edit/{id}', [App\Http\Controllers\admin\SliderController::class, 'edit'])->name('edit');
            Route::put('{seccion}/update/{id}', [App\Http\Controllers\admin\SliderController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [App\Http\Controllers\admin\SliderController::class, 'destroy'])->name('destroy');
        });
    
        // Logos routes
        Route::prefix('logos')->name('logos.')->group(function () {
            Route::get('/edit/{id}', [App\Http\Controllers\admin\LogoController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [App\Http\Controllers\admin\LogoController::class, 'update'])->name('update');
        });
    
        // Inicio routes
        Route::prefix('inicio')->name('inicio.')->group(function () {
            Route::get('/edit/{id}', [App\Http\Controllers\admin\InicioController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [App\Http\Controllers\admin\InicioController::class, 'update'])->name('update');
        });

           // Inicio routes
           Route::prefix('inyecciones')->name('inyecciones.')->group(function () {
            Route::get('/edit/{id}', [App\Http\Controllers\admin\InyeccionController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [App\Http\Controllers\admin\InyeccionController::class, 'update'])->name('update');
        });
    
        // Empresa routes
        Route::prefix('empresa')->name('empresa.')->group(function () {
            Route::get('/edit/{id}', [App\Http\Controllers\admin\EmpresaController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [App\Http\Controllers\admin\EmpresaController::class, 'update'])->name('update');
        });
    
        // Contacto routes
        Route::prefix('contacto')->name('contacto.')->group(function () {
            Route::get('/edit/{id}', [App\Http\Controllers\admin\ContactoController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [App\Http\Controllers\admin\ContactoController::class, 'update'])->name('update');
        });
    
        // Redes routes
        Route::prefix('redes')->name('redes.')->group(function () {
            Route::get('/edit/{id}', [App\Http\Controllers\admin\RedeController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [App\Http\Controllers\admin\RedeController::class, 'update'])->name('update');
        });
       

        // Categorias routes
        Route::prefix('categorias')->name('categorias.')->group(function () {
            Route::get('/', [App\Http\Controllers\admin\CategoriaController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\admin\CategoriaController::class, 'create'])->name('create');
            Route::post('/store', [App\Http\Controllers\admin\CategoriaController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [App\Http\Controllers\admin\CategoriaController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [App\Http\Controllers\admin\CategoriaController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [App\Http\Controllers\admin\CategoriaController::class, 'destroy'])->name('destroy');
        });

        // Productos routes
        Route::prefix('productos')->name('productos.')->group(function () {
            Route::get('/', [App\Http\Controllers\admin\ProductoController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\admin\ProductoController::class, 'create'])->name('create');
            Route::post('/store', [App\Http\Controllers\admin\ProductoController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [App\Http\Controllers\admin\ProductoController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [App\Http\Controllers\admin\ProductoController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [App\Http\Controllers\admin\ProductoController::class, 'destroy'])->name('destroy');
            Route::delete('eliminar-imagen/{id}/{key}', [App\Http\Controllers\admin\ProductoController::class, 'eliminarImagen'])->name('eliminarImagen');
        });

        // Colores routes
        Route::prefix('colores')->name('colores.')->group(function () {
            Route::get('/', [App\Http\Controllers\admin\ColorController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\admin\ColorController::class, 'create'])->name('create');
            Route::post('/store', [App\Http\Controllers\admin\ColorController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [App\Http\Controllers\admin\ColorController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [App\Http\Controllers\admin\ColorController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [App\Http\Controllers\admin\ColorController::class, 'destroy'])->name('destroy');
        });
    
        // Users routes
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [App\Http\Controllers\admin\UserController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\admin\UserController::class, 'create'])->name('create');
            Route::post('/store', [App\Http\Controllers\admin\UserController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [App\Http\Controllers\admin\UserController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [App\Http\Controllers\admin\UserController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [App\Http\Controllers\admin\UserController::class, 'destroy'])->name('destroy');
        });
    
        // Users routes
        Route::prefix('loginclientes')->name('loginclientes.')->group(function () {
            Route::get('/', [App\Http\Controllers\LoginclienteController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\LoginclienteController::class, 'createcliente'])->name('create');
            Route::post('/store', [App\Http\Controllers\LoginclienteController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [App\Http\Controllers\LoginclienteController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [App\Http\Controllers\LoginclienteController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [App\Http\Controllers\LoginclienteController::class, 'destroy'])->name('destroy');
        });
     
         
        Route::prefix('metadatos')->name('metadatos.')->group(function () {
            Route::get('/', [App\Http\Controllers\admin\MetadataController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\admin\MetadataController::class, 'create'])->name('create');
            Route::post('/store', [App\Http\Controllers\admin\MetadataController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [App\Http\Controllers\admin\MetadataController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [App\Http\Controllers\admin\MetadataController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [App\Http\Controllers\admin\MetadataController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('newsletter')->name('newsletter.')->group(function () {
            Route::get('/', [App\Http\Controllers\admin\NewsletterController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\admin\NewsletterController::class, 'create'])->name('create');
            Route::post('/store', [App\Http\Controllers\admin\NewsletterController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [App\Http\Controllers\admin\NewsletterController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [App\Http\Controllers\admin\NewsletterController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [App\Http\Controllers\admin\NewsletterController::class, 'destroy'])->name('destroy');
        });

    });
    
    
  
});

// Include authentication routes
require __DIR__.'/auth.php';
