<?php

use App\Http\Controllers\AdminController;
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
    return view('welcome');
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
