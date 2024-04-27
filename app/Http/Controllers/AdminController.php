<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{

    // Start Manage User
    function manageUser() {
        return view('admin/manage-user');
    }

    function getManageUser() {
        $request = Request::create(route('api.getUserCustomer'), 'GET');
        $response = Route::dispatch($request);
        $respponseBody = json_decode($response->getContent(), true);

        $request = Request::create(route('api.getAllRole'), 'GET');
        $response = Route::dispatch($request);
        $roles = json_decode($response->getContent(), true);

        return response()->json(['users' => $respponseBody, 'roles' => $roles]);
    }

    function updateUser(Request $request) {
        $request = Request::create(route('api.updateUserRole'), 'put', [
            'id' => $request->id,
            'role_id' => $request->role_id,
        ]);
        $response = Route::dispatch($request);
        $statusCode = $response->getStatusCode();
        $statusUpdate = json_decode($response->getContent(), true);

        if($statusCode == 200) {
            $request = Request::create(route('api.getUserCustomer'), 'GET');
            $response = Route::dispatch($request);
            $respponseBody = json_decode($response->getContent(), true);

            $request = Request::create(route('api.getAllRole'), 'GET');
            $response = Route::dispatch($request);
            $roles = json_decode($response->getContent(), true);

            return response()->json(['users' => $respponseBody, 'roles' => $roles, 'message' => $statusUpdate['message']]);
        }else{
            return response()->json(['message' => $statusUpdate['message']]);
        }
    }

    function deleteUser(Request $request) {
        $request = Request::create(route('api.deleteUser'), 'put', [
            'id' => $request->id,
        ]);
        $response = Route::dispatch($request);
        $statusCode = $response->getStatusCode();
        $statusUpdate = json_decode($response->getContent(), true);

        if($statusCode == 200) {
            $request = Request::create(route('api.getUserCustomer'), 'GET');
            $response = Route::dispatch($request);
            $respponseBody = json_decode($response->getContent(), true);

            $request = Request::create(route('api.getAllRole'), 'GET');
            $response = Route::dispatch($request);
            $roles = json_decode($response->getContent(), true);

            return response()->json(['users' => $respponseBody, 'roles' => $roles, 'message' => $statusUpdate['message']]);
        }else{
            return response()->json(['message' => $statusUpdate['message']]);
        }
    }
    // End Manage User

    // ================================================================

    // Start Fungsi Manage Book
    function manageBook() {
        return view('admin/manage-book');
    }

    function getAllBooks() {
        try {
            $request = Request::create(route('api.getAllBooks'), 'GET');
            $response = Route::dispatch($request);
            $respponseBody = json_decode($response->getContent(), true);

            $request = Request::create(route('api.getAllGenres'), 'GET');
            $response = Route::dispatch($request);
            $genres = json_decode($response->getContent(), true);

            return response()->json(['books' => $respponseBody, 'genres' => $genres]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Exception: ' . $th->getMessage()], 500);
        }
    }

    function createBook(Request $request) {
        try {
            $request = Request::create(route('api.createBook'), 'post', [$request]);
            $response = Route::dispatch($request);
            $statusCreate = json_decode($response->getContent(), true);
            $status_code = $response->getStatusCode();

            return response()->json(['message' => $statusCreate['message']], $status_code);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Exception: ' . $th->getMessage()], 500);
        }
    }

    function editBook(Request $request) {
        try {
            $request = Request::create(route('api.editBook'), 'post', [$request]);
            $response = Route::dispatch($request);
            $statusCreate = json_decode($response->getContent(), true);
            $status_code = $response->getStatusCode();

            return response()->json(['message' => $statusCreate['message']], $status_code);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Exception: ' . $th->getMessage()], 500);
        }
    }

    function deleteBook(Request $request) {
        $request = Request::create(route('api.deleteBook'), 'delete', [
            'id' => $request->id,
        ]);
        $response = Route::dispatch($request);
        $statusUpdate = json_decode($response->getContent(), true);
        return response()->json(['message' => $statusUpdate['message']]);
    }
    // End Fungsi Manage Book
}
