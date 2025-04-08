<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopperController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ShopperController::class, 'welcome'])->middleware(['shopper'])->name('home');

Route::get('/recomendador-busqueda', function (){
    return view('recomendador-busqueda');
})->name('recomendador-busqueda');

Route::get('/dashboard', function (){
    return view('backoffice.index');
})->middleware(['backoffice'])->name('dashboard');

Route::get('/backoffice-shopper', function (){
    return view('backoffice.shopper.facturas');
})->middleware(['backoffice'])->name('backoffice-shopper');

Route::get('/backoffice-shopper-list', function (){
    return view('backoffice.shopper.list');
})->middleware(['backoffice'])->name('backoffice-shopper-list');

Route::get('/backoffice-recomendador', function (){
    return view('backoffice.recomendador.facturas');
})->middleware(['backoffice'])->name('backoffice-recomendador');

Route::get('/backoffice-recomendador-list', function (){
    return view('backoffice.recomendador.list');
})->middleware(['backoffice'])->name('backoffice-recomendador-list');

Route::get('/backoffice-fv', function (){
    return view('backoffice.fuerza-ventas.puntos');
})->middleware(['backoffice'])->name('backoffice-fv');

Route::get('/backoffice-fv-list', function (){
    return view('backoffice.fuerza-ventas.list');
})->middleware(['backoffice'])->name('backoffice-fv-list');

Route::get('/backoffice-lista-shopper', function (){
    return view('backoffice.lista-shopper.lista-shopper');
})->middleware(['backoffice'])->name('backoffice-lista-shopper');

Route::get('/backoffice-lista-recomendador', function (){
    return view('backoffice.lista-recomendador.lista-recomendador');
})->middleware(['backoffice'])->name('backoffice-lista-recomendador');

Route::get('/backoffice-total-bonos', function (){
    return view('backoffice.total-bonos.total-bonos');
})->middleware(['backoffice'])->name('backoffice-total-bonos');


Route::get('ruleta/{factura_id}', [ShopperController::class, 'index'])->middleware(['auth', 'verified', 'ruleta'])->name('ruleta');
Route::post('store-premio', [ShopperController::class, 'storePremio'])->middleware(['auth', 'verified', 'ruleta']);

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
