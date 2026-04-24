<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\returnArgument;

class BookController extends Controller
{
    // Melihat semua data
    public function index()
    {
        $books = Book::all(); //Mengakses method getBooks

        if ($books->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "Resource Data Not Found",
            ], 204);
        }

        return response()->json([
            "success" => true,
            "message" => "Get All Resources",
            "data" => $books
        ], 200);
    }

    // memasukan data
    public function store(Request $request)
    {
        // 1. Validator
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id'

        ]);

        // 2. Check Validator Error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        // 3. File Upload
        $image = $request->file('cover_photo');
        $image->store('books', 'public');

        // 4. insert data
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'cover_photo' => $image->hashName(),
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id,
        ]);

        // 5. Response
        return response()->json([
            'success' => true,
            'message' => 'Resource added successfully',
            'data' => $book
        ], 201);
    }

    // Melihat 1 data
    public function show(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get detail resource',
            'data' => $book
        ], 200);
    }

    // update data
    public function update(string $id, Request $request)
    {
        // Mencari data
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
            ], 404);
        }

        // validator
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        // siapkan data yang di update
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id,
        ];

        // handle image (upload dan delete data)
        if ($request->hasFile('cover_photo')) {
            $image = $request->file('cover_photo');
            $image->store('books', 'public');

            if ($book->cover_photo) {
                Storage::disk('public')->delete('books/' . $book->cover_photo);
            }

            $data['cover_photo'] = $image->hashName();
        }

        // update data baru ke database
        $book->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Resource updated successfully',
            'data' => $book
        ], 200);

    }

    // Hapus data
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ]);
        }

        if ($book->cover_photo) {
            Storage::disk('public')->delete('books/' . $book->cover_photo);
        }

        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Delete Successfuly',
        ], 200);
    }
}
