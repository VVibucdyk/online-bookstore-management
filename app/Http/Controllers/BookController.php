<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    function getAllBooks($search = null) {
        $books = Book::query();

        // Apply keyword search filter
        if ($search) {
            $books->where('title', 'like', '%' . $search . '%');
        }
        $items = $books->get();
        return response()->json($items);
    }

    function webGetAllBooks($search = null) {
        $books = Book::query();

        // Apply keyword search filter
        if ($search) {
            $books->where('title', 'like', '%' . $search . '%');
        }
        $items = $books->get();
        return response()->json($items);
    }

    function createBook(Request $request) {
        
        if (Auth::check()) {
            
            $validator = Validator::make($request->all(), [
                // 'genre_id' => 'required|exists:genres,id',
                'genre_id' => 'required',
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'isbn' => 'required|unique:books,isbn|string|max:255',
                'publisher' => 'required|string|max:255',
                'publication_year' => 'required|integer|min:4|max:' . date('Y'),
                'description' => 'nullable|string',
                'price' => 'integer|min:1',
                'quantity' => 'integer|min:1',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096'
            ]);
            
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()], 422);
            }
            if ($request->hasFile('cover_image')) {
                $coverImage = $request->file('cover_image');
                $imageName = time() . '_' . $coverImage->getClientOriginalName();
                $coverImage->move(public_path(env('IMAGE_BOOKS_PATH')), $imageName);
            } else {
                $imageName = null;
            }
            
            Book::create([
                'genre_id' => $request->genre_id,
                'title' => $request->title,
                'author' => $request->author,
                'isbn' => $request->isbn,
                'publisher' => $request->publisher,
                'publication_year' => $request->publication_year,
                'description' => $request->description,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'cover_image' => $imageName,
            ]);
    
            return response()->json(['message' => 'Buku berhasil ditambahkan!'], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    function editBook(Request $request) {
        if (Auth::check()) {
            $data = Book::findOrFail($request->id);
            $validator = Validator::make($request->all(), [
                // 'genre_id' => 'required|exists:genres,id',
                'genre_id' => 'required',
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'isbn' => 'required|string|max:255',
                'publisher' => 'required|string|max:255',
                'publication_year' => 'required|integer|min:4|max:' . date('Y'),
                'description' => 'nullable|string',
                'price' => 'integer|min:1',
                'quantity' => 'integer|min:1',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096'
            ]);
            
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()], 422);
            }

            if ($request->hasFile('cover_image')) {
                $coverImage = $request->file('cover_image');
                $imageName = time() . '_' . $coverImage->getClientOriginalName();
                $coverImage->move(public_path(env('IMAGE_BOOKS_PATH')), $imageName);
            } else {
                if(($data->cover_image !== null)) {
                    $imageName = $data->cover_image;
                }else{
                    $imageName = null;
                }
            }


            
            Book::where('id', $request->id)
            ->update([
                'genre_id' => $request->genre_id,
                'title' => $request->title,
                'author' => $request->author,
                'isbn' => $request->isbn,
                'publisher' => $request->publisher,
                'publication_year' => $request->publication_year,
                'description' => $request->description,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'cover_image' => $imageName,
            ]);


            // Hapus gambar sebelumnya
            // $imageFilename = $book->cover_image;
            // if (file_exists(public_path('imageBooks/' . $imageFilename))) {
            //     unlink(public_path('imageBooks/' . $imageFilename));
            // }
    
            return response()->json(['message' => 'Buku berhasil diubah!'], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    function deleteBook(Request $request){
        if (Auth::check()) {
            $book = Book::find($request->id);
            if (!$book) {
                return response()->json(['message' => 'Buku tidak ada'], 404);
            }
            
            $book->delete();
            $imageFilename = $book->cover_image;
            if (file_exists(public_path('imageBooks/' . $imageFilename)) && $imageFilename !== null) {
                unlink(public_path('imageBooks/' . $imageFilename));
            }
            return response()->json(['message' => 'Buku berhasil dihapus!']);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
