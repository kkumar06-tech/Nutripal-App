<?php

namespace App\Http\Controllers;
use App\Models\FoodLog;

use Illuminate\Http\Request;

class FoodLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all food logs
        $foodLogs = FoodLog::with('foods')->get();

        return response()->json($foodLogs);
    }

    /**
     * Store a newly created food log in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'user_profile_id' => ['required', 'exists:user_profiles,id'],
            'food_id' => ['required', 'exists:foods,id'],
            'date' => ['required', 'date'],
            'total_calories' => ['required', 'integer'],
        ]);

        // Create a new food log record
        $foodLog = FoodLog::create($validated);

        return response()->json($foodLog, 201);
    }

    /**
     * Display the specified food log.
     */
    public function show($id)
    {
        // Find the food log by ID or fail
        $foodLog = FoodLog::with('foods')->findOrFail($id);

        return response()->json($foodLog);
    }

    /**
     * Update the specified food log in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'user_profile_id' => ['required', 'exists:user_profiles,id'],
            'food_id' => ['required', 'exists:foods,id'],
            'date' => ['required', 'date'],
            'total_calories' => ['nullable', 'integer'],
        ]);

        // Find the food log by ID or fail
        $foodLog = FoodLog::findOrFail($id);

        // Update the food log with validated data
        $foodLog->update($validated);

        return response()->json($foodLog);
    }

    /**
     * Remove the specified food log from storage.
     */
    public function destroy($id)
    {
        $foodLog = FoodLog::findOrFail($id);

        // Delete the food log
        $foodLog->delete();

        return response()->json(['message' => 'Food log deleted successfully'], 200);
    }
}
