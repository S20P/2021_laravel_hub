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

Route::get('/', function () {
    return view('welcome');
})->name('home');



// demo1 : How To Get Current User Location In Laravel
Route::get('/ip_details', 'UserLocationController@ip_details');
// demo1 end



Route::get('/form', function () {
    return view('formValidate');  // Client-Side Form Validation With Javascript
});




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



// ZOHO Crm  Example

Route::get('/zohocrmauth', 'ZohoController@zohoAuth')->name('zohocrmauth');
Route::get('/APIRedirectUrl', 'ZohoController@storeZohoContacts')->name('zohocrm');


// ZOHO Crm   end


Route::group(['prefix' => 'blog'], static function () {

    Route::get('all', 'BlogController@all');

    Route::get('list', 'BlogController@list');

    Route::get('only-trashed', 'BlogController@onlyTrashed');

    Route::post('store', 'BlogController@store');

    Route::delete('delete/{id}', 'BlogController@delete');

    Route::patch('restore/{id}', 'BlogController@restore');

});


// Hello-Sign API

Route::get('/hello-sign-api-test', 'HelloSignAPIController@testAPI');

// Hello-Sign API end 