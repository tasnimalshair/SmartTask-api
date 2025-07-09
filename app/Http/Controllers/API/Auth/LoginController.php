<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use ApiResponse;

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('Invalid credentials', 401);
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('token_1')->plainTextToken;

        return $this->success('Logged Successfully', 200, ['token' => $token, 'user' => $user]);
    }

    public function register(Request $request)
    {
        $cred =  $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::create($cred);

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('token_1')->plainTextToken;

        return $this->success('Registered Successfully', 200, ['token' => $token, 'user' => $user]);
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
