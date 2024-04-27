<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    function getAllUser() {
        if (Auth::check()) {
            $items = User::join('roles', 'users.role_id', 'roles.id')
            ->select('users.*', 'users.id as id', 'roles.name as role_name')
            ->get();
            return response()->json($items);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    function getUserCustomer() {
        if (Auth::check()) {
            $items = User::join('roles', 'users.role_id', 'roles.id')
            ->select('users.*', 'users.id as id', 'roles.name as role_name')
            ->where('users.role_id', 2)
            ->get();
            return response()->json($items);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    function updateRole(Request $request) {
        if (Auth::check()) {
            $user = User::findOrFail($request->id);
            if (!$user) {
                return response()->json(['message' => 'User tidak ada'], 404);
            }

            $request->validate([
                'role_id' => 'required',
            ]);

            $user->update([
                'role_id' => $request->role_id
            ]);
            return response()->json(['message' => 'User berhasil diupdate!']);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    function updateUser(Request $request) {
        if (Auth::check()) {
            $user = User::find($request->id);
            if (!$user) {
                return response()->json(['message' => 'User tidak ada'], 404);
            }
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            ]);

            // Update the user with validated data
            $user->update($validatedData);

            return response()->json(['message' => 'User berhasil diupdate!']);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    function deleteUser(Request $request) {
        if (Auth::check()) {
            $user = User::find($request->id);
            if (!$user) {
                return response()->json(['message' => 'User tidak ada'], 404);
            }

            $user->delete();
            return response()->json(['message' => 'User berhasil dihapus!']);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
