<?php

use App\Role;
use App\User;
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

Route::group(['middleware' => ['cors', 'json.response']], function () {

    // Authentication routes (public)
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register','Auth\ApiAuthController@register')->name('register.api');

    // Authenticated routes
    Route::middleware('auth:api')->group(function () {
        //Logging out
        Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');

        //Routes waarvoor gebruiker ingelogd moet zijn
    });
    // User Routes
    // {user} i.p.v {id} zet ID automatisch om naar een user. Indien user niet bestaat -> 404
    Route::get('users', 'UserController@index');
    Route::get('users/{user}', 'UserController@show');
    Route::post('users', 'UserController@store');
    Route::put('users/{user}', 'UserController@update');
    Route::delete('users/{user}', 'UserController@delete');

    // Role Routes
    // {role} i.p.v {id} zet ID automatisch om naar een role. Indien role niet bestaat -> 404
    Route::get('roles', 'RoleController@index');
    Route::get('roles/{role}', 'RoleController@show');
    Route::post('roles', 'RoleController@store');
    Route::put('roles/{role}', 'RoleController@update');
    Route::delete('roles/{role}', 'RoleController@delete');

//    Route::middleware('auth:api')->get('/user', function (Request $request) {
//        return $request->user();
//    });
});





