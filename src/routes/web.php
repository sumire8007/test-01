<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[ContactController::class,'index']);
Route::post('/confirm',[ContactController::class,'confirm']);
Route::post('/thanks',[ContactController::class,'store']);
Route::delete('/delete',[ContactController::class,'destroy']);
Route::get('/contacts/search',[ContactController::class,'search']);

Route::get('/admin',[AuthController::class,'index']);
Route::post('/export', [ContactController::class, 'export']);


