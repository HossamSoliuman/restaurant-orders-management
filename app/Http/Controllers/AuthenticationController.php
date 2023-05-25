<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    use ApiResponse;

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users', 'max:255'],
            'phone' => ['required', 'string', 'unique:users', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
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
        $validatedData = $request->validate([
            'phone_or_email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('phone', $validatedData['phone_or_email'])->first();
        $user = User::where('email', $validatedData['phone_or_email'])->first();

        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return $this->errorResponse(
                'Invalid credentials', 
                401
            );
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse([
            'user' => UserResource::make($user),
            'token' => $token,
        ]);
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