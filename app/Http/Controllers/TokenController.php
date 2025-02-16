<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tokens\StoreTokenRequest;
use App\Http\Resources\Tokens\TokenResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TokenController extends Controller
{
    public function store(StoreTokenRequest $request): TokenResource|JsonResponse
    {
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials!'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return new TokenResource($token);
    }

    public function destroy(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully!']);
    }
}
