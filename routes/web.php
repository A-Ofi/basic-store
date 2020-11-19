<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ItemAdminController;
use App\Models\Admin;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('admin', fn () => Auth::guard('admin_guard')->user() ? 
    redirect()->route('home')
    :
    view('admin-login')
);
Route::post('admin', [AdminController::class, 'login']);

Route::prefix('admin')->middleware('auth:admin_guard')->group(function (){

    Route::get('home', fn() => view('admin-home'))
            ->name('home');

    Route::prefix('users')->group(function () {
        Route::get('', fn() => view(
            'admin-users',
            ['users' => User::orderBy('id','asc')->paginate(50)]
        ));
        
        Route::get('create', fn () => view('user-create'));
        Route::post('create', [AdminController::class, 'create']);

        Route::get('{user}', fn(User $user) => view(
            'user',
            ['user' => $user]
        ))->name('user');
        Route::post('{user}', [AdminController::class, 'user']);
        Route::post(('{user}/detach/{item}'), [AdminController::class, 'detach']);
        //Route::post('delete', []);
    });//prefix route

    Route::prefix('items')->group(function (){
        Route::get('', fn () => view(
            'admin-items',
            ['items' => Item::orderBy('id','asc')->paginate(50)]
        ));
        Route::get('create', fn () => view('item-create'));
        Route::post('create', [ItemAdminController::class, 'create']);
        Route::get(
            '{item}',
            fn(Item $item) => view(
                'item', 
                ['item' => $item]
            ))->name('item');
        Route::post('{item}', [ItemAdminController::class, 'update']);
    });

});


Route::get('/', function () {
    return view('welcome');
});