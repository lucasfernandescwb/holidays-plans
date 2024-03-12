<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {

            /**
             * @var User
             */
            $user = Auth::user();

            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'id' => $user->id, 
                'user' => $user, 
                'token' => $token
            ]);
        } else {
            return response()->json(['error' => 'Invalid credentials.'], 401);
        }

        return response()->json(['error' => 'Error at login. Try again...'], 500);
    }

    public function signup(Request $request) 
    {
        try {
            $credentials = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'password' => 'required|string|min:6'
            ]);

            $user = new User([
                ...$credentials,
                'password' => Hash::make($credentials['password'])
            ]);

            $user->save();

            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'id' => $user->id, 
                'user' => $user, 
                'token' => $token
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error when creating account.'], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'User sucessfully logged out!']);
    }
}
