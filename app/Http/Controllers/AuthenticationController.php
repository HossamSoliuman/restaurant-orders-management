<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    use ApiResponse;

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'phone' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role_id' => 1, 
            'password' => bcrypt($validated['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->customResponse(
            [
                'token' => $token,
            ],
            'Successfully registered.'
        );
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        if (!Auth::attempt($validated)) {
            return $this->errorResponse('Password or phone is wrong', 401);
        }

        $user = User::where('phone', $validated['phone'])->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->customResponse(
            [
                'token' => $token,
            ],
            'Successfully logged in.'
        );
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->customResponse(
            [],
            'Successfully logged out.'
        );
    }
}
