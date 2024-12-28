<?php

use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LiquidController;
use App\Http\Controllers\FoodLogController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\UserStatController;
use App\Http\Controllers\LiquidLogController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\RecipeController;

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\NutritionalValueController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\NutritionistProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


//authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


//only logged in/authenticated users can logout
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function () {
    $user = Auth::user(); // Get the currently authenticated user
    return response()->json($user); // Return all the user's data as JSON
});


//email verification routes
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();  // Mark the email as verified
    return response()->json(['message' => 'Email verified successfully!']);
})->middleware(['auth:sanctum', 'signed'])->name('verification.verify');


Route::post('/email/verify/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();  // Send the verification email
    return response()->json(['message' => 'Verification email sent.']);
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    // Marija
 Route::apiResource('users', UserController::class);
    Route::apiResource('user-profiles', UserProfileController::class);
    Route::apiResource('nutritionist-profiles', NutritionistProfileController::class);

    // Keshav
    Route::apiResource('foods', FoodController::class);
    Route::apiResource('foodlogs', FoodLogController::class);
    Route::apiResource('userstats', UserStatController::class);



    // Daphne
   Route::apiResource('mealplans', MealPlanController::class);
    Route::apiResource('appointments', AppointmentController::class);
    Route::apiResource('liquids', LiquidController::class);

    //Mauricio
    Route::apiResource('ingredients', IngredientController::class);
    Route::apiResource('liquidlogs', LiquidLogController::class);
  Route::apiResource('nutrivalue', NutritionalValueController::class);


  // Additional routes
 Route::apiResource('recipes', RecipeController::class);
 Route::apiResource('conversations', ConversationController::class);
 Route::apiResource('messages', MessageController::class);
 
Route::patch('/markread{id}',[MessageController::class,'markAsRead']);// still left to test
Route::patch('/markunread{id}',[MessageController::class,'markAsUnRead']); // 
 Route::get('usermealplans/{userId}', [MealPlanController::class,'usermealplan']);// all mealplans of a user


 Route::post('/verify-code', [EmailVerificationController::class, 'verifyCode']);

Route::post('/resend-code', [EmailVerificationController::class, 'resendCode']);

 });
 














