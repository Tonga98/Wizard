<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/{list?}', function () {
    return view('home');
})->name('home');

Route::get('/home/choferes', function () {
    $choferes = ['Gaston Pojmaevich - Recorrido Centenario', 'Alejandro Dabramo - Recorrido V.L.A', 'Eugenia Caffaratti - Recorrido Neuquen', 'Danilo Pojmaevich - Recorrido Cinco Saltos'];
    return view('home',['list' => $choferes]);
})->name('choferes');

Route::get('/guardas', function () {
    return view('guardas');
})->name('guardas');

Route::get('/pasajeros', function () {
    return view('pasajeros');
})->name('pasajeros');

Route::get('/camionetas', function () {
    return view('camionetas');
})->name('camionetas');
