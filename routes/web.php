<?php

use Illuminate\Support\Facades\Route;
use App\Models\Mesa;

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
Route::get('/mesa/{mesa}', function (Mesa $mesa) {
    return view('cliente.menu', compact('mesa'));
})->name('mesa.menu');

Route::get('/', function () {
    return view('welcome');
});