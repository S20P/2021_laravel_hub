<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;


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

Route::get('/', function () {
    return view('welcome');
});


Route::get('payments', [PaymentController::class, 'create'])->name('payment_create');
 
Route::post('pay-success', [PaymentController::class, 'pay_success'])->name('payment_success'); 

Route::get('thank-you', [PaymentController::class, 'thank_you'])->name('payment_thank_you');

 

