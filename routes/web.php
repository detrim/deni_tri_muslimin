<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('items.index');
});
Route::resource('items', ItemController::class);
Route::resource('categories', CategoryController::class);
Route::get('categories/{category}/pdf', [CategoryController::class,'exportPdf'])->name('categories.pdf');
Route::get('items-export', [ItemController::class, 'exportExcel'])
     ->name('items.excel');


