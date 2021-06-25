<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('microbilt.GetReportList');
});


//https://apitest.microbilt.com/BankruptcySearch/GetReport

Route::get('microbilt-Search-GetReport/list', 'MicrobiltStoreController@GetReportList')->name('microbilt.GetReportList');  

Route::get('microbilt-Search-GetReport', 'MicrobiltStoreController@GetReportForm')->name('microbilt.GetReportForm');  
Route::post('microbilt-Search-GetReport', 'MicrobiltStoreController@GetReportSave')->name('microbilt.GetReportSave');


Route::post('microbilt-GetArchiveReport', 'MicrobiltStoreController@GetArchiveReport')->name('microbilt.GetArchiveReport');





