<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
// return $request->user();
// });

/**
 * https://laravel.com/docs/7.x/passport =>Client Credentials Grant Tokens

 */

Route::prefix('auth')->group(function () {
    Route::get('login', 'api/AuthControler@index');
});

Route::get('/orders', function (Request $request) {

})->middleware('client');
