<?php

namespace App\Http\Controllers;

use App\Models\CartUser;
use App\Models\OrderTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class OrderTransactionController extends Controller
{
    function createOrder(Request $request){
        if (Auth::check()) {
            $timestamp = now()->timestamp;
            $random = Str::random(8);
            $transactionId = 'BACA_' . $timestamp . '_' . $random;

            DB::beginTransaction();
            
            try {
                OrderTransaction::create([
                    'user_id' => $request->user_id,
                    'transaction_id' => $transactionId,
                    'amount' => $request->total,
                ]);
    
                CartUser::where('user_id', $request->user_id)->where('is_success_cart', false)
                ->update([
                    'date_success_cart' => date(now()),
                    'transaction_id' => $transactionId,
                    'is_success_cart' => true
                ]);

                DB::commit();
        
                return response()->json(['message' => 'Order berhasil dibuat!'], 200);
            } catch (\Throwable $th) {
                DB::rollback();
                return response()->json(['message' => $th->getMessage()], 200);
            }
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    function createOrderWeb(Request $request){
        $request = Request::create(route('api.createOrder'), 'post', [
            'user_id'=>$request->user_id,
            'total'=>$request->total
        ]);
        $response = Route::dispatch($request);
        $respponseBody = json_decode($response->getContent(), true);
        $status_code = $response->getStatusCode();
        return response()->json(['message' => $respponseBody['message']], $status_code);
    }

    function getListOrderTransaction($user_id){
        if (Auth::check()) {
            $data = OrderTransaction::where('user_id', $user_id)->get();
            return response()->json(['message' => 'Order berhasil dibuat!', 'data_order' => $data], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
