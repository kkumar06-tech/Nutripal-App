<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\FoodLogController;
use App\Http\Controllers\UserStatController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/users', UserController::class);
Route::apiResource('/foods', FoodController::class);
Route::apiResource('/foodlogs', FoodLogController::class);
Route::apiResource('/userstats', UserStatController::class);
