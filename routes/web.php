<?php

use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, ('index')]);
Route::get('/create', function () {
    return view('create', ['title' => 'Create']);
});

Route::post('/post', [PostController::class, ('store')]);
Route::delete('/delete/{id}', [PostController::class, ('destroy')]);
Route::get('/edit/{id}', [PostController::class, ('edit')]);
Route::delete('/deleteImage/{id}', [PostController::class, ('deleteImage')]);
Route::delete('/deleteCover/{id}', [PostController::class, ('deleteCover')]);

Route::put('/update/{id}', [PostController::class, ('update')]);
