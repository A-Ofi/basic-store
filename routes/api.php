<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('user')->group(function (){

    Route::post('signup', [UserController::class, 'signup'])->name('new user');
    Route::post('signin', [UserController::class, 'signin']);
    Route::post(
            'signout',
            [UserController::class,
            'signout']
        )->middleware('auth:JWT_guard');
});

Route::prefix('item')->middleware('auth:JWT_guard')->group(function (){
    Route::post('', [ItemController::class, 'create'])->name('new item');
    Route::post('update/{item}', [ItemController::class, 'update']);
    Route::post('delete/{item}', [ItemController::class, 'delete']);
    Route::post('add/{item}', [ItemController::class, 'addToCart']);
    Route::post('remove/{item}', [ItemController::class, 'removeFromCart']);
    Route::get('find/{item}', [ItemController::class, 'find']);
});