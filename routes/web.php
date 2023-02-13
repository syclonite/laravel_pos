<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubCategoryController;
use \App\Http\Controllers\SuppliersController;
use \App\Http\Controllers\UnitController;
use \App\Http\Controllers\PurchaseOrderController;
use \App\Http\Controllers\SaleOrderController;

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
    return view('backend.layout');
});
Route::resource('products',ProductController::class);
Route::resource('categories',CategoryController::class);
Route::resource('users',UserController::class);
Route::resource('customers',CustomerController::class);
Route::resource('roles',RoleController::class);
Route::resource('subcategories',SubCategoryController::class);
Route::resource('suppliers',SuppliersController::class);
Route::resource('units',UnitController::class);

Route::resource('sales',SaleOrderController::class);

Route::get('/purchase',[PurchaseOrderController::class, 'index'])->name('purchase.index');
Route::get('/purchase/create',[PurchaseOrderController::class, 'create'])->name('purchase.create');
Route::post('/purchase/store',[PurchaseOrderController::class, 'store'])->name('purchase.store');
Route::get('/purchase/edit/{id}',[PurchaseOrderController::class, 'edit'])->name('purchase.edit');
Route::post('/purchase/update/{id}',[PurchaseOrderController::class, 'update'])->name('purchase.update');
Route::delete('/purchase/delete/{id}',[PurchaseOrderController::class, 'destroy'])->name('purchase.destroy');
