<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();
        return BookResource::collection($books);
    }

    public function show($id)
    {
        $book = Book::with('category')->find($id);
        
        if (!$book) {
            return response()->json([
                'message' => 'Book not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new BookResource($book);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:2100',
            'isbn' => 'required|string|unique:books,isbn',
            'stok' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'sampul' => 'nullable|string',
        ]);

        $book = Book::create($validated);
        $book->load('category');

        return response()->json(new BookResource($book), Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'judul' => 'sometimes|string|max:255',
            'penulis' => 'sometimes|string|max:255',
            'penerbit' => 'sometimes|string|max:255',
            'tahun_terbit' => 'sometimes|integer|min:1900|max:2100',
            'isbn' => 'sometimes|string|unique:books,isbn,' . $id,
            'stok' => 'sometimes|integer|min:0',
            'category_id' => 'sometimes|exists:categories,id',
            'sampul' => 'nullable|string',
        ]);

        $book->update($validated);
        $book->load('category');

        return new BookResource($book);
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully'
        ], Response::HTTP_OK);
    }
}
