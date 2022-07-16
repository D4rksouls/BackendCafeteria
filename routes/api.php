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

//middleware de Cors
Route::group(['middleware' => ['cors']], function(){

        Route::post('register', [SessionController::class,'register']);
        Route::post('login', [SessionController::class,'login']);



    //middleware de autentificacion
    Route::group(['middleware' => ['jwt.verify']], function() {

        Route::post('profile/logout', [SessionController::class,'logout'])->name('logoutUser');
        Route::post('profile', [UserController::class,'getUser'])->name('user');
        Route::post('profile/update', [UserController::class,'update'])->name('updateUser');
        Route::post('profile/delete', [UserController::class,'delete'])->name('deleteMyUser');

        Route::post('users/update/role/{id}',[PermissionController::class, 'updaterole'])->name('updateRole');

        Route::post('users/update/{id}', [AdminController::class,'updateAdmin'])->name('updateAdminUser');
        Route::post('users/delete/{id}', [AdminController::class,'deleteAdmin'])->name('deleteAdminUser');

        Route::post('users', [UserController::class, 'index'])->name('showAllUser');

        Route::post('store',[ProductController::class, 'index'])->name('showAllProductsStore');
        Route::post('store/invoice',[InvoiceController::class, 'Factura'])->name('createInvoices');
        Route::post('store/buy',[InvoiceController::class, 'Buy'])->name('buyInvoices');


        Route::post('store/{productid}',[ContentController::class, 'Add'])->name('addContent');
        Route::post('store/delete/{id}',[ContentController::class, 'destroy'])->name('destroyContent');

        Route::post('products/update/{id}', [ProductController::class, 'update'])->name('updateProduct');
        Route::post('products/create', [ProductController::class, 'create'])->name('createProduct');
        Route::post('products/{id}', [ProductController::class, 'destroy'])->name('DeleteProduct');
        Route::post('products/{id}', [ProductController::class, 'show'])->name('searchOneProduct');
        Route::post('products', [ProductController::class, 'index'])->name('showAllProducts');

    });

});
