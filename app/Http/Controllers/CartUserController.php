<?php

namespace App\Http\Controllers;

use App\Models\CartUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartUserController extends Controller
{
    function getCountUserCart($id = null){
        if (Auth::check()) {
            $items = CartUser::select('user_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('user_id')
            ->first();
            
            if ($items == null || empty($items->total_quantity)) {
                $items = 0;
            }else{
                $items = $items->total_quantity;
            }
            
            return response()->json(['count_cart' => $items], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    function insertCart($user_id = null, $book_id = null) {
        if (Auth::check()) {
            $dataCart = CartUser::where('user_id', $user_id)->where('book_id',$book_id)->first();
            if(empty($dataCart)) {
                CartUser::create([
                    'user_id' => $user_id,
                    'book_id' => $book_id,
                ]);
            }else{
                CartUser::where('user_id', $user_id)->where('book_id',$book_id)
                ->update([
                    'quantity' => $dataCart->quantity + 1,
                ]);
            }
    
            return response()->json(['message' => 'Buku berhasil ditambahkan ke cart!'], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    function decreaseCart($user_id = null, $book_id = null) {
        if (Auth::check()) {
            $dataCart = CartUser::where('user_id', $user_id)->where('book_id',$book_id)->first();
            if(empty($dataCart)) {
                CartUser::create([
                    'user_id' => $user_id,
                    'book_id' => $book_id,
                ]);
            }else{
                CartUser::where('user_id', $user_id)->where('book_id',$book_id)
                ->update([
                    'quantity' => $dataCart->quantity - 1,
                ]);
            }
    
            return response()->json(['message' => 'Buku berhasil ditambahkan ke cart!'], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    function removeCart($user_id = null, $book_id = null) {
        if (Auth::check()) {
            $dataCart = CartUser::where('user_id', $user_id)->where('book_id',$book_id)->first();
            if(!empty($dataCart)) {
                CartUser::where('user_id', $user_id)->where('book_id',$book_id)->delete();
            }
    
            return response()->json(['message' => 'Buku berhasil ditambahkan ke cart!'], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    function getListCartItem() {
        if (Auth::check()) {
            $items = CartUser::join('books','books.id', 'cart_users.book_id')
            ->select('books.title','books.cover_image', 'books.price','books.isbn', 'books.publisher', 'cart_users.quantity', 'books.id as book_id')
            ->where('user_id', Auth::user()->id)
            ->where('is_success_cart', false)->get();

            return response()->json(['data_cart' => $items], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}