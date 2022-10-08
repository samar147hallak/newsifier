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


Route::get('/', [App\Http\Controllers\ArticleController::class, 'index'])->name('welcome');
Auth::routes();

Route::middleware('auth:sanctum')->get('/admin', [App\Http\Controllers\ArticleController::class, 'getByUser'])->name('admin');
Route::middleware('auth:sanctum')->get('/admin/article/create', function () {
    return view('newArticle');
})->name('add');
Route::get('/article/{id}', [App\Http\Controllers\ArticleController::class, 'getById']);
Route::middleware('auth:sanctum')->post('/postArticle',  [App\Http\Controllers\ArticleController::class, 'create']);