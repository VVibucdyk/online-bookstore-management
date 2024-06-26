<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    function getAllRole() {
        if (Auth::check()) {
            $items = Role::all();
            return response()->json($items);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
