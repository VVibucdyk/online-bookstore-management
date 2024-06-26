<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderTransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

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
    $request = Request::create(route('api.getAllBooks'), 'GET');
    $response = Route::dispatch($request);
    $respponseBody = json_decode($response->getContent(), true);
    
    return view('welcome', ['books' => $respponseBody]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if(Auth::user()->role_id == 1) {
            return redirect()->route('admin.dashboard');
        }elseif (Auth::user()->role_id == 2) {
            return redirect('/');
        }
    })->name('dashboard');

    Route::get('/cart-menu', function () {
        return view('cart-menu');
    })->name('cart-menu');

    Route::get('/order-menu', function () {
        return view('order-menu');
    })->name('order-menu');

    Route::post('create-order', [OrderTransactionController::class, 'createOrderWeb'])->name('create-order');
    
    Route::prefix('admin')->middleware('role.prefix:1')->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('admin.dashboard');

        Route::prefix('manage-user')->group(function () {
            Route::get('/', [AdminController::class, 'manageUser'])->name('manage-user');
            Route::get('getManageUser', [AdminController::class, 'getManageUser'])->name('admin.getManageUser');
            Route::post('update-user', [AdminController::class, 'updateUser'])->name('admin.updateUser');
            Route::post('deleteUser', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
        });

        Route::prefix('manage-book')->group(function () {
            Route::get('/', [AdminController::class, 'manageBook'])->name('manage-book');
            Route::get('getAllBooks', [AdminController::class, 'getAllBooks'])->name('admin.getAllBooks');
            Route::post('createBookProcess', [AdminController::class, 'createBook'])->name('admin.createBook');
            Route::post('updateBookProcess', [AdminController::class, 'editBook'])->name('admin.editBook');
            Route::delete('deleteBookProcess', [AdminController::class, 'deleteBook'])->name('admin.deleteBook');
        });

        Route::get('/manage-transaction', [AdminController::class, 'manageUser'])->name('manage-transaction');
    });
});
