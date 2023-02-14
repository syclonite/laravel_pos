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
use \App\Http\Controllers\ExpenseController;

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
Route::resource('expenses',ExpenseController::class);
Route::get('/expense_record/index',[ExpenseController::class,'expense_record_index'])->name('expense_record.index');
Route::get('/expense_record/create',[ExpenseController::class,'expense_record_create'])->name('expense_record.create');
Route::post('/expense_record/store',[ExpenseController::class,'expense_record_store'])->name('expense_record.store');
Route::get('/expense_record/edit/{id}',[ExpenseController::class,'expense_record_edit'])->name('expense_record.edit');
Route::put('/expense_record/update/{id}',[ExpenseController::class,'expense_record_update'])->name('expense_record.update');
Route::delete('/expense_record/delete/{id}',[ExpenseController::class,'expanse_record_destroy'])->name('expense_record.destroy');

Route::get('/purchase',[PurchaseOrderController::class, 'index'])->name('purchase.index');
Route::get('/purchase/create',[PurchaseOrderController::class, 'create'])->name('purchase.create');
Route::post('/purchase/store',[PurchaseOrderController::class, 'store'])->name('purchase.store');
Route::get('/purchase/edit/{id}',[PurchaseOrderController::class, 'edit'])->name('purchase.edit');
Route::post('/purchase/update/{id}',[PurchaseOrderController::class, 'update'])->name('purchase.update');
Route::delete('/purchase/delete/{id}',[PurchaseOrderController::class, 'destroy'])->name('purchase.destroy');
