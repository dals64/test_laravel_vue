<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\ProductController;
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
});

Route::prefix('auth')->group(function(){
    Route::post('login', [AppController::class, 'login']);
    Route::post('register', [AppController::class, 'register']);
    Route::get('logout', [AppController::class, 'logout']);
});

Route::post('/product/store', [ProductController::class, 'store']);
Route::post('/product/update', [ProductController::class, 'update']);
Route::get('/product', [ProductController::class, 'index']);
Route::post('/product/delete', [ProductController::class, 'destroy']);