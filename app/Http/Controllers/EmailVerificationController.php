<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class EmailVerificationController extends Controller
{


    public function verifyCode(Request $request)
    {
        Log::info('Entered verifyCode method');

        // Retrieve the verification code and expiration time from the cache
        $validatedData = $request->validate([
            'verification_code' => 'required|string|max:4', // Ensure the code is a 4-character string
        ]);
    
        // Check if the verification code is missing or expired
        if (!$request->user()) {
            Log::error('Unauthenticated access attempt');
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
    

        $cacheKey = 'verification_code_' . $request->user()->id;

        // Retrieve the cached verification data
        $cachedData = Cache::get($cacheKey);


        if (!$cachedData) {
            Log::warning('Verification code missing or expired for user ID: ' . $request->user()->id);
            return response()->json(['message' => 'Verification code is missing or has expired.'], 400);
        }

        $storedCode = $cachedData['code'];
        $expiresAt = $cachedData['expires_at'];
    
        Log::info('Stored verification code: ' . $storedCode);
        Log::info('Stored verification code expires at: ' . $expiresAt);
    
        // Check if the code has expired
          if (now()->greaterThan($expiresAt)) {
            Log::warning('Verification code expired for user ID: ' . $request->user()->id);
            Cache::forget($cacheKey); // Clear the expired code from the cache
            return response()->json(['message' => 'The verification code has expired.'], 400);
        }
    
        // Validate the entered code
        if (trim($validatedData['verification_code']) !== $storedCode) {
            Log::warning('Invalid verification code entered for user ID: ' . $request->user()->id);
            return response()->json(['message' => 'Invalid verification code.'], 400);
        }
    
        // Verification successful, remove the code from the cache
        Cache::forget($cacheKey);
    

        Log::info('Verification successful for user ID: ' . $request->user()->id);

        // Return a success message
        return response()->json(['message' => 'Verification successful.']);
}


  
    public function resendCode(Request $request)
    {
            
        // Get the currently authenticated user
        $user = $request->user();

        Log::info('Entered resendCode method');

        // Generate a new 4-digit verification code
        $verificationCode = rand(1000, 9999);

        // Define a cache key for the verification code (use user ID to ensure uniqueness)
        $cacheKey = 'verification_code_' . $user->id;
        Cache::forget($cacheKey);  // Remove the old cache

        // Store the verification code and expiration time in the cache for 5 minutes
        $expiresAt = now()->addMinutes(5); // Set expiration to 5 minutes

        Cache::put($cacheKey, [
            'code' => $verificationCode,
            'expires_at' => $expiresAt
        ], 300); // 300 seconds = 5 minutes

        // Log the stored verification code and expiration time for debugging
        Log::info('Verification code cached: ' . $verificationCode);
        Log::info('Cache expiration time: ' . $expiresAt);

        // Send the code to the user's email
        try {
            Mail::to($user->email)->send(new EmailVerificationMail($user, $verificationCode));
        } catch (\Exception $e) {
            \Log::error('Mail error: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to send verification code. Please try again.'], 500);
        }

        return response()->json(['message' => 'Verification code has been resent. Please check your email.']);
        
    }
    

   public function verify(Request $request)
    {
        $user = User::findOrFail($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified.'], 200);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json(['message' => 'Email has been verified.'], 200);
    }
}
    
 

