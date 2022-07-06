<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/


Route::post('register', [SessionController::class,'register']);
Route::post('login', [SessionController::class,'login']);

//middleware de autentificacion

Route::group(['middleware' => ['jwt.verify']], function() {


Route::post('profile', [SessionController::class,'logout'])->name('logoutUser');
Route::get('profile', [UserController::class,'getUser'])->name('user');
Route::put('profile/update', [UserController::class,'update'])->name('updateUser');
Route::delete('profile/delete', [UserController::class,'delete'])->name('deleteMyUser');

Route::put('users/update/role/{id}',[PermissionController::class, 'updaterole'])->name('updateRole');

Route::put('users/update/{id}', [AdminController::class,'updateAdmin'])->name('updateAdminUser');
Route::delete('users/delete/{id}', [AdminController::class,'deleteAdmin'])->name('deleteAdminUser');

Route::get('users', [UserController::class, 'index'])->name('showAllUser');

Route::post('products/store',[InvoiceController::class, 'Factura'])->name('createInvoices');
Route::put('products/store/buy',[InvoiceController::class, 'Buy'])->name('buyInvoices');

Route::get('products/store/show',[ContentController::class, 'show'])->name('showContent');
Route::post('products/store/{productid}',[ContentController::class, 'Add'])->name('addContent');
Route::delete('products/store/delete/{id}',[ContentController::class, 'destroy'])->name('destroyContent');

Route::put('products/update/{id}', [ProductController::class, 'update'])->name('updateProduct');
Route::post('products', [ProductController::class, 'create'])->name('createProduct');
Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('DeleteProduct');
Route::get('products/{id}', [ProductController::class, 'show'])->name('searchOneProduct');
Route::get('products', [ProductController::class, 'index'])->name('showAllProducts');




});


