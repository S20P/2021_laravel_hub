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

Route::get('/', 'Auth\AuthController@login')->name('login');
Route::get('/login', 'Auth\AuthController@login')->name('login');
Route::post('/check_user', 'Auth\AuthController@authenticate')->name('authenticate');
Route::get('logout', 'Auth\AuthController@logout')->name('logout');


Route::get('/home', 'Auth\AuthController@home')->name('home');


Route::middleware('session.has.user')->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    });
});

