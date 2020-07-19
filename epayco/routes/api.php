<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/customer-registry', 'SoapClientController@customerRegistry');
Route::post('/credit', 'SoapClientController@credit');
Route::post('/payment', 'SoapClientController@payment');
Route::post('/debit', 'SoapClientController@debit');
Route::post('/balance', 'SoapClientController@balance');
Route::post('/verify-email', 'SoapClientController@verifyEmail');
Route::post('/get-customers', 'SoapClientController@getCustomers');
Route::post('/get-customer', 'SoapClientController@getCustomer');

