<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\NutritionistProfileController;

Route::apiResource('users', UserController::class);
Route::apiResource('user_profiles', UserProfileController::class);
Route::apiResource('nutritionist_profiles', NutritionistProfileController::class);
