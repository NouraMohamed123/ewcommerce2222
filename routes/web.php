<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\DashboardController;
use  Dashboard\CategoryController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth'])->name('dashboard');
Route::group([
    'middleware'=>['auth'],
],
function(){
   Route::resource('categories', CategoryController::class);
Route::resource('products', CategoryController::class); 
});

require __DIR__.'/auth.php';