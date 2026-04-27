<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // setup validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|min:8'
        ]);

        // cek validator

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // cek berhasil
        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'User Created Successfully',
                'data' => $user
            ], 201);
        }

        // cek gagal
        return response()->json([
            'success' => false,
            'message' => 'Failed to create user',
        ], 409);
    }

    public function login(Request $request)
    {
        // setup validator
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // cek validator
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // get kredensial dari request
        $credentials = $request->only('email', 'password');

        // cek failed
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email or Password Wrong'
            ], 401);
        }

        // cek success
        return response()->json([
            'success' => true,
            'message' => 'Login Successfull',
            'user' => auth()->guard('api')->user(),
            'token' => $token,
        ], 200);
    }

    public function logout()
    {
        // try
        // invalidate token
        // cek berhasil

        // catch
        // cek gagal

        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'success' => true,
                'message' => 'Logout Successfull',
            ], 200);

        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Logout Failed',
            ], 500);
        }
    }
}
