<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FoodLogController;
use App\Http\Controllers\UserStatController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\NutritionistProfileController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\LiquidController;



//marija
Route::apiResource('users', UserController::class);
Route::apiResource('user-profiles', UserProfileController::class);
Route::apiResource('nutritionist-profiles', NutritionistProfileController::class);

//keshav
Route::apiResource('foods', FoodController::class);
Route::apiResource('foodlogs', FoodLogController::class);
Route::apiResource('userstats', UserStatController::class);

//daphne
Route::apiResource('mealplans', MealPlanController::class);
Route::apiResource('appointments', AppointmentController::class);
Route::apiResource('liquids', LiquidController::class);



//Route::apiResource('conversations', ConversationController::class);
//Route::apiResource('messages', MessageController::class);
//Route::apiResource('recipes', RecipeController::class);




