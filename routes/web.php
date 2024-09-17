<?php

use App\Exports\SuratKeluarExport;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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

Route::get('export-excel', function () {
    try {
        return Excel::download(new SuratKeluarExport, 'DATA_SURAT_KELUAR_' . now()->timestamp . '.xlsx');
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
})->name('surat.keluar.export.excel');