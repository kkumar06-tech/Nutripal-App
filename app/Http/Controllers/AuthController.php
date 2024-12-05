<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255', // Use 'username' consistently
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8', // Updated to a more secure minimum length
        ]);
    
        // If validation fails, return error message
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        // Get validated input
        $validated = $validator->validated();
    
        // Create the user using validated data
        $user = User::create([
            'username' => $validated['username'], // Use validated input
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Hashing password
        ]);
    
        // Generate a token for the user
        $token = $user->createToken('auth_token')->plainTextToken;
    
        // Return response with token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'User registered successfully',
        ], 201); // HTTP 201 for successful resource creation
    }    


    public function login(Request $request)
    {
        // Validate the login credentials
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }

        // Get the user
        $user = User::where('email', $request->email)->firstOrFail();

        // Generate a token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return response with token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);

}

}


/*  lecture pdf code
class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // If validation fails, return error message
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        // Get the validated input
        $validated = $validator->validated();

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Generate a token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return response with token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // Login function
    public function login(Request $request)
    {
        // Validate the login credentials
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }

        // Get the user
        $user = User::where('email', $request->email)->firstOrFail();

        // Generate a token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return response with token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
*/
