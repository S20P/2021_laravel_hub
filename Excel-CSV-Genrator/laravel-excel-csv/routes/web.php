<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//http://localhost:8000/
Route::get('/', function () {
    return view('import');  
});



Route::get('importExportView', [ExcelController::class, 'importExportView']);  //http://localhost:8000/importExportView
Route::get('export', [ExcelController::class, 'export'])->name('export');  //http://localhost:8000/export
Route::post('import', [ExcelController::class, 'import'])->name('import'); //http://localhost:8000/import