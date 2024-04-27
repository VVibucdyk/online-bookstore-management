<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenreController extends Controller
{
    function getAllGenres() {
        if (Auth::check()) {
            $items = Genre::all();
            return response()->json($items);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
