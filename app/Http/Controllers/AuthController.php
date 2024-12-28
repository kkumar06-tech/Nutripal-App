<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255', // Use 'username' consistently
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:user,nutritionist', // Updated to a more secure minimum length
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
            'role' => $validated['role'],
        ]);

        
        $user->sendEmailVerificationNotification();
    
        // Generate a token for the user
        $token = $user->createToken('auth_token')->plainTextToken;
    
        // Return response with token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'role' => $user->role,
    'user_id'=>$user->id,

            'message' => 'User registered successfully', 
        ], 201); // HTTP 201 for successful resource creation
    }    


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required|string', // Validate 'username' 
            'password' => 'required|string',
        ]);
    
        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

          // Attempt to authenticate using username and password
    if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        return response()->json(['message' => 'Invalid login credentials'], 401);
    }

    // Get the authenticated user
    $user = User::where('username', $request->username)->firstOrFail();


   // Generate a 4-digit verification code
   $verificationCode = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

   // Cache the verification code with a 10-minute expiration
   $cacheKey = 'verification_code_' . $user->id; // Unique key for the user
   $expiresAt = now()->addMinutes(10);

   Cache::put($cacheKey, [
       'code' => $verificationCode,
       'expires_at' => $expiresAt
   ], 300); // 600 seconds = 10 minutes

   // Log cache data to ensure the code and expiration time are being stored
   Log::info('Verification code cached: ' . $verificationCode);
   Log::info('Cache expiration time: ' . $expiresAt);


try {
    // Send the verification code to the user's email
    Mail::to($user->email)->send(new EmailVerificationMail($user, $verificationCode));
} catch (\Exception $e) {
    \Log::error('Mail error: ' . $e->getMessage());
    return response()->json(['message' => 'Failed to send verification code. Please try again.'], 500);
}


// Generate a token for the user

$token = $user->createToken('auth_token')->plainTextToken;
// Return response with token

return response()->json([
    'access_token' => $token,
    'token_type' => 'Bearer',
    'role' => $user->role,
    'user_id'=>$user->id
        ]);

    }

    public function logout(Request $request)
    {
        $user = $request->user();  // Get the authenticated user
        $user->tokens()->delete();  // Delete all tokens

        return response()->json(['message' => 'Logged out successfully']);
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
