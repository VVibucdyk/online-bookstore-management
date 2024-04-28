<?php

namespace App\Http\Controllers;

use App\Models\CartUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartUserController extends Controller
{
    function getCountUserCart($id = null){
        
        if (Auth::check()) {
            $items = CartUser::where('user_id', $id)->where('is_success_cart', false)->get()->count();
            if ($items == null) {
                $items = 0;
            }
            return response()->json(['count_cart' => $items], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    function insertCart($user_id = null, $book_id = null) {
        if (Auth::check()) {
            $d = CartUser::create([
                'user_id' => $user_id,
                'book_id' => $book_id,
            ]);
    
            return response()->json(['message' => 'Buku berhasil ditambahkan ke cart!'], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
