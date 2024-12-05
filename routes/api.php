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
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\NutritionalValueController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\NutritionistProfileController;

//authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//only logged in/authenticated users can logout
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


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

    // Additional routes
    Route::apiResource('ingredients', IngredientController::class);
    Route::apiResource('liquidlogs', LiquidLogController::class);
    Route::apiResource('Nutrivalue', NutritionalValueController::class);
});
/*
// create a new conversation
//Route::post('/addconversations', [ConversationController::class, 'createConversation']);

//  the details of a specific conversation 
Route::get('/conversations/{conversationId}', [ConversationController::class, 'getConversation']);

// send a message in a specific conversation
//Route::post('/conversations/{conversationId}/messages', [ConversationController::class, 'sendMessage']);
*/

Route::get('/conversations', [ConversationController::class, 'index']);



//messages

Route::get('/messages', [ConversationController::class, 'index']);
Route::get('/messages/{id}', [ConversationController::class, 'show']);




/* Route::middleware('auth:sanctum')->group(function () {
    // Route for email verification
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->name('verification.verify');
});
 */



