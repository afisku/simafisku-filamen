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

// Route::get('/', function () {
//     if (auth()->check()) {
//         return redirect('/admin'); // Sesuaikan dengan dashboard atau halaman utama setelah login
//     }
//     return redirect('/admin/login');
// });

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('filament.admin.auth.login');
});
