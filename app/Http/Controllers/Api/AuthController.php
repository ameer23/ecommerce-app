<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

           $token = $user->createToken('api-token')->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token
        ];

        return $this->successResponse($user, 'User registered successfully.');
    }


     public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return $this->errorResponse('Invalid credentials', 401);
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token,
        ];

        return $this->successResponse($data, 'User logged in successfully.');
    }
}