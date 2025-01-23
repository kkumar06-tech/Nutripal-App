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
use App\Http\Controllers\AppointmentController;

use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\NutritionistProfileController;


    //authentication routes
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);


    Route::middleware('auth:sanctum')->group(function () {

        // Logout and get user details
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', function () {
            return response()->json(Auth::user());
        });
    
        // Email verification routes
        Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
            $request->fulfill();
            return response()->json(['message' => 'Email verified successfully!']);
        })->middleware('signed')->name('verification.verify');
    
        Route::post('/email/verify/resend', function (Request $request) {
            $request->user()->sendEmailVerificationNotification();
            return response()->json(['message' => 'Verification email sent.']);
        });
    
        // User profile routes
        Route::apiResource('users', UserController::class);
        Route::apiResource('user-profiles', UserProfileController::class);
        Route::get('/user/profile/{id}', [UserProfileController::class, 'getUserProfileById']);
        Route::apiResource('nutritionist-profiles', NutritionistProfileController::class);
        Route::get('/nutritionist-profile/{user_id}', [NutritionistProfileController::class, 'getProfileByUserId']);
        Route::get('/user/profile/{user_id}/nutritionist', [UserController::class, 'getNutritionistProfile']);
        Route::get('/user/profile/{user_id}/user', [UserController::class, 'getUserProfile']);
    
        // Food and food logs routes
        Route::apiResource('foods', FoodController::class);
        Route::apiResource('foodlogs', FoodLogController::class);
        Route::apiResource('userstats', UserStatController::class);
        Route::get('/suggest', [FoodController::class, 'suggest']);
        Route::post('/apply-filters', [FoodController::class, 'applyFilters']);
        Route::get('/allstats/{id}', [UserStatController::class, 'allstats']);
        Route::get('/getstat/{userId}/{date}', [UserStatController::class, 'getstatbydate']);
        Route::get('/getId/{Id}', [UserProfileController::class, 'getUserId']);
    
        // Appointments and profiles routes
        Route::post('/getProfiles', [UserProfileController::class, 'getUserProfiles']);
        Route::get('/nutriappoint/{id}', [AppointmentController::class, 'nutriAppointments']);
        Route::get('/userappoint/{id}', [AppointmentController::class, 'userAppointments']);
        Route::post('/getnutriProfiles', [NutritionistProfileController::class, 'getNutriProfiles']);
        Route::get('/profile/{id}', [UserProfileController::class, 'getProfile']);
    
        // Meal plans and liquid logs routes
        Route::apiResource('mealplans', MealPlanController::class);
        Route::apiResource('appointments', AppointmentController::class);
        Route::apiResource('liquids', LiquidController::class);
        Route::apiResource('liquidlogs', LiquidLogController::class);
        Route::apiResource('notifications', NotificationController::class);
    
        // Conversations and messages routes
        Route::get('conversations/{userId}/{nutritionistId}', [ConversationController::class, 'getConversationByUserAndNutritionist']);
        Route::apiResource('conversations', ConversationController::class);
        Route::get('/nutriconv/{id}', [ConversationController::class, 'nutriconv']);
        Route::apiResource('messages', MessageController::class);
    
        // Mark message as read/unread routes
        Route::patch('/markread{id}', [MessageController::class, 'markAsRead']);
        Route::patch('/markunread{id}', [MessageController::class, 'markAsUnRead']);
    
        // User meal plans
        Route::get('usermealplans/{userId}', [MealPlanController::class, 'usermealplan']);
    
        // Email verification for authenticated users
        Route::post('/verify-code', [EmailVerificationController::class, 'verifyCode']);
        Route::post('/resend-code', [EmailVerificationController::class, 'resendCode']);
    });

 














