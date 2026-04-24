<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    // Melihat semua data
    public function index()
    {
        $authors = Author::all();

        if ($authors->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "Resource Data Not Found",
            ], 204);
        }

        return response()->json([
            "success" => true,
            "message" => "Get All Resources",
            "data" => $authors
        ], 200);
    }

    // Memasukan data
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'bio' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $image = $request->file('photo');
        $image->store('authors', 'public');

        $author = Author::create([
            'name' => $request->name,
            'photo' => $image->hashName(),
            'bio' => $request->bio,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Resources added successfully',
            'data' => $author
        ], 201);
    }

    // Melihat 1 data
    public function show(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get detail resource',
            'data' => $author
        ], 200);
    }

    // Update data
    public function update(string $id, Request $request)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'bio' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()
            ], 422);
        }

        $data = [
            'name' => $request->name,
            'bio' => $request->bio,
        ];

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->store('authors', 'public');

            if ($author->photo) {
                Storage::disk('public')->delete('authors/' . $author->photo);
            }

            $data['photo'] = $image->hashName();
        }

        $author->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Resource updated successfully',
            'data' => $author
        ], 200);
    }

    // Hapus data
    public function destroy(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
            ], 404);
        }

        if ($author->photo) {
            Storage::disk('public')->delete('authors/' . $author->photo);
        }

        $author->delete();
        return response()->json([
            'success' => true,
            'message' => 'Delete Successfuly',
        ], 200);
    }
}
