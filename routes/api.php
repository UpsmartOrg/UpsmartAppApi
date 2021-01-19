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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// User Routes
Route::get('users', function() {
    return User::all();
});

Route::get('users/{id}', function($id) {
    return User::find($id);
});

Route::post('users', function(Request $request) {
    return User::create($request->all);
});

Route::put('users/{id}', function(Request $request, $id) {
    $user = User::findOrFail($id);
    $user->update($request->all());

    return $user;
});

Route::delete('user/{id}', function($id) {
    Article::find($id)->delete();

    return 204;
});

// Role Routes
Route::get('roles', function() {
    return Role::all();
});

Route::get('roles/{id}', function($id) {
    return Role::find($id);
});

Route::post('roles', function(Request $request) {
    return Role::create($request->all);
});

Route::put('roles/{id}', function(Request $request, $id) {
    $user = Role::findOrFail($id);
    $user->update($request->all());

    return $user;
});

Route::delete('user/{id}', function($id) {
    Role::find($id)->delete();

    return 204;
});
