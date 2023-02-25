<?php
use App\Http\Controllers\DashboardController;
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
use \App\Http\Controllers\Auth\LoginController;
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
Route::get('/login', [LoginController::class, 'show'])->name('login');

Route::post('/login', [LoginController::class, 'handle'])->name('login');

Route::post('/logout', [LoginController::class, 'sign_out'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'display_dashboard'])->name('dashboard');

Route::get('/', function () { return view('welcome');})->name('welcome');


Route::resource('products',ProductController::class);
Route::post('/products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
Route::delete('/products/force-delete/{id}', [ProductController::class, 'forceDelete'])->name('products.force_delete');

Route::resource('categories',CategoryController::class);
Route::post('/categories/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
Route::delete('/categories/force-delete/{id}', [CategoryController::class, 'forceDelete'])->name('categories.force_delete');

Route::resource('users',UserController::class);
Route::post('/users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
Route::delete('/users/force-delete/{id}', [UserController::class, 'forceDelete'])->name('users.force_delete');

Route::resource('customers',CustomerController::class);
Route::post('/customers/restore/{id}', [CustomerController::class, 'restore'])->name('customers.restore');
Route::delete('/customers/force-delete/{id}', [CustomerController::class, 'forceDelete'])->name('customers.force_delete');

Route::resource('roles',RoleController::class);
Route::post('/roles/restore/{id}', [RoleController::class, 'restore'])->name('roles.restore');
Route::delete('/roles/force-delete/{id}', [RoleController::class, 'forceDelete'])->name('roles.force_delete');

Route::resource('subcategories',SubCategoryController::class);
Route::post('/subcategories/restore/{id}', [SubCategoryController::class, 'restore'])->name('subcategories.restore');
Route::delete('/subcategories/force-delete/{id}', [SubCategoryController::class, 'forceDelete'])->name('subcategories.force_delete');

Route::resource('suppliers',SuppliersController::class);
Route::post('/suppliers/restore/{id}', [SuppliersController::class, 'restore'])->name('suppliers.restore');
Route::delete('/suppliers/force-delete/{id}', [SuppliersController::class, 'forceDelete'])->name('suppliers.force_delete');

Route::resource('units',UnitController::class);
Route::post('/units/restore/{id}', [UnitController::class, 'restore'])->name('units.restore');
Route::delete('/units/force-delete/{id}', [UnitController::class, 'forceDelete'])->name('units.force_delete');

Route::resource('sales',SaleOrderController::class);
Route::post('sales/customer/',[SaleOrderController::class,'get_customer'])->name('sales.customer_details');
Route::post('sales/add_customer/',[SaleOrderController::class,'add_new_customer'])->name('sales.add_new_customer');
Route::post('sales/get_all_customer_ajax/',[SaleOrderController::class,'get_customer_ajax'])->name('sales.ajax_all_customer');

Route::resource('expenses',ExpenseController::class);
Route::post('/expenses/restore/{id}', [ExpenseController::class, 'expense_restore'])->name('expenses.restore');
Route::delete('/expenses/force-delete/{id}', [ExpenseController::class, 'expense_forceDelete'])->name('expenses.force_delete');


Route::get('/expense_record/index',[ExpenseController::class,'expense_record_index'])->name('expense_record.index');
Route::get('/expense_record/create',[ExpenseController::class,'expense_record_create'])->name('expense_record.create');
Route::post('/expense_record/store',[ExpenseController::class,'expense_record_store'])->name('expense_record.store');
Route::get('/expense_record/edit/{id}',[ExpenseController::class,'expense_record_edit'])->name('expense_record.edit');
Route::put('/expense_record/update/{id}',[ExpenseController::class,'expense_record_update'])->name('expense_record.update');
Route::delete('/expense_record/delete/{id}',[ExpenseController::class,'expanse_record_destroy'])->name('expense_record.destroy');
Route::post('/expense_record/restore/{id}', [ExpenseController::class, 'expense_record_restore'])->name('expense_record.restore');
Route::delete('/expense_record/force-delete/{id}', [ExpenseController::class, 'expense_record_forceDelete'])->name('expense_record.force_delete');


Route::get('/purchase',[PurchaseOrderController::class, 'index'])->name('purchase.index');
Route::get('/purchase/create',[PurchaseOrderController::class, 'create'])->name('purchase.create');
Route::post('/purchase/store',[PurchaseOrderController::class, 'store'])->name('purchase.store');
Route::get('/purchase/edit/{id}',[PurchaseOrderController::class, 'edit'])->name('purchase.edit');
Route::post('/purchase/update/{id}',[PurchaseOrderController::class, 'update'])->name('purchase.update');
Route::delete('/purchase/delete/{id}',[PurchaseOrderController::class, 'destroy'])->name('purchase.destroy');
