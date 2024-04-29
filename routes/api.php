<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CartUserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\OrderTransactionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\CartUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
     // ENDPOINT API BERHUBUNGAN DENGAN USER
    Route::get('get-all-user', [UserController::class, 'getAllUser'])->name('api.getAllUser');
    Route::get('get-user-customer', [UserController::class, 'getUserCustomer'])->name('api.getUserCustomer');
    Route::put('update-role', [UserController::class, 'updateRole'])->name('api.updateUserRole');
    Route::delete('delete-user', [UserController::class, 'deleteUser'])->name('api.deleteUser');

    // ENDPOINT API BERHUBUNGAN DENGAN ROLE
    Route::get('get-all-role', [RoleController::class, 'getAllRole'])->name('api.getAllRole');

    Route::post('create-book', [BookController::class, 'createBook'])->name('api.createBook');
    Route::put('edit-book', [BookController::class, 'editBook'])->name('api.editBook');
    Route::delete('delete-book', [BookController::class, 'deleteBook'])->name('api.deleteBook');

    // ENDPOINT API BERHUBUNGAN DENGAN CART
    Route::get('get-cart/{user_id}', [CartUserController::class, 'getCountUserCart'])->name('api.getCountUserCart');
    Route::get('get-cart-item/{user_id}', [CartUserController::class, 'getListCartItem'])->name('api.getListCartItem');
    Route::post('insert-cart/{user_id}/{book_id}', [CartUserController::class, 'insertCart'])->name('api.insertCart');
    Route::post('decrease-cart/{user_id}/{book_id}', [CartUserController::class, 'decreaseCart'])->name('api.decreaseCart');
    Route::post('remove-cart/{user_id}/{book_id}', [CartUserController::class, 'removeCart'])->name('api.removeCart');

    // ENDPOINT API BERHUBUNGAN DENGAN ORDER TRANSACTION
    Route::post('create-order', [OrderTransactionController::class, 'createOrder'])->name('api.createOrder');
    Route::get('get-list-order/${user_id}', [OrderTransactionController::class, 'getListOrderTransaction'])->name('api.getListOrderTransaction');
});

// ENDPOINT API BERHUBUNGAN DENGAN BOOK
Route::get('get-all-book/{search?}', [BookController::class, 'getAllBooks'])->name('api.getAllBooks');


// ENDPOINT API BERHUBUNGAN DENGAN GENRE
Route::get('get-all-genres', [GenreController::class, 'getAllGenres'])->name('api.getAllGenres');