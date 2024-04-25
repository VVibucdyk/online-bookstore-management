<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    function manageUser() {
        $request = Request::create(route('api.getAllUser'), 'GET');
        $response = Route::dispatch($request);
        $respponseBody = json_decode($response->getContent(), true);

        

        return view('admin/manage-user', compact('respponseBody'));
    }
}
