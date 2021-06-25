<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\razorpay\PaymentController;


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



// demo it's working fine

//product listing
Route::get('my-store', [PaymentController::class, 'show_products'])->name('show_products');  //http://localhost:8000/my-store

//store payments_id and users information provided by razorpay payment gateway.
Route::post('pay-success', [PaymentController::class, 'pay_success'])->name('payment_success'); 

Route::get('thank-you', [PaymentController::class, 'thank_you'])->name('payment_thank_you');

 
// demo end