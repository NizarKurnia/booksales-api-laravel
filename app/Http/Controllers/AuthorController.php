<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index(){
        $authors = Author::all();

        if ($authors->isEmpty()){
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

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:100',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'bio' => 'required|string'
        ]);

        if($validator->fails()){
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
}
