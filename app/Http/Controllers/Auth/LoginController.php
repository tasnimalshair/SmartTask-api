<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ApiResponse;

    public function register(RegisterRequest $request)
    {
        $cred =  $request->validated();
        $cred['password'] = Hash::make($cred['password']);
        $user = User::create($cred);

        $token = $user->createToken('token_1')->plainTextToken;

        return $this->success('Registered Successfully', 200, ['token' => $token, 'user' => new UserResource($user)]);
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('Invalid credentials', 401);
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('token_1')->plainTextToken;

        return $this->success('Logged Successfully', 200, ['token' => $token, 'user' => new UserResource($user)]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->error('Logged out from current session');
    }

    public function logoutAll(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->error('Logged out from all devices');
    }
}
