<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    function getAllUser() {
        $items = User::all();
        return response()->json($items);
    }
}
