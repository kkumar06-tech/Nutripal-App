<?php

namespace App\Http\Controllers;
use App\Models\UserStat;
use Illuminate\Http\Request;

class UserStatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all user stats
        $userStats = UserStat::all();
        return response()->json($userStats, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'user_id' => ['required', 'exists:user_profiles,id'], // Ensure the user exists in user_profiles table
            'calories' => ['required', 'integer'],
            'protein' => ['required', 'integer'],
            'fat' => ['nullable', 'integer'],
            'carbs' => ['nullable', 'integer'],
            'liquid_intake' => ['nullable', 'numeric'],
        ]);

        // Check if a record already exists for the same user and date
        $existingStat = UserStat::where('user_id', $validated['user_id'])
                                ->where('date', $validated['date'])
                                ->first();

        if ($existingStat) {
            return response()->json(['message' => 'Record already exists for this date'], 400);
        }

        // Create a new UserStat record
        $userStat = UserStat::create($validated);

        // Return the created UserStat
        return response()->json($userStat, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show( $userId)
    {
        $userStats = UserStat::where('user_id', $userId)->get();

        // Check if any stats were found
        if ($userStats->isEmpty()) {
            return response()->json(['message' => 'No stats found for this user'], 404);
        }
    
        // Return the user stats
        return response()->json($userStats, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'user_id' => ['required', 'exists:user_profiles,id'], // Ensure the user exists in user_profiles table
            'calories' => ['required', 'integer'],
            'protein' => ['required', 'integer'],
            'fat' => ['nullable', 'integer'],
            'carbs' => ['nullable', 'integer'],
            'liquid_intake' => ['nullable', 'numeric'],
        ]);

        // Find the UserStat record by ID
        $userStat = UserStat::findOrFail($id);

        // Update the UserStat record with new values
        $userStat->update($validated);

        // Return the updated UserStat
        return response()->json($userStat, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        // Find the UserStat record by ID
        $userStat = UserStat::findOrFail($id);

        // Delete the UserStat record
        $userStat->delete();

        // Return success message
        return response()->json(['message' => 'UserStat deleted successfully'], 200);
    }
}
