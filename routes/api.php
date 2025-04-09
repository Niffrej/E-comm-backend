<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class,'register']);
Route::post('login', [UserController::class,'login']);
Route::post('logout', [UserController::class,'logout']);
Route::get('user/{id}', [UserController::class,'getUserById']);
Route::get('user/email/{email}', [UserController::class,'getUserByEmail']);
Route::get('user/name/{name}', [UserController::class,'getUserByName']);
Route::get('users', [UserController::class,'getUsers']);
Route::put('user/{id}', [UserController::class,'updateUser']);
Route::delete('user/{id}', [UserController::class,'deleteUser']);