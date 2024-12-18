<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthJwtController extends Controller
{
    // register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        // buat user
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return response()->json([
            'message' => 'User berhasil dibuat',
            'data' => $user
        ]);
    }
    // login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        // jwt Token
        $token = JWTAuth::attempt([
            'email' => $request['email'],
            'password' => $request['password']
        ]);

        if (!empty($token)) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Login berhasil',
                'token' => $token
            ]);
        }

        return response()->json([
            'status' => Response::HTTP_UNAUTHORIZED,
            'message' => 'Login gagal',
        ]);
    }
    // profile
    public function profile()
    {
        $profile = auth()->user();
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Profile user',
            'data' => $profile
        ]);
    }
    // refresh Token
    public function refresh()
    {
        $newToken = auth()->refresh();
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'New token generated',
            'token' => $newToken
        ]);
    }
    // logout
    public function logout()
    {
        auth()->logout();
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Logout berhasil',
        ]);
    }
}
